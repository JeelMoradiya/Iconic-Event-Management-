<?php
require_once("./Connection.php");
require_once("./Session.php");

if (isset($_GET["i"])) {
    $venueId = $_GET["i"];
    $serviceType = "V";
    $fetchVenueDetails = "SELECT venue_name, city_name, CONCAT(first_name, ' ', last_name) AS manager_name, manager_id, type_name, venue.address, description, terms, per_hour_rent, per_day_rent, photo1, photo2, photo3, photo4
    FROM venue
    INNER JOIN city_master ON venue.city_id = city_master.city_id
    INNER JOIN user ON venue.manager_id = user.user_id
    INNER JOIN venue_type ON venue.type_id = venue_type.type_id
    WHERE venue.venue_id = ?";

    $venueStmt = $conn->prepare($fetchVenueDetails);
    $venueStmt->bind_param("i", $venueId);
    if ($venueStmt->execute()) {
        $rsVenue = $venueStmt->get_result();
        if ($rsVenue->num_rows == 1) {
            $venueRow = $rsVenue->fetch_assoc();
            $vendorId = $venueRow['manager_id'];
        }
    }
} else {
    echo "<h1>Invalid Request</h1>";
}

if ($session->get("userId")) {
    $userId = $session->get("userId");
    $fetchUser = "SELECT CONCAT(first_name, ' ', last_name) AS full_name, email_id, contact
    FROM user WHERE user_id = ?";
    $userStmt = $conn->prepare($fetchUser);
    $userStmt->bind_param("i", $userId);
    $userStmt->execute();
    $rsUser = $userStmt->get_result();
    $userRow = $rsUser->fetch_assoc();
    $fullName = $userRow['full_name'];
    $emailId = $userRow['email_id'];
    $contact = $userRow['contact'];
} else {
    $fullName = "";
    $emailId = "";
    $contact = "";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Iconic - Venue Details</title>
    <link rel="shortcut icon" href="assets/images/favicon.png">

    <!-- fraimwork - css include -->
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





    <!-- altranative-header - start
		================================================== -->
    <div class="header-altranative">
        <div class="container">
            <div class="logo-area float-left">
                <a href="index-1.html">
                    <img src="assets/images/1.site-logo.png" alt="logo_not_found">
                </a>
            </div>

            <button type="button" id="sidebarCollapse" class="alt-menu-btn float-right">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- sidebar menu - start -->
        <div class="sidebar-menu-wrapper">
            <div id="sidebar" class="sidebar">
                <span id="sidebar-dismiss" class="sidebar-dismiss">
                    <i class="fas fa-arrow-left"></i>
                </span>

                <div class="sidebar-header">
                    <a href="#!">
                        <img src="assets/images/2.site-logo.png" alt="logo_not_found">
                    </a>
                </div>

                <!-- sidebar-form - start -->
                <div class="sidebar-form">
                    <form action="#">
                        <input id="altmenu-sidebar-search" type="search" placeholder="Search">
                        <label for="altmenu-sidebar-search"><i class="fas fa-search"></i></label>
                    </form>
                </div>
                <!-- sidebar-form - end -->

                <!-- main-pages-links - start -->
                <div class="menu-link-list main-pages-links">
                    <h2 class="menu-title">all home pages</h2>
                    <ul>
                        <li>
                            <a href="index-1.html">
                                <span class="icon"><i class="fas fa-home"></i></span>
                                Home V.1
                            </a>
                        </li>
                        <li>
                            <a href="index-2.html">
                                <span class="icon"><i class="fas fa-home"></i></span>
                                Home V.2
                            </a>
                        </li>
                        <li>
                            <a href="index-3.html">
                                <span class="icon"><i class="fas fa-home"></i></span>
                                Home v.3
                            </a>
                        </li>
                        <li>
                            <a href="index-4.html">
                                <span class="icon"><i class="fas fa-home"></i></span>
                                Home v.4
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- main-pages-links - end -->

                <!-- other-pages-links - start -->
                <div class="menu-link-list other-pages-links">
                    <h2 class="menu-title">all single pages</h2>
                    <ul>
                        <li>
                            <a href="about.html">
                                <span class="icon"><i class="fas fa-home"></i></span>
                                About Us
                            </a>
                        </li>
                        <li>
                            <a href="service.html">
                                <span class="icon"><i class="fas fa-home"></i></span>
                                our Services
                            </a>
                        </li>
                        <li>
                            <a href="event-1.html">
                                <span class="icon"><i class="fas fa-home"></i></span>
                                event list
                            </a>
                        </li>
                        <li>
                            <a href="event-2.html">
                                <span class="icon"><i class="fas fa-home"></i></span>
                                event grid
                            </a>
                        </li>
                        <li>
                            <a href="event-1-without-sidebar.html">
                                <span class="icon"><i class="fas fa-home"></i></span>
                                list without sidebar
                            </a>
                        </li>
                        <li>
                            <a href="event-2-without-sidebar.html">
                                <span class="icon"><i class="fas fa-home"></i></span>
                                grid without sidebar
                            </a>
                        </li>
                        <li>
                            <a href="blog.html">
                                <span class="icon"><i class="fas fa-home"></i></span>
                                Latest blogs
                            </a>
                        </li>
                        <li>
                            <a href="gallery.html">
                                <span class="icon"><i class="fas fa-home"></i></span>
                                our gallery
                            </a>
                        </li>
                        <li>
                            <a href="speaker.html">
                                <span class="icon"><i class="fas fa-home"></i></span>
                                event speakers
                            </a>
                        </li>
                        <li>
                            <a href="contact.html">
                                <span class="icon"><i class="fas fa-home"></i></span>
                                contact us
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- other-pages-links - end -->

                <!-- inner-pages-links - start -->
                <div class="menu-link-list inner-pages-links">
                    <h2 class="menu-title">all inner pages</h2>
                    <ul>
                        <li>
                            <a href="booking.html">
                                <span class="icon"><i class="fas fa-home"></i></span>
                                event booking
                            </a>
                        </li>
                        <li class="active">
                            <a href="event-details.html">
                                <span class="icon"><i class="fas fa-home"></i></span>
                                event details
                            </a>
                        </li>
                        <li>
                            <a href='blog-details.html'>
                                <span class="icon"><i class="fas fa-home"></i></span>
                                blog details
                            </a>
                        </li>
                        <li>
                            <a href="faq.html">
                                <span class="icon"><i class="fas fa-home"></i></span>
                                Frequently Ask Qusetion
                            </a>
                        </li>
                        <li>
                            <a href="404-error.html">
                                <span class="icon"><i class="fas fa-home"></i></span>
                                404 error
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- inner-pages-links - end -->

                <!-- login-btn-group - start -->
                <div class="login-btn-group">
                    <ul>

                        <li>
                            <a href="#alt-register-modal" class="register-modal-btn">
                                Register
                            </a>
                            <div id="alt-register-modal" class="reglog-modal-wrapper register-modal mfp-hide clearfix" style="background-image: url(assets/images/login-modal-bg.jpg);">
                                <div class="overlay-black clearfix">

                                    <!-- leftside-content - start -->
                                    <div class="leftside-content">
                                        <div class="site-logo-wrapper mb-80">
                                            <a href="#!" class="logo">
                                                <img src="assets/images/2.site-logo.png" alt="logo_not_found">
                                            </a>
                                        </div>
                                        <div class="register-login-link mb-80">
                                            <ul>
                                                <li><a href="#!">Login</a></li>
                                                <li class="active"><a href="#!">Register</a></li>
                                            </ul>
                                        </div>
                                        <div class="copyright-text">
                                            <p class="m-0">©2018 <a href="#!" class="yellow-color">Harmoni.com</a> all right reserved, made with <i class="fas fa-heart"></i> by jThemes Studio </p>
                                        </div>
                                    </div>
                                    <!-- leftside-content - end -->

                                    <!-- rightside-content - start -->
                                    <div class="rightside-content text-center">

                                        <div class="mb-30">
                                            <h2 class="form-title title-large white-color">Account <strong>Register</strong></h2>
                                            <span class="form-subtitle white-color">Have an account? <strong>LOGIN NOW</strong></span>
                                        </div>

                                        <div class="login-form text-center mb-50">
                                            <form action="#!">
                                                <div class="form-item">
                                                    <input type="email" placeholder="User Name">
                                                </div>
                                                <div class="form-item">
                                                    <input type="password" placeholder="Password">
                                                </div>
                                                <div class="form-item">
                                                    <input type="email" placeholder="Repeat Password">
                                                </div>
                                                <div class="form-item">
                                                    <input type="password" placeholder="Email Address">
                                                </div>
                                                <div class="human-verification text-left">
                                                    <input type="checkbox" id="alt-imnotarobot">
                                                    <label for="alt-imnotarobot">I'm not a robot</label>
                                                    <span class="verification-image">
                                                        <img src="assets/images/iamnotrobot.png" alt="Image_not_found">
                                                    </span>
                                                </div>
                                                <button type="submit" class="login-btn">login now</button>
                                            </form>
                                        </div>

                                        <div class="bottom-text white-color">
                                            <p class="m-0">
                                                * Denotes mandatory field.
                                            </p>
                                            <p class="m-0">** At least one telephone number is required.</p>
                                        </div>

                                    </div>
                                    <!-- rightside-content - end -->

                                    <a class="popup-modal-dismiss" href="#!">
                                        <i class="fas fa-times"></i>
                                    </a>

                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="#alt-login-modal" class="login-modal-btn">
                                Login
                            </a>
                            <div id="alt-login-modal" class="reglog-modal-wrapper mfp-hide clearfix" style="background-image: url(assets/images/login-modal-bg.jpg);">
                                <div class="overlay-black clearfix">

                                    <!-- leftside-content - start -->
                                    <div class="leftside-content">
                                        <div class="site-logo-wrapper mb-80">
                                            <a href="#!" class="logo">
                                                <img src="assets/images/2.site-logo.png" alt="logo_not_found">
                                            </a>
                                        </div>
                                        <div class="register-login-link mb-80">
                                            <ul>
                                                <li class="active"><a href="#!">Login</a></li>
                                                <li><a href="#!">Register</a></li>
                                            </ul>
                                        </div>
                                        <div class="copyright-text">
                                            <p class="m-0">©2018 <a href="#!" class="yellow-color">Harmoni.com</a> all right reserved, made with <i class="fas fa-heart"></i> by jThemes Studio </p>
                                        </div>
                                    </div>
                                    <!-- leftside-content - end -->

                                    <!-- rightside-content - start -->
                                    <div class="rightside-content text-center">

                                        <div class="mb-30">
                                            <h2 class="form-title title-large white-color">Account <strong>Login</strong></h2>
                                            <span class="form-subtitle white-color">Login to our website, or <strong>REGISTER</strong></span>
                                        </div>

                                        <div class="fb-login-btn mb-30">
                                            <a href="#!">
                                                <span class="icon">
                                                    <i class="fab fa-facebook-f"></i>
                                                </span>
                                                login with facebook
                                            </a>
                                        </div>

                                        <div class="or-text mb-30">
                                            <span>or sign in</span>
                                        </div>

                                        <div class="login-form text-center mb-50">
                                            <form action="#!">
                                                <div class="form-item">
                                                    <input type="email" placeholder="example@gmail.com">
                                                </div>
                                                <div class="form-item">
                                                    <input type="password" placeholder="Password">
                                                </div>
                                                <button type="submit" class="login-btn">login now</button>
                                            </form>
                                        </div>

                                        <div class="bottom-text white-color">
                                            <p class="m-0">
                                                * Denotes mandatory field.
                                            </p>
                                            <p class="m-0">** At least one telephone number is required.</p>
                                        </div>

                                    </div>
                                    <!-- rightside-content - end -->

                                    <a class="popup-modal-dismiss" href="#!">
                                        <i class="fas fa-times"></i>
                                    </a>

                                </div>
                            </div>
                        </li>

                    </ul>
                </div>
                <!-- login-btn-group - end -->

                <!-- social-links - start -->
                <div class="social-links">
                    <h2 class="menu-title">get in touch</h2>
                    <div class="mb-15">
                        <h3 class="contact-info">
                            <i class="fas fa-phone"></i>
                            100-2222-9999
                        </h3>
                        <h3 class="contact-info">
                            <i class="fas fa-envelope"></i>
                            info@harmoni.com
                        </h3>
                    </div>
                    <ul>
                        <li>
                            <a href="#!"><i class="fab fa-facebook-f"></i></a>
                        </li>
                        <li>
                            <a href="#!"><i class="fab fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="#!"><i class="fab fa-twitch"></i></a>
                        </li>
                        <li>
                            <a href="#!"><i class="fab fa-google-plus-g"></i></a>
                        </li>
                        <li>
                            <a href="#!"><i class="fab fa-instagram"></i></a>
                        </li>
                    </ul>
                    <a href="contact.html" class="contact-btn">contact us</a>
                </div>
                <!-- social-links - end -->

                <div class="overlay"></div>
            </div>
        </div>
        <!-- sidebar menu - end -->
    </div>
    <!-- altranative-header - end
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
                                <span class="sub-title">Venue Single</span>
                                <h2 class="big-title">Iconic <strong>Venue Details</strong></h2>
                            </div>
                            <!-- breadcrumb-title - end -->

                            <!-- breadcrumb-list - start -->
                            <div class="breadcrumb-list">
                                <ul>
                                    <li class="breadcrumb-item"><a href="index-1.html" class="breadcrumb-link">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Venues</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><?= $venueRow['venue_name'] ?></li>
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





    <!-- event-details-section - start
		================================================== -->
    <section id="event-details-section" class="event-details-section sec-ptb-100 clearfix">
        <div class="container">
            <div class="row">

                <!-- col-lg-8 - event-details - start -->
                <div class="col-lg-8 col-md-12 col-sm-12">

                    <!-- event-details - start -->
                    <div class="event-details mb-80">

                        <div class="event-title mb-30">
                            <span class="tag-item">
                                <i class="fas fa-bookmark"></i>
                                Featured Venue
                            </span>
                            <h2 class="event-title"><strong><?= $venueRow['venue_name'] ?></strong></h2>
                        </div>

                        <div id="event-details-carousel" class="event-details-carousel owl-carousel owl-theme">
                            <div class="item">
                                <img src="assets/images/event/<?= $venueRow['photo1'] ?>" alt="Image_not_found">
                            </div>
                            <div class="item">
                                <img src="assets/images/event/<?= $venueRow['photo2'] ?>" alt="Image_not_found">
                            </div>
                            <div class="item">
                                <img src="assets/images/event/<?= $venueRow['photo3'] ?>" alt="Image_not_found">
                            </div>
                            <div class="item">
                                <img src="assets/images/event/<?= $venueRow['photo4'] ?>" alt="Image_not_found">
                            </div>
                        </div>

                        <div class="event-info-list ul-li clearfix mb-50">
                            <ul>
                                <li>
                                    <span class="icon">
                                        <i class="far fa-calendar"></i>
                                    </span>
                                    <div class="event-content">
                                        <small class="event-title">Status</small>
                                        <h3 class="event-date">Available</h3>
                                    </div>
                                </li>
                                <li>
                                    <span class="icon">
                                        <i class="far fa-clock"></i>
                                    </span>
                                    <div class="event-content">
                                        <small class="event-title">Venue Type</small>
                                        <h3 class="event-date"><?= $venueRow['type_name'] ?></h3>
                                    </div>
                                </li>
                                <li>
                                    <span class="icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                    <div class="event-content">
                                        <small class="event-title">City</small>
                                        <h3 class="event-date"><?= $venueRow['city_name'] ?></h3>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="section-title text-left mb-50">
                            <span class="line-style"></span>
                            <h3 class="big-title">Venue <strong>Description</strong></h3>
                        </div>
                        <p class="black-color mb-30">
                            <?= $venueRow['description'] ?>
                        </p>
                        <br><br>

                        <div class="section-title text-left mb-50">
                            <span class="line-style"></span>
                            <h3 class="big-title">Venue <strong>Terms</strong></h3>
                        </div>
                        <p class="black-color mb-30">
                            <?= $venueRow['terms'] ?>
                        </p>

                    </div>
                    <!-- event-details - end -->

                    <div class="event-details mb-80">

                        <div class="section-title text-left mb-50">
                            <span class="line-style"></span>
                            <h3 class="big-title">Select <strong>Your Booking</strong></h3>
                        </div>

                        <form id="bookingForm" action="./add-booking.php" method="post">

                            <input type="hidden" name="venId" value="<?= $venueId ?>">
                            <input type="hidden" name="serviceType" value="<?= $serviceType ?>">

                            <select id="selType" class="form-control" aria-label="Select Type">
                                <option selected disabled value="">Select Type</option>
                                <option value="d">Per Day</option>
                                <option value="h">Per Hour</option>
                            </select>

                            <br>

                            <div id="hourDiv">
                                <div class="input-group mb-4">
                                    <span class="input-group-text">Start Date</span>
                                    <input type="date" id="hStartDate" name="hStartDate" class="form-control">
                                    <span class="input-group-text">Start Time</span>
                                    <input type="time" id="hStartTime" name="hStartTime" class="form-control">
                                </div>
                                <div class="input-group mb-4">
                                    <span class="input-group-text">End Date</span>
                                    <input type="date" id="hEndDate" name="hEndDate" class="form-control">
                                    <span class="input-group-text">End Time</span>
                                    <input type="time" id="hEndTime" name="hEndTime" class="form-control">
                                </div>
                            </div>


                            <div id="dayDiv">
                                <div class="input-group mb-4">
                                    <span class="input-group-text">Start Date</span>
                                    <input type="date" id="dStartDate" name="dStartDate" class="form-control">
                                    <span class="input-group-text">End Date</span>
                                    <input type="date" id="dEndDate" name="dEndDate" class="form-control">
                                </div>
                            </div>

                            <!-- Total Price -->
                            <div class="input-group mb-2">
                                <span class="input-group-text">&#8377;</span>
                                <input type="text" name="price" id="price" class="form-control" readonly required>
                            </div>
                            <br>

                            <button type="submit" name="btnVenue" class="custom-btn">Add To Booking</button>

                        </form>

                    </div>

                    <!-- event-schedule - start -->

                    <!-- event-schedule - end -->

                    <!-- event-pricing-plan - start -->
                    <div class="event-pricing-plan mb-80 clearfix">

                        <div class="section-title text-left mb-50">
                            <span class="line-style"></span>
                            <h2 class="big-title">Venue <strong>Pricing Plans</strong></h2>
                        </div>

                        <div class="pricing-list ul-li clearfix">
                            <ul>

                                <li class="pricing-table popular-pricing-table">
                                    <span class="popularity-sign">best choice</span>
                                    <div class="pricing-header clearfix">
                                        <span id="perDayFee" class="amount">&#8377;<?= $venueRow['per_day_rent'] ?></span>
                                        <h3 class="pricing-table-title">Per Day</h3>
                                    </div>
                                </li>

                                <li class="pricing-table">
                                    <div class="pricing-header clearfix">
                                        <span id="perHourFee" class="amount">&#8377;<?= $venueRow['per_hour_rent'] ?></span>
                                        <h3 class="pricing-table-title">Per Hour</h3>
                                    </div>
                                </li>

                            </ul>
                        </div>

                    </div>
                    <!-- event-pricing-plan - end -->




                    <!-- reviewer-comment-wrapper - start -->
                    <div class="reviewer-comment-wrapper mb-30 clearfix">

                        <div class="section-title text-left mb-50">
                            <h2 class="big-title">Venue <strong>Reviews</strong></h2>
                        </div>

                        <!-- review item start -->
                        <?php
                        $fetchReviews = "SELECT profile_img, CONCAT(first_name, ' ', last_name) AS customer_name, rating, review
                            FROM user
                            INNER JOIN venue_rating ON user.user_id = venue_rating.customer_id
                            WHERE venue_id = ?";
                        $reviewStmt = $conn->prepare($fetchReviews);
                        $reviewStmt->bind_param("i", $venueId);
                        if ($reviewStmt->execute()) {
                            $rsReview = $reviewStmt->get_result();
                            if ($rsReview->num_rows > 0) {
                                while ($reviewRow = $rsReview->fetch_assoc()) {
                        ?>
                                    <div class="comment-bar clearfix">
                                        <div class="admin-image">
                                            <img src="assets/images/admin.png" alt="Image_not_found">
                                        </div>
                                        <div class="comment-content">
                                            <div class="admin-name mb-15">
                                                <div class="rateing-star ul-li clearfix">
                                                    <ul>
                                                        <?php
                                                        for ($i = 0; $i < $reviewRow['rating']; $i++) {
                                                            echo "<li class='rated'><i class='fas fa-star'></i></li>";
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                                <div class="name">
                                                    <a href="#!"><?= $reviewRow['customer_name'] ?></a>
                                                </div>
                                            </div>
                                            <div class="comment-text">
                                                <p class="mb-30">
                                                    <?= $reviewRow['review'] ?>
                                                </p>

                                                <div class="meta-wrapper">
                                                    <div class="btn-group-left float-left">
                                                        <span class="title"><i class="fas fa-heart"></i> Helpful?</span>
                                                        <ul>
                                                            <li><button type="button">No</button></li>
                                                            <li><button type="button">Yes</button></li>
                                                        </ul>
                                                    </div>
                                                    &nbsp;
                                                    <div class="btn-group-right float-right">
                                                        <ul>
                                                            <li><button type="button"><i class="fas fa-share-square"></i> Share</button></li>
                                                            <li><button type="button"><i class="fas fa-reply-all"></i> Reply</button></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        <?php
                                }
                            } else {
                                echo "No reviews yet";
                            }
                        }
                        ?>
                        <!-- review item end -->

                    </div>
                    <!-- reviewer-comment-wrapper - end -->

                    <div class="pagination ul-li clearfix mb-80">
                        <ul>
                            <li class="page-item prev-item">
                                <a class="page-link" href="#">Prev</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">01</a></li>
                            <li class="page-item active"><a class="page-link" href="#">02</a></li>
                            <li class="page-item"><a class="page-link" href="#">03</a></li>
                            <li class="page-item"><a class="page-link" href="#">04</a></li>
                            <li class="page-item"><a class="page-link" href="#">05</a></li>
                            <li class="page-item next-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </div>

                    <!-- comment-form - start -->
                    <div class="comment-form clearfix">

                        <div class="section-title text-left mb-50">
                            <h2 class="big-title">write a <strong>comment</strong></h2>

                            <div class="rateing-star-wrapper">
                                <span class="rating-title float-left">Your Rating:</span>
                                <div class="rateing-star-form float-right">
                                    <form action="#">

                                        <div class="form-check clearfix">
                                            <input type="checkbox">
                                        </div>
                                        <div class="form-check clearfix">
                                            <input type="checkbox">
                                        </div>
                                        <div class="form-check clearfix">
                                            <input type="checkbox">
                                        </div>
                                        <div class="form-check clearfix">
                                            <input type="checkbox">
                                        </div>
                                        <div class="form-check clearfix">
                                            <input type="checkbox">
                                        </div>

                                    </form>
                                </div>
                            </div>

                        </div>

                        <div class="form-wrapper">
                            <form action="contact.php">
                                <div class="row">

                                    <!-- form-item - start -->
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-item mb-30">
                                            <input type="text" name="name" placeholder="Your Name" value="<?= $fullName ?>" required>
                                        </div>
                                    </div>
                                    <!-- form-item - end -->

                                    <!-- form-item - start -->
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-item mb-30">
                                            <input type="email" name="email" placeholder="Your Email Address" value="<?= $emailId ?>" required>
                                        </div>
                                    </div>
                                    <!-- form-item - end -->

                                    <!-- form-item - start -->
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <div class="form-item mb-30">
                                            <input type="tel" name="phone" placeholder="Your Phone" value="<?= $contact ?>" required>
                                        </div>
                                    </div>
                                    <!-- form-item - end -->

                                    <!-- form-item - start -->
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="mb-30">
                                            <textarea name="message" placeholder="Your Comment" required></textarea>
                                        </div>
                                        <button type="submit" class="custom-btn">SUBMIT NOW</button>
                                    </div>
                                    <!-- form-item - end -->

                                </div>
                            </form>
                        </div>

                    </div>
                    <!-- comment-form - end -->

                </div>
                <!-- col-lg-8 - event-details - end -->

                <div class="location-info-list ul-li-block clearfix">
                    <span class="area-name">Policies</span>
                    <ul>
                        <?php
                        $fetchCancellations = "SELECT policy_option 
                                FROM cancellation_policy AS cp
                                INNER JOIN vendor_cancellation_policy AS vcp ON cp.policy_id = vcp.policy_id
                                WHERE vendor_id = " . $vendorId;
                        $rsCancellation = $conn->query($fetchCancellations);

                        if ($rsCancellation->num_rows > 0) {
                            while ($cancelRow = $rsCancellation->fetch_array()) {
                                echo sprintf(
                                    "<li><i class='fas fa-arrow-circle-right'></i> %s</li>",
                                    $cancelRow[0],
                                    $cancelRow[1]
                                );
                            }
                        }
                        echo "<br>";

                        $fetchPayments = "SELECT policy_option 
                                FROM payment_policy 
                                INNER JOIN vendor_payment_policy
                                WHERE vendor_id = " . $vendorId;
                        $rsPayment = $conn->query($fetchCancellations);

                        if ($rsPayment->num_rows > 0) {
                            while ($paymentRow = $rsPayment->fetch_array()) {
                                echo sprintf(
                                    "<li><i class='fas fa-arrow-circle-right'></i> %s</li>",
                                    $paymentRow[0],
                                    $paymentRow[1]
                                );
                            }
                        }
                        ?>
                    </ul>
                </div>

                <!-- <div class="button">
                            <a href="./add-booking.php?v=<?= $venueId ?>&s=V" class="custom-btn">ADD TO BOOKING</a>
                        </div> -->

            </div>
            <!-- row end -->
        </div>
    </section>
    <!-- event-details-section - end
		================================================== -->





    <!-- default-footer-section - start
		================================================== -->
    <?php include_once("./footer.php"); ?>
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
    <!-- <script src="assets/js/jquery.countdown.js"></script> -->

    <!-- color panal - jqury include -->
    <script src="assets/js/style-switcher.js"></script>

    <!-- custom jquery include -->
    <script src="assets/js/custom.js"></script>

    <script>
        function validateDate(dateInput, msg) {
            const selectedDate = new Date(dateInput.value);
            const today = new Date();

            if (dateInput.value == "") {
                alert(`${msg} is required`);
                return false;
            }
            if (selectedDate.getDate() <= today.getDate()) {
                alert('Please select a future date.');
                dateInput.value = ''; // Clear the input field
                return false;
            } else {
                return true;
            }
        }

        function validateSelect(selectInput) {
            if (selectInput.value == "") {
                alert("Please select a booking type.");
                return false;
            } else {
                return true;
            }
        }

        window.onload = function() {
            let bookingForm = document.getElementById("bookingForm");
            let selType = document.getElementById("selType");
            let perHourFee = document.getElementById("perHourFee").textContent.substring(1);
            let perDayFee = document.getElementById("perDayFee").textContent.substring(1);
            let price = document.getElementById("price");

            // divisions
            let dayDiv = document.getElementById("dayDiv");
            let hourDiv = document.getElementById("hourDiv");

            // objects for per hour fee
            let hStartDate = document.getElementById("hStartDate");
            let hEndDate = document.getElementById("hEndDate");
            let hStartTime = document.getElementById("hStartTime");
            let hEndTime = document.getElementById("hEndTime");

            // objects for per day fee
            let dStartDate = document.getElementById("dStartDate");
            let dEndDate = document.getElementById("dEndDate");

            // initialize with both divs hidden
            dayDiv.style.display = "none";
            hourDiv.style.display = "none";

            selType.addEventListener("change", function() {
                price.value = "";
                if (selType.value == "h") {
                    dayDiv.style.display = "none";
                    hourDiv.style.display = "block";

                } else if (selType.value == "d") {
                    hourDiv.style.display = "none";
                    dayDiv.style.display = "block";
                }
            });

            hEndTime.addEventListener("change", function() {
                const startDateTime = new Date(`${hStartDate.value} ${hStartTime.value}`);
                const endDateTime = new Date(`${hEndDate.value} ${hEndTime.value}`);
                let timeDifference = endDateTime.getTime() - startDateTime.getTime();
                let hourDifference = timeDifference / (1000 * 3600);
                console.log(hourDifference);
                price.value = `${hourDifference * perHourFee}`;
            });

            dEndDate.addEventListener("change", function() {
                const startDate = new Date(`${dStartDate.value} 00:00`);
                const endDate = new Date(`${dEndDate.value} 23:59`);
                let timeDifference = endDate.getTime() - startDate.getTime();
                let dayDifference = Math.ceil(timeDifference / (1000 * 3600 * 24));
                console.log(dayDifference);
                price.value = `${dayDifference * perDayFee}`;
            });

            bookingForm.addEventListener("submit", function(event) {
                event.preventDefault();
                if (validateSelect(selType) == true) {
                    if (selType.value == "h") {
                        if (validateDate(hStartDate, "Start Date") == true && validateDate(hEndDate, "End Date") == true) {
                            bookingForm.submit();
                        }
                    } else if (selType.value == "d") {
                        if (validateDate(dStartDate, "Start Date") == true && validateDate(dEndDate, "End Date") == true) {
                            bookingForm.submit();
                        }
                    }
                }


            })
        }
    </script>



</body>

</html>