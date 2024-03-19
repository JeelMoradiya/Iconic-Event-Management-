<?php
require_once("./Connection.php");
require_once("./Session.php");

// $conn->close();
$session->destroy();

header("Location: ./login.php");
?>