<?php
require_once("./Connection.php");
require_once("./Session.php");

if (isset($_GET["t"])) {
    $userType = $_GET["t"];

    if ($userType == "C") {
        $fetchCaterers = "SELECT user_id, CONCAT(first_name, ' ', last_name) AS full_name, ROUND(AVG(rating), 1) AS avg_rating, profile_img, photo1, user_id, company_name, address, city_name, starting_price, description, type_name
        FROM caterer
        INNER JOIN user ON caterer.caterer_id = user.user_id
        INNER JOIN city_master ON user.city_id = city_master.city_id
        INNER JOIN food_type ON caterer.food_type_id = food_type.type_id
        INNER JOIN caterer_rating ON caterer.caterer_id = caterer_rating.caterer_id
        WHERE user_type = 'C'
        GROUP BY user_id";

        $rsVendor = $conn->query($fetchCaterers);
    } else if ($userType == "M") {
        $fetchMusicians = "SELECT user_id, CONCAT(first_name, ' ', last_name) AS full_name, ROUND(AVG(rating), 1) AS avg_rating, profile_img, photo1, user_id, company_name, address, city_name, starting_price, description
        FROM musician
        INNER JOIN user ON musician.musician_id = user.user_id
        INNER JOIN city_master ON user.city_id = city_master.city_id
        INNER JOIN musician_rating ON musician.musician_id = musician_rating.musician_id
        WHERE user_type = 'M'
        GROUP BY user_id";

        $rsVendor = $conn->query($fetchMusicians);
    } else if ($userType == "P") {
        $fetchPhotographers = "SELECT user_id, CONCAT(first_name, ' ', last_name) AS full_name, ROUND(AVG(rating), 1) AS avg_rating, profile_img, photo1, user_id, company_name, address, city_name, starting_price, description
        FROM photographer
        INNER JOIN user ON photographer.photographer_id = user.user_id
        INNER JOIN city_master ON user.city_id = city_master.city_id
        INNER JOIN photographer_rating ON photographer.photographer_id = photographer_rating.photographer_id
        WHERE user_type = 'P'
        GROUP BY user_id";

        $rsVendor = $conn->query($fetchPhotographers);
    } else if ($userType == "D") {
    }
} else {
    echo "<h1>Invalid Request</h1>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Iconic - Vendors</title>
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
    <!-- <div id="preloader"></div> -->
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
                        <li class="active">
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
                        <li>
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
                                <span class="sub-title">iconic events</span>
                                <h2 class="big-title">iconic <strong>vendors</strong></h2>
                            </div>
                            <!-- breadcrumb-title - end -->

                            <!-- breadcrumb-list - start -->
                            <div class="breadcrumb-list">
                                <ul>
                                    <li class="breadcrumb-item"><a href="index-1.php" class="breadcrumb-link">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">vendors</li>
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
                        <small class="sub-title">Find best vendors on Iconic</small>
                        <h2 class="big-title">Vendor <strong>Search</strong></h2>
                    </div>
                </div>
                <!-- section-title - end -->

                <!-- search-form - start -->
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <div class="search-form form-wrapper">
                        <form action="#!">

                            <ul>
                                <li>
                                    <span class="title">vendor keyword</span>
                                    <div class="form-item">
                                        <input type="search" placeholder="company name or location">
                                    </div>
                                </li>
                                <?php
                                if ($userType == "C") {
                                ?>
                                    <li>
                                        <span class="title">cuisine category</span>
                                        <select id="event-category-select">
                                            <?php
                                            $cuisineCategories = "SELECT * from food_type";
                                            $rsCuisine = $conn->query($cuisineCategories);
                                            if ($rsCuisine->num_rows > 0) {
                                                while ($rowCusine = $rsCuisine->fetch_assoc()) {
                                                    echo sprintf(
                                                        "<option value='%s'>%s</option>",
                                                        $rowCusine['type_id'],
                                                        $rowCusine['type_name']
                                                    );
                                                }
                                            } else {
                                                echo "<option value=''>No Data</option>";
                                            }
                                            ?>
                                        </select>
                                    </li>
                                <?php
                                }
                                ?>
                                <li>
                                    <button type="submit" class="submit-btn">search now</button>
                                </li>
                            </ul>

                        </form>
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
                        <form action="#!">
                            <ul>

                                <li>
                                    <span class="result-text">X Search results from Y vendors</span>
                                </li>

                                <li>
                                    <label for="munth-select">Sort By:</label>
                                    <select id="munth-select">
                                        <option value="0">Name</option>
                                        <option value="1">Rating</option>
                                        <option value="2">Price - Low to High</option>
                                        <option value="3">Price - High to Low</option>
                                    </select>
                                </li>

                            </ul>
                        </form>

                        <ul class="nav event-layout-btngroup">
                            <li><a class="active" data-toggle="tab" href="#list-style"><i class="fas fa-th-list"></i></a></li>
                            <li><a data-toggle="tab" href="#grid-style"><i class="fas fa-th"></i></a></li>
                        </ul>
                    </div>

                    <div class="tab-content">
                        <div id="list-style" class="tab-pane fade in active show">

                            <!-- event-item - start -->
                            <?php
                            if ($rsVendor->num_rows > 0) {
                                while ($row = $rsVendor->fetch_assoc()) {
                                    // var_dump($row);
                            ?>
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
                                                    <strong><?= $row['company_name'] ?></strong>
                                                </h3>
                                                <span class="ticket-price yellow-color">Starting Price &#8377;<?= $row['starting_price'] ?></span>
                                                <!-- <br>
                                                <span class="ticket-price yellow-color">Per Day Rent &#8377;<?= $row['per_day_rent'] ?></span> -->
                                            </div>
                                            <p class="discription-text mb-30">
                                                <span class="icon">
                                                    <i class="fas fa-map-marker-alt"></i>
                                                </span>
                                                <?= $row['city_name'] ?> | <?= substr($row['address'], 0, 10) . "..." ?>
                                            </p>
                                            <p class="discription-text mb-30">
                                                <?= substr($row['description'], 0, 100) . "..." ?>
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

                                                    <?php
                                                    if ($userType == "C") {
                                                    ?>
                                                        <li>
                                                            <span class="icon">
                                                                <i class="fas fa-ticket-alt"></i>
                                                            </span>
                                                            <div class="info-content">
                                                                <small>Cuisine Type</small>
                                                                <h3><?= $row['type_name'] ?></h3>
                                                            </div>
                                                        </li>
                                                    <?php
                                                    }
                                                    ?>

                                                    <li>
                                                        <?php
                                                        if ($userType == "C") {
                                                            echo "<a href='./caterer-details.php?i=".$row['user_id']."' class='tickets-details-btn'>
                                                                    More Details
                                                                </a>";
                                                        }
                                                        else if ($userType == "M") {
                                                            echo "<a href='./musician-details.php?i=".$row['user_id']."' class='tickets-details-btn'>
                                                                    More Details
                                                                </a>";
                                                        }
                                                        else if ($userType == "P") {
                                                            echo "<a href='./photographer-details.php?i=".$row['user_id']."' class='tickets-details-btn'>
                                                                    More Details
                                                                </a>";
                                                        }
                                                        ?>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- event-content - end -->

                                    </div>
                                <?php
                                }   // while end
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
                                $rsVendor->data_seek(0);
                                if ($rsVendor->num_rows > 0) {
                                    while ($row = $rsVendor->fetch_assoc()) {
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
                                                            <?= $row['company_name'] ?>
                                                        </h3>
                                                        <span class="ticket-price yellow-color">Starting Price &#8377;<?= $row['starting_price'] ?></span>

                                                    </div>
                                                    <div class="event-post-meta ul-li-block mb-30">
                                                        <ul>
                                                            <li>
                                                                <span class="icon">
                                                                    <i class="fas fa-map-marker-alt"></i>
                                                                </span>
                                                                <?= $row['city_name'] ?> | <?= substr($row['address'], 0, 10) . "..." ?>
                                                            </li>
                                                            <li>
                                                                <span class="icon">
                                                                    <i class="far fa-clock"></i>
                                                                </span>
                                                                <?= $row['description'] ?>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <a href="./add-booking.php" class="tickets-details-btn">
                                                        Add to Booking
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





</body>

</html>