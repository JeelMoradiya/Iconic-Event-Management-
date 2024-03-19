<?php
require_once("../Connection.php");

if (isset($_POST['data'])) {
    $country_id = $_POST['data'];
    $fetchCode = "SELECT country_code FROM country_master WHERE country_id = ?";
    $stmt = $conn->prepare($fetchCode);
    $stmt->bind_param("i", $country_id);
    if ($stmt->execute()) {
        $rs = $stmt->get_result();
        if ($rs->num_rows > 0) {
            $row = $rs->fetch_array();
            echo $row[0];
        }
        else {
            echo "No Data";
        }
    }
    else {
        echo "Error";
    }
}
else {
    echo "Invalid Request";
}
?>