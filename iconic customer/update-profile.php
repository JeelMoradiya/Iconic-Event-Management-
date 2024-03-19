<?php
require_once "./Connection.php";
require_once "./Session.php";

#error_reporting(E_ALL ^ E_NOTICE);
if ($session->get("userId") != null) {

    $userId = $session->get("userId");

    if (isset($_POST['txtFirstName']) && isset($_POST['txtLastName']) && isset($_POST['txtAddress']) && isset($_POST['selCity']) && isset($_POST['txtEmail']) && isset($_POST['txtPhone'])) {
        $txtFirstname   = $_POST['txtFirstName'];
        $txtLastname    = $_POST['txtLastName'];
        $txtAddress     = $_POST['txtAddress'];
        $selCity        = $_POST['selCity'];
        $txtEmail       = $_POST['txtEmail'];
        $txtMobile      = $_POST['txtPhone'];

        // if all credentials are valid
        if (validateAll()) {

            $regDateTime = date_create("Asia/Calcutta");
            $regDateTime = date_format($regDateTime, "Y-m-d h:i:s");
            $userType = "U";
            $status = 1;

            $insertQuery = "UPDATE user SET first_name=?, last_name=?, email_id=?, contact=?, address=?, city_id=?, updated_at=? 
            WHERE user_id = ?";
            $insStmt = $conn->prepare($insertQuery);
            $insStmt->bind_param("ssssissi", $txtFirstname, $txtLastname, $txtEmail, $txtMobile, $txtAddress, $selCity, $regDateTime, $userId);

            if ($insStmt->execute() === TRUE) {
                echo "success";
                header("Location: ./profile.php");
            } else {
                echo "Error in executing query";
            }
        } else {
            exit();
        }
    } else {
        echo "Parameters not set";
    }
} else {
    echo "Login Required to perform this action";
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
        echo 'Please enter last name';
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
        echo 'Please select city';
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
    } else if (preg_match('/^[a-zA-Z0-9.,\/\s-]+$/', $txtAddress) == 1) {
        // echo "address valid";
        return true;
    } else {
        echo 'Only alphabets, digits, (comma), (period), /, and - allowed in address';
        return false;
    }
}


function validateEmail()
{
    global $txtEmail;
    // email validation
    if (empty($txtEmail)) {
        echo 'Please enter email';
        return false;
    } else if (preg_match("/^[^.][a-zA-Z0-9._!#$%&'*+\/=?^_`{|}~-]+@{1}(?:gmail.com|yahoo.com|yahoo.in|utu.ac.in|hotmail.in)$/", $txtEmail) == 1) {
        // echo "email valid";
        return true;
    } else {
        echo 'Enter valid email';
        return false;
    }
}

function validatePassword()
{
    global $txtPass;
    // password validation
    if (empty($txtPass)) {
        echo 'Please enter password';
        return false;
    } else if (preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/", $txtPass) == 1) {
        return true;
    } else {
        echo 'Password doesn\'t meet required conditions';
        return false;
    }
}

function validateConfirm()
{
    global $txtPass, $txtConfirm;
    // password and confirm password matching
    if ($txtPass != $txtConfirm) {
        echo "Passwords don't match";
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
        echo 'Please enter contact';
        return false;
    } elseif (preg_match('/^[6-9][0-9]{9}+$/', $txtMobile) == 1) {
        return true;
    } else {
        echo 'Only 10 numeric digits allowed';
        return false;
    }
}

function validateIsRegistered()
{
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
        } else {
            return true;
        }
    } else {
        echo "Error in fetching registered user";
        return false;
    }
}

function validateAll()
{
    if (validateFirstName() && validateLastName() && validateAddress() && validateEmail() && validatePhone()) {
        return true;
    } else {
        // echo "Data not valid";
        return false;
    }
}
