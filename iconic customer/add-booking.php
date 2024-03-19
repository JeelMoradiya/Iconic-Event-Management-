<?php
require_once("./Connection.php");
require_once("./Session.php");

if ( $session->get("userId") ) {

    if ( isset($_POST["venId"]) && isset($_POST["serviceType"]) && isset($_POST["price"])) {
        $venId = $_POST["venId"];
        $serviceType = $_POST["serviceType"];
        $decidedPrice = $_POST["price"];
        $userId = $session->get("userId");
        $status = "P";

        if ($serviceType == "V") {
            if ( $_POST["hStartDate"] != "" ) {
                $startDateTime = $_POST["hStartDate"] . " " . $_POST["hStartTime"];
                $endDateTime = $_POST["hEndDate"]. " " . $_POST["hEndTime"];
            }
            else {
                $startDateTime = $_POST["dStartDate"];
                $endDateTime = $_POST["dEndDate"];
            }
        }
        else {
            $startDateTime = $_POST["startDate"] . " " . $_POST["startTime"];
            $endDateTime = $_POST["endDate"]. " " . $_POST["endTime"];
        }

        // check if booking already exists
        $fetchBooking = "SELECT booking_id FROM booking_master
        WHERE customer_id = ? AND status = 'P'";
        $stmt = $conn->prepare($fetchBooking);
        $stmt->bind_param("i", $userId);
        
        if ($stmt->execute()) {
            $rs = $stmt->get_result();
            if ($rs->num_rows > 0) {
                // booking exists
                $bookingId = ($rs->fetch_array())[0];
            }
            else {
                // booking doesn't exist
                $addBookingMaster = "INSERT INTO booking_master (customer_id, status) VALUES (?, 'P')";
                $stmt = $conn->prepare($addBookingMaster);
                $stmt->bind_param("i", $userId);
                
                if ($stmt->execute()) {
                    $bookingId = $conn->insert_id;
                }
            }

            if ($serviceType == "C") {
                // Caterer Service
                $fetchBooking = "SELECT caterer_id FROM caterer_booking
                WHERE booking_id = ?";
                $stmt = $conn->prepare($fetchBooking);
                $stmt->bind_param("i", $bookingId);
                $stmt->execute();
                $rs = $stmt->get_result();
                if ($rs->num_rows > 0) {
                    // Caterer Already Booked
                    echo "<h1>You have already booked this caterer</h1>";
                }
                else {
                    // Caterer Not Booked
                    $addBooking = "INSERT INTO caterer_booking (booking_id, caterer_id, decided_price, start_datetime, end_datetime, status) 
                    VALUES (?, ?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($addBooking);
                    $stmt->bind_param("iidsss", $bookingId, $venId, $decidedPrice, $startDateTime, $endDateTime, $status);
                    if ($stmt->execute()) {
                        header("Location: ./booking.php?i=$bookingId");
                    }
                    else {
                        echo "<h1>Execution Error</h1>";
                    }
                }
            }
            if ($serviceType == "M") {
                // Musician  Service
                $fetchBooking = "SELECT musician_id FROM musician_booking
                WHERE booking_id = ?";
                $stmt = $conn->prepare($fetchBooking);
                $stmt->execute();
                $rs = $stmt->get_result();
                if ($rs->num_rows > 0) {
                    // Caterer Already Booked
                    echo "<h1>You have already booked this musician</h1>";
                }
                else {
                    // Caterer Not Booked
                    $addBooking = "INSERT INTO musician_booking (booking_id, musician_id, decided_price, start_datetime, end_datetime, status) 
                    VALUES (?, ?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($addBooking);
                    $stmt->bind_param("iidsss", $bookingId, $venId, $decidedPrice, $startDateTime, $endDateTime, $status);
                    if ($stmt->execute()) {
                        header("Location: ./booking.php?i=$bookingId");
                    }
                    else {
                        echo "<h1>Execution Error</h1>";
                    }
                }
            }
            if ($serviceType == "P") {
                // Photographer Service
                $fetchBooking = "SELECT photographer_id FROM photographer_booking
                WHERE booking_id = ?";
                $stmt = $conn->prepare($fetchBooking);
                $stmt->execute();
                $rs = $stmt->get_result();
                if ($rs->num_rows > 0) {
                    // Caterer Already Booked
                    echo "<h1>You have already booked this photographer</h1>";
                }
                else {
                    // Caterer Not Booked
                    $addBooking = "INSERT INTO photographer_booking (booking_id, photographer_id, decided_price, start_datetime, end_datetime, status) 
                    VALUES (?, ?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($addBooking);
                    $stmt->bind_param("iidsss", $bookingId, $venId, $decidedPrice, $startDateTime, $endDateTime, $status);
                    if ($stmt->execute()) {
                        header("Location: ./booking.php?i=$bookingId");
                    }
                    else {
                        echo "<h1>Execution Error</h1>";
                    }
                }
            }
            if ($serviceType == "V") {
                // Venue Service
                $fetchBooking = "SELECT venue_id FROM venue_booking
                WHERE booking_id = ?";
                $stmt = $conn->prepare($fetchBooking);
                $stmt->bind_param("i", $bookingId);
                $stmt->execute();
                $rs = $stmt->get_result();
                if ($rs->num_rows > 0) {
                    // Venue Already Booked
                    echo "<h1>You have already booked this venue</h1>";
                }
                else {
                    // Venue Not Booked
                    $addBooking = "INSERT INTO venue_booking (booking_id, venue_id, decided_price, start_datetime, end_datetime, status) 
                    VALUES (?, ?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($addBooking);
                    $stmt->bind_param("iidsss", $bookingId, $venId, $decidedPrice, $startDateTime, $endDateTime, $status);
                    if ($stmt->execute()) {
                        header("Location: ./booking.php?i=$bookingId");
                    }
                    else {
                        echo "<h1>Execution Error</h1>";
                    }
                }
            }
        }
    }
    else {
        echo "Invalid Request";
    }
}
else {
    header("Location: ./login.php");
}
?>