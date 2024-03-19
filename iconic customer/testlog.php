<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<?php
require_once "./Connection.php";
require_once "./Session.php";


if (isset($_POST['txtEmail']) && isset($_POST['txtPass'])) {

    $txtEmail = $_POST['txtEmail'];
    $txtPass = $_POST['txtPass'];

    // set remember me cookie for 30 days
    if (isset($_POST['chkRemember'])) {
        setcookie("ckEmail", $txtEmail, time() + 86400 * 30);
        setcookie("ckPass", $txtPass, time() + 86400 * 30);
    }
    if (validateEmail() && validatePass() && isRegistered() && isVerified()) {
        echo "success";
        header("Location: ./index-1.php");
    }
}
else {
    echo "Email or Pass Not Set";
}

// --------------------------------------------------------------------------------------------------------------
// FUNCTIONS
// --------------------------------------------------------------------------------------------------------------

function validateEmail() {
    global $txtEmail;
    $emailRegex = "/^[a-zA-Z0-9._!#$%&'*+=?^_`{|}~-]+@{1}(?:gmail.com|yahoo.com|yahoo.in|utu.ac.in|hotmail.in)$/";

    // if email is empty
    if (empty($txtEmail)) {
        echo 'Please enter email';
        return false;
    }
    // if email is invalid 
    elseif (!preg_match($emailRegex, $txtEmail)) {
        echo 'Enter valid email';
        return false;
    }
    else {
        return true;
    }
}

function validatePass() {
    global $txtPass;
    if (empty($txtPass)) {
        echo 'Please enter password';
        return false;
    }
    // elseif (strlen($txtPass) < 8) {
    //     echo "Password must have atleast 8 characters";
    //     return false;
    // }
    else {
        return true;
    }
}

function isRegistered() {
    global $conn, $session, $txtEmail, $txtPass;
    // check whether registered or not
    $fetchUser = "SELECT user_id FROM user WHERE user_type = 'U' AND is_active = 1 AND email_id = ? AND password = ?";
    $stmt = $conn->prepare($fetchUser);
    $stmt->bind_param("ss", $txtEmail, $txtPass);
    // if statement executes successfully
    if ($stmt->execute()) {
        $rs = $stmt->get_result();
        if ($rs -> num_rows == 1) {
            $row = $rs->fetch_array();
            // $session->set("userId", $row[0]);
            return true;
        }
        else {
            echo "Incorrect email or password";
            return false;
        }
        
    } else {
        echo "Error in executing query";
        return false;
    }
}

function isVerified() {
    global $conn, $session, $txtEmail, $txtPass;
    // check whether registered or not
    $fetchUser = "SELECT user_id FROM user WHERE user_type = 'U' AND is_active = 1 AND email_id = ? AND password = ? AND code != ''";
    $stmt = $conn->prepare($fetchUser);
    $stmt->bind_param("ss", $txtEmail, $txtPass);
    // if statement executes successfully
    if ($stmt->execute()) {
        $rs = $stmt->get_result();
        if ($rs -> num_rows == 1) {
            $row = $rs->fetch_array();
            $session->set("userId", $row[0]);
            return true;
        }
        else {
            echo "<div class='alert alert-danger'>User is not verified.</div>";
            return false;
        }
        
    } else {
        echo "<div class='alert alert-danger'>Error in executing query</div>";
        return false;
    }
}


function isRegisteredWithHash() {
    global $conn, $txtEmail, $txtPass;
    $hash = base64_encode($txtPass);

    // check whether registered or not
    $fetchUser = "SELECT user_id FROM user WHERE user_type = 'U' AND is_active = 1 AND email_id = ? AND password = ?";
    $stmt = $conn->prepare($fetchUser);
    $stmt->bind_param("ss", $txtEmail, $hash);
    // if statement executes successfully
    if ($stmt->execute()) {
        $rs = $stmt->get_result();
        if ($rs -> num_rows == 1) {
            $row = $rs->fetch_assoc();
            $_SESSION['userId'] = $row['userId'];
            return true;
        }
        else {
            echo "<div class='alert alert-danger'>Incorrect email or password</div>";
            return false;
        }
        
    } else {
        echo "<div class='alert alert-danger'>Error in executing query</div>";
        return false;
    }
}
?>
</body>
</html>