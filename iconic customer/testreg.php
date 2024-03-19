<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    
<?php
require_once "./Connection.php";
require_once "./Session.php";
require './vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;


if (isset($_POST['txtFirstname'], $_POST['txtLastname'], $_POST['txtPhone'], $_POST['txtEmail'], $_POST['txtPass'], $_POST['txtConfirm'], $_POST['selCity'], $_POST['txtAddress'])) {
    $txtFirstname   = $_POST['txtFirstname'];
    $txtLastname    = $_POST['txtLastname'];
    $txtMobile      = $_POST['txtPhone'];
    $txtEmail       = $_POST['txtEmail'];
    $txtPass        = $_POST['txtPass'];
    $txtConfirm     = $_POST['txtConfirm'];
    $selCity        = $_POST['selCity'];
    $txtAddress     = $_POST['txtAddress'];

    // if all credentials are valid
    if (validateAll()) {
        $regDateTime = date_create("Asia/Calcutta");
        $regDateTime = date_format($regDateTime, "Y-m-d h:i:s");
        $userType = "U";
        $status = 1;

        // Insert user data into the database
        $insertQuery = "INSERT INTO user (user_type, email_id, password, first_name, last_name, contact, address, city_id, created_at, is_active) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $insStmt = $conn->prepare($insertQuery);
        $insStmt->bind_param("sssssssiss", $userType, $txtEmail, $txtPass, $txtFirstname, $txtLastname, $txtMobile, $txtAddress, $selCity, $regDateTime, $status);

        if ($insStmt->execute() === TRUE) {
            $user_id = $conn->insert_id;
            $session->set("userId", $user_id);

            // Generate and update the verification token
            $verification_token = generateRandomToken();
            $updateQuery = "UPDATE user SET code = ? WHERE user_id = ?";
            $updateStmt = $conn->prepare($updateQuery);
            $updateStmt->bind_param("si", $verification_token, $user_id);
            $updateStmt->execute();

            // Compose and send the verification email
            $verification_link = "http://localhost/iconic.com_28-10-2023/iconic.com/themes/html/harmony-event/verifytoken.php?id=".$user_id."&token=" . $verification_token;

            $mail = new PHPMailer();
            try {
                // Set the SMTP server details
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'iconicevent10@gmail.com';                     //SMTP username
                $mail->Password   = 'ahwhpbbhtcycuvwm';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;

                // Set sender information
                $mail->setFrom('iconicevent10@gmail.com', 'ICONIC EVENT MANAGEMENT');

                // Enable debugging and set a debug output function
                $mail->SMTPDebug = SMTP::DEBUG_SERVER; // You can use SMTP::DEBUG_OFF for no debugging
                $mail->Debugoutput = function ($str, $level) {
                    // Log or display the debug output
                    error_log($str);
                };

                $mail->addAddress($txtEmail, $txtFirstname);
                $mail->isHTML(true);
                $mail->Subject = 'Email Verification';
                $mail->Body = 'Please click the following button to verify your email: <button class="btn btn-primary"><a href="' . $verification_link . '" style="color: white; text-decoration: none;">Verify Email</a></button>';

                if ($mail->send()) {
                    header("Location: login.php");
                    exit();
                } else {
                    echo "Error sending verification email: " . $mail->ErrorInfo;
                }
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            $msg = "<div class='alert alert-info'>We've send a verification link on your email address.</div>";
        } else {
            $msg = "<div class='alert alert-danger'>Something wrong went.</div>";
        }
    }
}

// Function to generate a random token
function generateRandomToken()
{
    return bin2hex(random_bytes(32));
}


function validateFirstName()
{
    global $txtFirstname;
    // firstname validation
    if (empty($txtFirstname)) {
        echo 'Please enter first name';
        return false;
    } elseif (preg_match('/^[a-zA-Z]+$/', $txtFirstname) == 1) {
        // echo "firstname valid";
        return true;
    } else {
        echo 'Invalid firstname';
        return false;
    }
}

function validateLastName()
{
    global $txtLastname;
    // lastname validation
    if (empty($txtLastname)) {
        echo "<div class='alert alert-danger'>Please enter last name</div>";
        return false;
    } else if (preg_match('/^[a-zA-Z]+$/', $txtLastname) == 1) {
        // echo "lastname valid";
        return true;
    } else {
        echo 'Invalid lastname';
        return false;
    }
}


function validateCity()
{
    global $selCity;
    // city validation
    if (empty($selCity)) {
        echo "<div class='alert alert-danger'>Please select city";
        return false;
    } else {
        // echo "city valid";
        return true;
    }
}

function validateAddress()
{
    global $txtAddress;
    // address validation
    if (empty($txtAddress)) {
        echo 'Please enter address';
        return false;
    } else if (preg_match_all("/^[a-zA-Z0-9-.,'\n\r ]{10,}$/m", $txtAddress) == 1) {
        // echo "address valid";
        return true;
    } else {
        echo "<div class='alert alert-danger'>Only alphabets, digits, and -, allowed in address</div>";
        return false;
    }
}


function validateEmail()
{
    global $txtEmail;
    // email validation
    if (empty($txtEmail)) {
        echo "<div class='alert alert-danger'>Please enter email</div>";
        return false;
    } else if (preg_match("/^[^.][a-zA-Z0-9._!#$%&'*+\/=?^_`{|}~-]+@{1}(?:gmail.com|yahoo.com|yahoo.in|utu.ac.in|hotmail.in)$/", $txtEmail) == 1) {
        // echo "email valid";
        return true;
    } else {
        echo "<div class='alert alert-danger'>Enter valid email</div>";
        return false;
    }
}

function validatePassword()
{
    global $txtPass;
    // password validation
    if (empty($txtPass)) {
        echo "<div class='alert alert-danger'>Please enter password</div>";
        return false;
    } else if (preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/", $txtPass) == 1) {
        return true;
    } else {
        echo "<div class='alert alert-danger'>Password doesn't meet required conditions</div>";
        return false;
    }
}

function validateConfirm()
{
    global $txtPass, $txtConfirm;
    // password and confirm password matching
    if ($txtPass != $txtConfirm) {
        echo "<div class='alert alert-danger'>Passwords don't match</div>";
        return false;
    } else {
        return true;
    }
}

function validatePhone()
{
    global $txtMobile;
    // phone number validation
    if (empty($txtMobile)) {
        echo "<div class='alert alert-danger'>Please enter contact</div>";
        return false;
    } elseif (preg_match('/^[0-9]{10}+$/', $txtMobile) == 1) {
        return true;
} else {
        echo "<div class='alert alert-danger'>Only 10 numeric digits allowed</div>";
        return false;
    }
}

function validateIsRegistered()
{
    global $conn, $txtEmail;
    // check if already registered
    $fetchUser = "SELECT email_id from user WHERE email_id = ? AND user_type='U'";
    $stmt = $conn->prepare($fetchUser);
    $stmt->bind_param("s", $txtEmail);
    if ($stmt->execute()) {
        $rs = $stmt->get_result();
        if ($rs->num_rows > 0) {
            echo "<div class='alert alert-danger'>Email is already registered</div>";
            return false;
        } else {
            return true;
        }
    } else {
        echo "<div class='alert alert-danger'>Error in fetching registered user</div>";
        return false;
    }
}

function validateAll()
{
    if (validateFirstName() && validateLastName() && validateAddress() && validateEmail() && validatePassword() && validateConfirm() && validatePhone() && validateIsRegistered()) {
        return true;
    } else {
        // echo "Data not valid";
        return false;
    }
}
?>

</body>
</html>