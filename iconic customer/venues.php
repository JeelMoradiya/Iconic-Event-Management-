<?php
require_once("./Connection.php");
require_once("./Session.php");

if (isset($_GET["t"])) {
    $typeId = $_GET["t"];
    // echo "<h1>".$typeId."</h1>";
    $fetchVenueByType = "SELECT venue.venue_id, ROUND(AVG(rating), 1) AS avg_rating, photo1, venue_name, per_hour_rent, per_day_rent, venue.address, description, CONCAT(first_name, ' ', last_name) AS full_name, capacity
    FROM venue
    LEFT JOIN venue_rating ON venue.venue_id = venue_rating.venue_id
    INNER JOIN user ON venue.manager_id = user.user_id
    WHERE type_id = ?
    GROUP BY venue.venue_id";

    $stmt = $conn->prepare($fetchVenueByType);
    $stmt->bind_param("i", $typeId);
    if ($stmt->execute()) {
        // echo "<h1>Executed !</h1>";
        $rsVenue = $stmt->get_result();
    }
} else if (isset($_GET["c"])) {
    $cityId = $_GET["c"];

    $fetchVenueByCity = "SELECT venue.venue_id, ROUND(AVG(rating), 1) AS avg_rating, photo1, venue_name, per_hour_rent, per_day_rent, venue.address, description, CONCAT(first_name, ' ', last_name) AS full_name, capacity
    FROM venue
    LEFT JOIN venue_rating ON venue.venue_id = venue_rating.venue_id
    INNER JOIN user ON venue.manager_id = user.user_id
    WHERE venue.city_id = ?
    GROUP BY venue.venue_id";

    $stmt = $conn->prepare($fetchVenueByCity);
    $stmt->bind_param("i", $cityId);
    if ($stmt->execute()) {
        $rsVenue = $stmt->get_result();
    }
} else {
    $fetchAllVenues = "SELECT venue.venue_id, ROUND(AVG(rating), 1) AS avg_rating, photo1, venue_name, per_hour_rent, per_day_rent, venue.address, description, CONCAT(first_name, ' ', last_name) AS full_name, capacity
    FROM venue
    LEFT JOIN venue_rating ON venue.venue_id = venue_rating.venue_id
    INNER JOIN user ON venue.manager_id = user.user_id
    GROUP BY venue.venue_id";

    $rsVenue = $conn->query($fetchAllVenues);
}

$fetchVenueTypes = "SELECT * FROM venue_type";
$rsType = $conn->query($fetchVenueTypes);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Iconic - Venues</title>
    <link rel="shortcut icon" href="assets/images/favicon.png">

    <!-- framework - css include -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <!-- icon css include -->
    <link rel="stylesheet" type="text/css" href="assets/css/fontawesome-all.css">
    <link rel="stylesheet" type="text/css" href="assets/css/flaticon.css">

    <!-- carousel css include -->
    <link rel="stylesheet" type="text/css" href="assets/css/slick.css">
    <link rel="stylesheet" type="text/css" href="assets/css/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="assets/css/animate.css">
    <link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/owl.theme.default.min.css">

    <!-- others css include -->
    <link rel="stylesheet" type="text/css" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/calendar.css">

    <!-- color switcher css include -->
    <link rel="stylesheet" type="text/css" href="assets/css/colors/style-switcher.css">
    <link id="color_theme" rel="stylesheet" type="text/css" href="assets/css/colors/default.css">

    <!-- custom css include -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">


</head>


