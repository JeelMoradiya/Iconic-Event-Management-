<?php
require_once("../Connection.php");

if (isset($_POST["data"])) {
    $cityId = $_POST["data"];

    $fetchVenues = "SELECT venue.venue_id, photo1, ROUND(AVG(rating), 1) AS rating, venue_name, capacity, per_day_rent
				FROM venue
				LEFT JOIN venue_rating ON venue.venue_id = venue_rating.venue_id
                WHERE city_id = ?
				GROUP BY venue_id";
    $stmt = $conn->prepare($fetchVenues);
    $stmt->bind_param("i", $cityId);

    if ($stmt->execute()) {
        $rs = $stmt->get_result();

        if ($rs->num_rows > 0) {
            while ($row = $rs->fetch_assoc()) {
                echo sprintf(
                    "<li class='nav-item'>
                        <a class='nav-link active' id='nav-one-tab' data-toggle='tab' href='#%s' aria-expanded='true'>
                            <span class='image'>
                                <img src='assets/images/venues/%s' alt='Image_not_found'>
                            </span>
                            <span class='title'>
                                <strong class='yellow-color'>%s <i class='fas fa-star'></i> %s </strong>	
                            </span>
                            <small class='sub-title'>Capacity %s seats</small>
                            <small class='price yellow-color'>Price from %s/day</small>
                        </a>
                    </li>",
                    $row['venue_id'],
                    $row['photo1'],
                    $row['rating'],
                    $row['venue_name'],
                    $row['capacity'],
                    $row['per_day_rent']
                );
            }
        }
        else {
            echo 
            "<li class='nav-item'>
                <a class='nav-link active' id='nav-one-tab' data-toggle='tab' href='#' aria-expanded='true'>
                    <span class='image'>
                        <img src='assets/images/venues/' alt='Image_not_found'>
                    </span>
                    <span class='title'>
                        <strong class='yellow-color'></i> No Venue Available </strong>	
                    </span>
                    
                </a>
            </li>";
        }
    }
    else {
        echo 
            "<li class='nav-item'>
                <a class='nav-link active' id='nav-one-tab' data-toggle='tab' href='#' aria-expanded='true'>
                    <span class='image'>
                        <img src='assets/images/venues/' alt='Image_not_found'>
                    </span>
                    <span class='title'>
                        <strong class='yellow-color'></i> Execution Error </strong>	
                    </span>
                </a>
            </li>";
    }
}
else {
    echo 
    "<li class='nav-item'>
        <a class='nav-link active' id='nav-one-tab' data-toggle='tab' href='#' aria-expanded='true'>
            <span class='image'>
                <img src='assets/images/venues/' alt='Image_not_found'>
            </span>
            <span class='title'>
                <strong class='yellow-color'></i> Invalid Request Error </strong>	
            </span>
        </a>
    </li>";
}
?>