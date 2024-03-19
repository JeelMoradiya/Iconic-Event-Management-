<?php
require_once "./Connection.php";
require_once "./Session.php";

#error_reporting(E_ALL ^ E_NOTICE);
if ( isset($_POST['txtFirstname']) && isset($_POST['txtLastname']) && isset($_POST['txtPhone']) && isset($_POST['txtEmail']) && isset($_POST['txtPass']) && isset($_POST['txtConfirm']) && isset($_POST['selCity']) && isset($_POST['txtPincode']) && isset($_POST['txtHouseBuilding']) && isset($_POST['txtSocietyRoad']) && isset($_POST['txtLocality']) ) {
    $txtFirstname   = $_POST['txtFirstname'];
    $txtLastname    = $_POST['txtLastname'];
    $txtMobile      = $_POST['txtPhone'];
    $txtEmail       = $_POST['txtEmail'];
    $txtPass        = $_POST['txtPass'];
    $txtConfirm     = $_POST['txtConfirm'];
    $selCity        = $_POST['selCity'];

    // if all credentials are valid
    if (validateAll()) {

        $regDateTime = date_create("Asia/Calcutta");
        $regDateTime = date_format($regDateTime, "Y-m-d h:i:s");
        $userType = "U";
        $status = 1;
        // $hash = base64_encode($txtPass);

        $insertQuery = "INSERT INTO user (user_type, email_id, password, first_name, last_name, contact, address, cityId, created_at, is_active) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $insStmt = $conn->prepare($insertQuery);
        $insStmt->bind_param("sssssssiss", $userType, $txtEmail, $txtPass, $txtFirstname, $txtLastname, $txtMobile, $txtAddress, $selCity, $regDateTime, $status);

        if ($insStmt->execute() === TRUE) {
            $session->set("userId", $conn->insert_id);
            echo "success";
            header("Location: login.php");
        }
        else {
            echo "Error in executing insert query";
        }
    } else {
        exit();
    }
} else {
    echo "Parameters not set";
}


function validateFirstName() {
    global $txtFirstname;
    // firstname validation
    if (empty($txtFirstname)) {
        echo 'Please enter first name';
        return false;
    } elseif ( preg_match('/^[a-zA-Z]+$/', $txtFirstname) == 1 ) {
        // echo "firstname valid";
        return true;
    }
    else {
        echo 'Invalid firstname';
        return false;
    }
}

function validateLastName() {
    global $txtLastname;
    // lastname validation
    if (empty($txtLastname)) {
        echo 'Please enter last name';
        return false;
    } else if ( preg_match('/^[a-zA-Z]+$/', $txtLastname) == 1 ) {
        // echo "lastname valid";
        return true;
    }
    else {
        echo 'Invalid lastname';
        return false;
    }
}


function validateCity() {
    global $selCity;
    // city validation
    if (empty($selCity)) {
        echo 'Please select city';
        return false;
    }
    else {
        // echo "city valid";
        return true;
    }
}

function validateAddress() {
    global $txtAddress;
    // address validation
    if (empty($txtAddress)) {
        echo 'Please enter address';
        return false;
    }
    else if ( preg_match('/^[\s0-9a-zA-Z-,]+$/', $txtAddress) == 1 ) {
        // echo "address valid";
        return true;
    }
    else {
        echo 'Only alphabets, digits, and -, allowed in address';
        return false;
    }
}


function validateEmail() {
    global $txtEmail;
    // email validation
    if (empty($txtEmail)) {
        echo 'Please enter email';
        return false;
    } else if ( preg_match("/^[^.][a-zA-Z0-9._!#$%&'*+\/=?^_`{|}~-]+@{1}(?:gmail.com|yahoo.com|yahoo.in|utu.ac.in|hotmail.in)$/", $txtEmail) == 1 ) {
        // echo "email valid";
        return true;
    }
    else {
        echo 'Enter valid email';
        return false;
    }
}

function validatePassword() {
    global $txtPass;
    // password validation
    if (empty($txtPass)) {
        echo 'Please enter password';
        return false;
    }
    else if ( preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/", $txtPass) == 1 ) {
        return true;
    }
    else {
        echo 'Password doesn\'t meet required conditions';
        return false;
    }
}

function validateConfirm() {
    global $txtPass, $txtConfirm;
    // password and confirm password matching
    if ($txtPass != $txtConfirm) {
        echo "Passwords don't match";
        return false;
    }
    else {
        return true;
    }
}

function validatePhone() {
    global $txtMobile;
    // phone number validation
    if (empty($txtMobile)) {
        echo 'Please enter contact';
        return false;
    } elseif (preg_match('/^[0-9]{10}+$/', $txtMobile) == 1) {
        return true;   
    }
    else {
        echo 'Only 10 numeric digits allowed';
        return false;
    }
}

function validateIsRegistered() {
    global $conn, $txtEmail;
    // check if already registered
    $fetchUser = "SELECT emailId from usermaster WHERE emailId = ? AND userType='C' AND status = 'A'";
    $stmt = $conn->prepare($fetchUser);
    $stmt->bind_param("s", $txtEmail);
    if ($stmt->execute()) {
        $rs = $stmt->get_result();
        if ($rs->num_rows > 0) {
            echo 'Email is already registered';
            return false;
        }
        else {
            return true;
        }
    } else {
        echo "Error in fetching registered user";
        return false;
    }
}

function validateAll() {
    if (validateFirstName() && validateLastName() && validateAddress() && validateEmail() && validatePassword() && validateConfirm() && validatePhone() && validateIsRegistered()) {
        return true;
    }
    else {
        // echo "Data not valid";
        return false;
    }
}