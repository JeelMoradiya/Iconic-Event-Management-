<?php
require_once("./Connection.php");
require_once("./Session.php");

// Include the Razorpay PHP library
require('razorpay-php/Razorpay.php');


use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Payment Verification - Iconic </title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
  <div class="container" style="margin: 50px;">
    <div class="row">
      <div class="col-sm-12 form-container">
        <h2 class="text-danger text-center">Iconic <span class="badge badge-danger">Payment Status</span></h2>
        <a href="pay.php" class="text-danger">
          <h6><i class="fas fa-arrow-left"></i> Previous</h6>
        </a>
        <hr>
        <div class="row">
          <div class="col-8">
            <?php
            $success = true;
            include("Payment_config.php");
            $error = "Payment Failed";
            if (empty($_POST['razorpay_payment_id']) === false) {
              $api = new Api($keyId, $keySecret);

              try {

                $attributes = array(
                  'razorpay_order_id' => $session->get('razorpay_order_id'),
                  'razorpay_payment_id' => $_POST['razorpay_payment_id'],
                  'razorpay_signature' => $_POST['razorpay_signature']
                );

                $api->utility->verifyPaymentSignature($attributes);
              } catch (SignatureVerificationError $e) {
                $success = false;
                $error = 'Razorpay Error : ' . $e->getMessage();
              }
            }
            if ($success === true) {
              // If payment is SUCCESSFUL
              $userId = $session->get("userId");
              $bookingId = $session->get("bookingId");
              
              if (!isset($_POST['razorpay_payment_id'])) {
                echo "<h1>razorpay_payment_id not set</h1>";
              }

              $txnId = $_POST['razorpay_payment_id'];
              $amount = $session->get("totalPrice");
              $status = "S";
              $currency = "INR";

              $sql = "INSERT INTO payment (user_id, booking_id, txn_id, amount, status) VALUES(?, ?, ?, ?, ?)";
              $stmt = $conn->prepare($sql);
              $stmt->bind_param('iisds', $userId, $bookingId, $txnId, $amount, $status);
              $stmt->execute();

              $updateBooking = "UPDATE booking_master SET status = 'D' WHERE booking_id = ?";
              $stmt = $conn->prepare($updateBooking);
              $stmt->bind_param('i', $bookingId);
              $stmt->execute();

              $productinfo = 'Payment';

              $posted_hash = $session->get('razorpay_order_id');
              
              $fetchUser = "SELECT first_name, last_name, txn_id, amount, status, DATE_FORMAT(payment_date, '%d %M %Y, %h:%i') AS payment_date
                FROM user 
	              INNER JOIN payment ON user.user_id = payment.user_id
	              WHERE user.user_id = ? AND booking_id = ?";

              $userStmt = $conn->prepare($fetchUser);
              $userStmt->bind_param("ii", $userId, $bookingId);
              $userStmt->execute();
              $rsUser = $userStmt->get_result();
              $userRow = $rsUser->fetch_assoc();

              $firstName = $userRow['first_name'];
              $lastName = $userRow['last_name'];
              $txnId = $userRow['txn_id'];
              $amount = $userRow['amount'];
              $status = "Success";
              $paymentDate = $userRow['payment_date'];
            ?>

              <h2 style="color:#33FF00" ;>Your payment has been successful..</h2>
              <hr>
              <table class="table">

                <tr>
                  <th>Transaction ID:</th>
                  <td><?= $txnId ?></td>
                </tr>
                <tr>
                  <th>Paid Amount:</th>
                  <td><?= $currency . ' ' . $amount ?></td>
                </tr>
                <tr>
                  <th>Payment Status:</th>
                  <td><?= $status ?></td>
                </tr>
                <tr>
                  <th>Name:</th>
                  <td><?= $firstName . ' ' . $lastName ?></td>
                </tr>
                <tr>
                  <th>Date :</th>
                  <td><?= $paymentDate ?></td>
                </tr>
              </table>
            <?php
            } else {
              $html = "<p><div class='errmsg'>Invalid Transaction. Please Try Again</div></p>";
              $error_found = 1;
            }

            if (isset($html)) {
              echo $html;
            }
            ?>
          </div>

        </div>
      </div>
    </div>
  </div>
</body>

</html>