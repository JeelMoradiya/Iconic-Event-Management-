<?php
require_once("../Connection.php");

if (isset($_POST['data'])) {
    $country_id = $_POST['data'];
    $fetchCities = "SELECT city_id, city_name FROM city_master WHERE country_id = ? ORDER BY city_name";
    $stmt = $conn->prepare($fetchCities);
    $stmt->bind_param("i", $country_id);
    if ($stmt->execute()) {
        $rs = $stmt->get_result();
        if ($rs->num_rows > 0) {
            while ($row = $rs->fetch_array()) {
                echo sprintf("<option value='%s'>%s</option>", $row[0], $row[1]);
            }
        }
        else {
            echo "<option selected value=''>No Data</option>";
        }
    }
    else {
        echo "<option selected value=''>Error</option>";
    }
}
else {
    echo "<option selected value=''>Invalid Request</option>t";
}
?>