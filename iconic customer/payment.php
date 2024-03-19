<?php
require_once("./Connection.php");
require_once("./Session.php");

require('razorpay-php/Razorpay.php'); // Include the Razorpay PHP library

use Razorpay\Api\Api;

$api_key = 'rzp_test_4hZMnTEOMohMlC'; // Replace with your Razorpay Key ID
$api_secret = 'nz6LpCPIVtPT57qnu4YrAsco'; // Replace with your Razorpay Key Secret

// Initialize Razorpay API client
$api = new Api($api_key, $api_secret);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user and payment details from the form
    $user_id = $_POST['user_id'];
    $service_type = $_POST['service_type'];
    $service_provider = $_POST['service_provider'];
    $decided_fees = $_POST['decided_fees'];

    // Create a booking summary in the database
    // Make sure to validate and sanitize user input before inserting into the database

    // Create a Razorpay order
    $amount = $decided_fees * 100; // Amount in paise
    $currency = 'INR';
    $order_id = uniqid(); // You can generate a unique order ID as per your requirements

    $order = $api->order->create(array(
        'amount' => $amount,
        'currency' => $currency,
        'receipt' => $order_id,
    ));

    $payment_id = $_POST['razorpay_payment_id'];

    // Verify the payment with Razorpay
    $payment = $api->payment->fetch($payment_id);

    if ($payment->status === 'captured') {
        // Payment successful, store payment details in the database
        $status = 'success';

        // Insert booking summary into the database
        $sql = "INSERT INTO booking_master (user_id, service_type, service_provider, decided_fees) 
                VALUES ('$user_id', '$service_type', '$service_provider', '$decided_fees')";

        if ($conn->query($sql) === TRUE) {
            // Insert payment information into the database
            $booking_id = $conn->insert_id; // Get the last inserted booking ID

            $payment_sql = "INSERT INTO payment_info (booking_id, razorpay_payment_id, amount, currency, status) 
                            VALUES ('$booking_id', '$payment_id', '$decided_fees', '$currency', '$status')";

            if ($conn->query($payment_sql) === TRUE) {
                echo "Payment successful and recorded in the database.";
            } else {
                echo "Error: " . $payment_sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    } else {
        // Payment failed
        $status = 'failure';
        echo "Payment failed. Status: " . $payment->status;
    }
}
?>

<!-- backup code -->

<?php
if (isset($_POST['razorpay_payment_id'])) {
    $payment_id = $_POST['razorpay_payment_id'];

    // Verify the payment with Razorpay
    $payment = $api->payment->fetch($payment_id);

    if ($payment->status === 'captured') {
        // Payment successful, insert a payment transaction record
        $paymentAmount = $payment->amount / 100; // Amount in your currency
        $paymentStatus = 'P'; // Payment successful status

        // Insert the payment transaction record into the database
        $insertPaymentQuery = "INSERT INTO payment_transaction (booking_id, payment_amount, payment_status, payment_date) VALUES (?, ?, ?, NOW())";
        $insertPaymentStmt = $conn->prepare($insertPaymentQuery);
        $insertPaymentStmt->bind_param("ids", $bookingId, $paymentAmount, $paymentStatus);

        if ($insertPaymentStmt->execute()) {
            // Calculate the total payments made for the booking
            $totalPaymentsQuery = "SELECT SUM(payment_amount) AS total_payments FROM payment_transaction WHERE booking_id = ?";
            $totalPaymentsStmt = $conn->prepare($totalPaymentsQuery);
            $totalPaymentsStmt->bind_param("i", $bookingId);
            $totalPaymentsStmt->execute();
            $totalPaymentsResult = $totalPaymentsStmt->get_result();
            $totalPaymentsRow = $totalPaymentsResult->fetch_assoc();
            $totalPaymentsMade = (float)$totalPaymentsRow['total_payments'];

            // Compare total payments with the total booking amount (assuming you have $totalBookingAmount)
            if ($totalPaymentsMade >= $totalBookingAmount) {
                // Fully paid
                $bookingStatus = 'Paid';
            } else {
                // Partially paid
                $bookingStatus = 'Partially Paid';
            }

            // Update the booking status in the booking_master table
            $updateBookingStatusQuery = "UPDATE booking_master SET status = ? WHERE booking_id = ?";
            $updateBookingStatusStmt = $conn->prepare($updateBookingStatusQuery);
            $updateBookingStatusStmt->bind_param("si", $bookingStatus, $bookingId);
            $updateBookingStatusStmt->execute();

            // Optionally, you can also update any other relevant information in your database tables.

            // Redirect or display a success message
            echo "Payment successful. Your booking is confirmed.";
        } else {
            // Payment successful, but failed to record payment
            echo "Payment successful, but failed to record payment. Please contact support.";
        }
    } else {
        // Payment failed
        $status = 'F'; // Update the booking status to 'F' (or handle it as needed)
        echo "Payment failed. Status: " . $payment->status;
    }
}
?>