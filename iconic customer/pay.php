<?php
require_once("./Connection.php");
require_once("./Session.php");
// Include the Razorpay PHP library
require('razorpay-php/Razorpay.php');
include("Payment_config.php");

use Razorpay\Api\Api;


if (isset($_GET['total']) && isset($_GET['bId'])) {
    $totalPrice = $_GET['total'];
    $session->set("totalPrice", $totalPrice);
    $bookingId = $_GET['bId'];
    $session->set("bookingId", $bookingId);
}
else {
    echo "<h2>Invalid Requet</h2>";
}

if ($session->get("userId") != null) {
    $userId = $session->get("userId");
}
else {
    echo "<h2>UserId not set in session</h2>";
}

$amount = $totalPrice * 100; // Amount in paise
$currency = 'INR';

// Create a Razorpay order
// $order = $api->order->create(array(
//     'amount' => $amount,
//     'currency' => $currency,
//     'receipt' => $bookingId, // Use the booking ID as the receipt
// ));

$fetchUser = "SELECT first_name, last_name, email_id, country_code, contact, country_name, address, city_name, state_name
    FROM user 
	INNER JOIN city_master ON user.city_id = city_master.city_id
	INNER JOIN state_master ON city_master.state_code = state_master.state_code
	INNER JOIN country_master ON city_master.country_id = country_master.country_id
	WHERE user_id = ?";

$userStmt = $conn->prepare($fetchUser);
$userStmt->bind_param("i", $userId);
$userStmt->execute();
$rsUser = $userStmt->get_result();
$userRow = $rsUser->fetch_assoc();

// Handle Razorpay payment form (your HTML form)
$api = new Api($keyId, $keySecret);

$firstName = $userRow['first_name'];
$lastName = $userRow['last_name'];
$emailId = $userRow['email_id'];
$contact = $userRow['contact'];
$address = $userRow['address'];

$title = "This is some text";
$webtitle = 'ICONIC EVENT MANAGEMENT'; // Change web title
$displayCurrency = 'INR';
$imageurl = './logo.png'; //change logo from here

$orderData = [
    'receipt'         => $bookingId,
    'amount'          => $totalPrice * 100, // 2000 rupees in paise
    'currency'        => 'INR',
    'payment_capture' => 1 // auto capture
];

$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];

$session->set('razorpay_order_id', $razorpayOrderId);

$displayAmount = $amount = $orderData['amount'];

if ($displayCurrency !== 'INR') {
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}

$data = [
    "key"               => $keyId,
    "amount"            => $amount,
    "name"              => $webtitle,
    "description"       => $title,
    "image"             => $imageurl,
    "prefill"           => [
        "name"              => $firstName . ' ' . $lastName,
        "email"             => $emailId,
        "contact"           => $contact,
    ],
    "notes"             => [
        "address"           => $address,
        "merchant_order_id" => "12312321",
    ],
    "theme"             => [
        "color"             => "#ed1c7d"
    ],
    "order_id"          => $razorpayOrderId,
];

if ($displayCurrency !== 'INR') {
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iconic - Pay</title>
</head>

<body>
    <form action="verify.php" method="POST">
        <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="<?php echo $data['key'] ?>" data-amount="<?php echo $data['amount'] ?>" data-currency="INR" data-name="<?php echo $data['name'] ?>" data-image="<?php echo $data['image'] ?>" data-description="<?php echo $data['description'] ?>" data-prefill.name="<?php echo $data['prefill']['name'] ?>" data-prefill.email="<?php echo $data['prefill']['email'] ?>" data-prefill.contact="<?php echo $data['prefill']['contact'] ?>" data-notes.shopping_order_id="<?php echo $id; ?>" data-order_id="<?php echo $data['order_id'] ?>" <?php if ($displayCurrency !== 'INR') { ?> data-display_amount="<?php echo $data['display_amount'] ?>" <?php } ?> <?php if ($displayCurrency !== 'INR') { ?> data-display_currency="<?php echo $data['display_currency'] ?>" <?php } ?>>
        </script>
        <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
        <input type="hidden" name="shopping_order_id" value="<?php echo $bookingId; ?>">
    </form>
</body>

</html>