<body class="default-header-p">





    <!-- backtotop - start -->
    <div id="thetop" class="thetop"></div>
    <div class='backtotop'>
        <a href="#thetop" class='scroll'>
            <i class="fas fa-angle-double-up"></i>
        </a>
    </div>
    <!-- backtotop - end -->

    <!-- preloader - start -->
    <div id="preloader"></div>
    <!-- preloader - end -->




    <!-- header-section - start
		================================================== -->
    <?php include_once("./header-2.php"); ?>
    <!-- header-section - end
		================================================== -->
    <!-- breadcrumb-section - start
		================================================== -->
    <section id="breadcrumb-section" class="breadcrumb-section clearfix">
        <div class="jarallax" style="background-image: url(assets/images/breadcrumb/0.breadcrumb-bg.jpg);">
            <div class="overlay-black">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-12 col-sm-12">

                            <!-- breadcrumb-title - start -->
                            <div class="breadcrumb-title text-center mb-50">
                                <span class="sub-title">iconic events</span>
                                <h2 class="big-title">iconic <strong>venues</strong></h2>
                            </div>
                            <!-- breadcrumb-title - end -->

                            <!-- breadcrumb-list - start -->
                            <div class="breadcrumb-list">
                                <ul>
                                    <li class="breadcrumb-item"><a href="index-1.php" class="breadcrumb-link">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">venues</li>
                                </ul>
                            </div>
                            <!-- breadcrumb-list - end -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb-section - end
		================================================== -->





    <!-- event-search-section - start
		================================================== -->
    <section id="event-search-section" class="event-search-section clearfix" style="background-image: url(assets/images/special-offer-bg.png);">
        <div class="container">
            <div class="row">

                <!-- section-title - start -->
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="section-title">
                        <small class="sub-title">Find best venue on Iconic</small>
                        <h2 class="big-title">Venue <strong>Search</strong></h2>
                    </div>
                </div>
                <!-- section-title - end -->

                <!-- search-form - start -->
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <div class="search-form form-wrapper">
                        <!-- <form action="#!"> -->

                            <ul>
                                <li>
                                    <span class="title">venue keyword</span>
                                    <div class="form-item">
                                        <input id="txtSearch" type="search" placeholder="venue name or location">
                                    </div>
                                </li>
                                <li>
                                    <span class="title">venue category</span>
                                    <select id="event-category-select">
                                        <?php
                                        if ($rsType->num_rows > 0) {
                                            while ($rowType = $rsType->fetch_assoc()) {
                                                echo sprintf(
                                                    "<option value='%s'>%s</option>",
                                                    $rowType['type_id'],
                                                    $rowType['type_name']
                                                );
                                            }
                                        } else {
                                            echo "<option value=''>No Data</option>";
                                        }
                                        ?>
                                    </select>
                                </li>
                                <li>
                                    <button id="btnSearch" type="submit" class="submit-btn">search now</button>
                                </li>
                            </ul>

                        <!-- </form> -->
                    </div>
                </div>
                <!-- search-form - end -->

            </div>
        </div>
    </section>
    <!-- event-search-section - end
		================================================== -->





    <!-- event-section - start
		================================================== -->
    <section id="event-section" class="event-section bg-gray-light sec-ptb-100 clearfix">
        <div class="container">
            <div class="row justify-content-center">

                <!-- - start -->
                <div class="col-lg-9 col-md-12 col-sm-12">

                    <div class="search-result-form">
                        <!-- <form action="#!">
                            <ul>

                                <li>
                                    <span class="result-text"><strong id="searchCount"></strong> Search results</span>
                                </li>
                                <li>
                                    <label for="year-select">Years:</label>
                                    <select id="year-select">
                                        <option selected="">2018</option>
                                        <option value="1">2019</option>
                                        <option value="2">2020</option>
                                        <option value="3">2021</option>
                                    </select>
                                </li>
                                <li>
                                    <label for="munth-select">Months:</label>
                                    <select id="munth-select">
                                        <option selected="">June</option>
                                        <option value="1">July</option>
                                        <option value="2">August</option>
                                    </select>
                                </li>

                            </ul>
                        </form> -->

                        <ul class="nav event-layout-btngroup">
                            <li><a class="active" data-toggle="tab" href="#list-style"><i class="fas fa-th-list"></i></a></li>
                            <li><a data-toggle="tab" href="#grid-style"><i class="fas fa-th"></i></a></li>
                        </ul>
                    </div>

                    <div id="rsContainer" class="tab-content">
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
                    </div>

                </div>
                <!-- - end -->

            </div>
        </div>
    </section>
    <!-- event-section - end
		================================================== -->





    <!-- default-footer-section - start
		================================================== -->
    <?php
    include_once("./footer.php");
    ?>
    <!-- default-footer-section - end
		================================================== -->










    <!-- fraimwork - jquery include -->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- carousel jquery include -->
    <script src="assets/js/slick.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>

    <!-- map jquery include -->
    <script src="assets/js/gmap3.min.js"></script>
    <script src="http://maps.google.com/maps/api/js?key=AIzaSyC61_QVqt9LAhwFdlQmsNwi5aUJy9B2SyA"></script>

    <!-- calendar jquery include -->
    <script src="assets/js/atc.min.js"></script>

    <!-- others jquery include -->
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/isotope.pkgd.min.js"></script>
    <script src="assets/js/jarallax.min.js"></script>
    <script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>

    <!-- gallery img loaded - jqury include -->
    <script src="assets/js/imagesloaded.pkgd.min.js"></script>

    <!-- multy count down - jqury include -->
    <script src="assets/js/jquery.countdown.js"></script>

    <!-- color panal - jqury include -->
    <script src="assets/js/style-switcher.js"></script>

    <!-- custom jquery include -->
    <script src="assets/js/custom.js"></script>


    <script>
        window.onload = function() {
            let txtSearch = document.getElementById("txtSearch");
            let selCategory = document.getElementById("event-category-select");
            let btnSearch = document.getElementById("btnSearch");
            let rsContainer = document.getElementById("rsContainer");

            btnSearch.addEventListener("click", function() {
                if (txtSearch.value != "") {
                    const xhr = new XMLHttpRequest();
					const data = "data="+txtSearch.value;
					xhr.open("POST", "./async/name-for-venue.php", true);
					xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					xhr.onload = function() {
						rsContainer.innerHTML = this.responseText;
					}
					xhr.onerror = function() {
						alert("Server-side Error");
					}
					xhr.send(data);
                }
            });

            selCategory.addEventListener("change", function() {
                const xhr = new XMLHttpRequest();
					const data = "data="+selCategory.value;
					xhr.open("POST", "./async/cat-for-venue.php", true);
					xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					xhr.onload = function() {
						rsContainer.innerHTML = this.responseText;
					}
					xhr.onerror = function() {
						alert("Server-side Error");
					}
					xhr.send(data);
            });
        }
    </script>


</body>

</html>