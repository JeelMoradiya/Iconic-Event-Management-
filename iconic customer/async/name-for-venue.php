<?php
require_once("../Connection.php");
require_once("../Session.php");

if (isset($_POST["data"])) {
    $name = $_POST["data"];
    $fetchData = "SELECT venue.venue_id, ROUND(AVG(rating), 1) AS avg_rating, photo1, venue_name, per_hour_rent, per_day_rent, venue.address, description, CONCAT(first_name, ' ', last_name) AS full_name, capacity
    FROM venue
    LEFT JOIN venue_rating ON venue.venue_id = venue_rating.venue_id
    INNER JOIN user ON venue.manager_id = user.user_id
    WHERE venue_name LIKE '%$name%' OR venue.address LIKE '%$name%'
    GROUP BY venue.venue_id";

    $rsVenue = $conn->query($fetchData);
}
?>

<div id="list-style" class="tab-pane fade in active show">

    <!-- event-item - start -->
    <?php
    if ($rsVenue->num_rows > 0) {

        while ($row = $rsVenue->fetch_assoc()) {    ?>

            <div class="event-list-item clearfix">

                <!-- event-image - start -->
                <div class="event-image">
                    <div class="post-date">
                        <i class='fas fa-star'></i>
                        <span class="date"><?= $row['avg_rating'] ?></span>
                    </div>
                    <img src="assets/images/venues/<?= $row['photo1'] ?>" alt="Image_not_found">
                </div>
                <!-- event-image - end -->

                <!-- event-content - start -->
                <div class="event-content">
                    <div class="event-title mb-15">
                        <h3 class="title">
                            <strong><?= $row['venue_name'] ?></strong>
                        </h3>
                        <span class="ticket-price yellow-color">Per Hour Rent &#8377;<?= $row['per_hour_rent'] ?></span>
                        <br>
                        <span class="ticket-price yellow-color">Per Day Rent &#8377;<?= $row['per_day_rent'] ?></span>
                    </div>
                    <p class="discription-text mb-30">
                        <span class="icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </span>
                        <?= $row['address'] ?>
                    </p>
                    <p class="discription-text mb-30">
                        <?= $row['description'] ?>
                    </p>
                    <div class="event-info-list ul-li clearfix">
                        <ul>
                            <li>
                                <span class="icon">
                                    <i class="fas fa-microphone"></i>
                                </span>
                                <div class="info-content">
                                    <small>Manager</small>
                                    <h3><?= $row['full_name'] ?></h3>
                                </div>
                            </li>
                            <li>
                                <span class="icon">
                                    <i class="fas fa-ticket-alt"></i>
                                </span>
                                <div class="info-content">
                                    <small>Max Seats</small>
                                    <h3><?= $row['capacity'] ?> seats</h3>
                                </div>
                            </li>
                            <li>
                                <a href="./venue-details.php?i=<?= $row['venue_id'] ?>" class="tickets-details-btn">
                                    More Details
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- event-content - end -->

            </div>
        <?php
        }
        ?>
        <div class="pagination ul-li clearfix">
            <ul>
                <li class="page-item prev-item">
                    <a class="page-link" href="#!">Prev</a>
                </li>
                <li class="page-item"><a class="page-link" href="#!">01</a></li>
                <li class="page-item active"><a class="page-link" href="#!">02</a></li>
                <li class="page-item"><a class="page-link" href="#!">03</a></li>
                <li class="page-item"><a class="page-link" href="#!">04</a></li>
                <li class="page-item"><a class="page-link" href="#!">05</a></li>
                <li class="page-item next-item">
                    <a class="page-link" href="#!">Next</a>
                </li>
            </ul>
        </div>
    <?php
    } else {
        echo "<h1>No Venue Available</h1>";
    }
    ?>
    <!-- event-item - end -->

</div>
<!-- LIST STYLE END -->

<!-- GRID STYLE START -->
<div id="grid-style" class="tab-pane fade">
    <div class="row justify-content-center">

        <!-- event-grid-item - start -->
        <?php
        $rsVenue->data_seek(0);
        if ($rsVenue->num_rows > 0) {
            while ($row = $rsVenue->fetch_assoc()) {
        ?>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="event-grid-item">
                        <!-- event-image - start -->
                        <div class="event-image">
                            <div class="post-date">
                                <i class='fas fa-star'></i>
                                <span class="date"><?= $row['avg_rating'] ?></span>
                                <!-- <span class="date">26</span>
                                                        <small class="month">june</small> -->
                            </div>
                            <img src="assets/images/venues/<?= $row['photo1'] ?>" alt="Image_not_found">
                        </div>
                        <!-- event-image - end -->

                        <!-- event-content - start -->
                        <div class="event-content">
                            <div class="event-title mb-30">
                                <h3 class="title">
                                    <?= $row['venue_name'] ?>
                                </h3>
                                <span class="ticket-price yellow-color">Per Hour Rent &#8377;<?= $row['per_hour_rent'] ?></span>
                                <br>
                                <span class="ticket-price yellow-color">Per Day Rent &#8377;<?= $row['per_day_rent'] ?></span>
                            </div>
                            <div class="event-post-meta ul-li-block mb-30">
                                <ul>
                                    <li>
                                        <span class="icon">
                                            <i class="far fa-clock"></i>
                                        </span>
                                        <?= $row['description'] ?>
                                    </li>
                                    <li>
                                        <span class="icon">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </span>
                                        <?= $row['address'] ?>
                                    </li>
                                </ul>
                            </div>
                            <a href="./add-booking.php" class="tickets-details-btn">
                                More Details
                            </a>
                        </div>
                        <!-- event-content - end -->
                    </div>
                </div>
            <?php
            }
            ?>
            <!-- pagination - start -->
            <div class="pagination ul-li clearfix">
                <ul>
                    <li class="page-item prev-item">
                        <a class="page-link" href="#!">Prev</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#!">01</a></li>
                    <li class="page-item active"><a class="page-link" href="#!">02</a></li>
                    <li class="page-item"><a class="page-link" href="#!">03</a></li>
                    <li class="page-item"><a class="page-link" href="#!">04</a></li>
                    <li class="page-item"><a class="page-link" href="#!">05</a></li>
                    <li class="page-item next-item">
                        <a class="page-link" href="#!">Next</a>
                    </li>
                </ul>
            </div>
            <!-- pagination - end -->
        <?php
        } else {
            echo '<h1>No Venue Available</h1>';
        }
        ?>
        <!-- event-grid-item - end -->


    </div>
</div>