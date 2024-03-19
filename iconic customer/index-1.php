<?php
require_once("./Connection.php");
require_once("./Session.php");

// if ($session->get("userId") != null) {
//     $sql = "SELECT CONCAT(first_name, ' ', last_name) AS full_name FROM user WHERE user_id = ".$session("userId");
//     $rsUser = $query($sql);
//     echo $rsUser->fetch_array()[0];
// }
?>
<!DOCTYPE html>
<html lang="en">

	<head>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="x-ua-compatible" content="ie=edge">

		<title>Iconic - Home</title>
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


	<body>




		
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
		<?php include_once("./header.php"); ?>
		<!-- header-section - end
		================================================== -->

		<!-- slide-section - start
		================================================== -->
		<section id="slide-section" class="slide-section clearfix">
			<div id="main-carousel1" class="main-carousel1 owl-carousel owl-theme">

				<div class="item" style="background-image: url(assets/images/slider/slider-bg10.jpg);">
					<div class="overlay-black">
						<div class="container">
							<div class="slider-item-content">

								<span class="medium-text">one stop</span>
								<h1 class="big-text">Event Planner</h1>
								<small class="small-text">every event sould be perfect</small>

								<div class="link-groups">
									<a href="about.html" class="about-btn custom-btn">about us</a>
									<a href="#!" class="start-btn">get started!</a>
								</div>

							</div>
						</div>
					</div>
				</div>
				<div class="item" style="background-image: url(assets/images/slider/slider-bg11.jpg);">
					<div class="overlay-black">
						<div class="container">
							<div class="slider-item-content">

								<span class="medium-text">one stop</span>
								<h1 class="big-text">Event Planner</h1>
								<small class="small-text">every event sould be perfect</small>

								<div class="link-groups">
									<!-- <a href="about.html" class="about-btn custom-btn">about us</a>
									<a href="#!" class="start-btn">get started!</a> -->
								</div>

							</div>
						</div>
					</div>
				</div>
				<div class="item" style="background-image: url(assets/images/slider/slider-bg12.jpg);">
					<div class="overlay-black">
						<div class="container">
							<div class="slider-item-content">

								<span class="medium-text">one stop</span>
								<h1 class="big-text">Event Planner</h1>
								<small class="small-text">every event sould be perfect</small>

								<div class="link-groups">
									<!-- <a href="about.html" class="about-btn custom-btn">about us</a>
									<a href="#!" class="start-btn">get started!</a> -->
								</div>

							</div>
						</div>
					</div>
				</div>

			</div>
		</section>
		<!-- slide-section - end
		================================================== -->





		<!-- popular-venue-searches-section - start
		================================================== -->
		<section id="upcomming-event-section" class="upcomming-event-section sec-ptb-100 clearfix">
			<div class="container">

				<!-- section-title - start -->
				<div class="section-title text-center mb-50">
					<small class="sub-title">Venues</small>
					<h2 class="big-title"><strong>Popular Venue Searches</strong></h2>
				</div>
				<!-- section-title - end -->

				<!-- popular-venue-searches-carousel - start -->
				<div id="upcomming-event-carousel" class="upcomming-event-carousel owl-carousel owl-theme">

					<!-- item - start -->
					<?php
					$fetchVenueTypes = "SELECT venue_type.type_id, type_name, MIN(per_day_rent) AS min_per_day_rent 
					FROM venue_type
					INNER JOIN venue ON venue_type.type_id = venue.type_id
					INNER JOIN venue_booking ON venue.venue_id = venue_booking.venue_id
					GROUP BY type_id";

					$fetchVenueCities = "SELECT DISTINCT city_master.city_id, city_name 
					FROM city_master
					INNER JOIN venue ON city_master.city_id = venue.city_id
					WHERE venue.type_id = ?";
					$stmt = $conn->prepare($fetchVenueCities);

					$rsType = $conn->query($fetchVenueTypes);
					if ($rsType->num_rows > 0) {
						while ($typeRow = $rsType->fetch_assoc()) {
							?>
							<div class="item">
								<div class="event-item">

									<div class="event-image">
										<img src="assets/images/upcomming-events/event-1.jpg" alt="Image_not_found">
									</div>

									<div class="event-content">
										<div class="event-title mb-30">
											<h3 class="title">
												<?= $typeRow["type_name"] ?>
											</h3>
											<span class="ticket-price yellow-color">Starting from &#8377;<?= $typeRow["min_per_day_rent"] ?></span>
										</div>
										<div class="event-post-meta ul-li-block mb-30">
											<ul>
												<?php
												$stmt->bind_param("i", $typeRow["type_id"]);
												if ($stmt->execute()) {
													$rsVenue = $stmt->get_result();
													if ($rsVenue->num_rows > 0) {
														while ($venueRow = $rsVenue->fetch_assoc()) {
															?>
															<li>
																<span class="icon">
																	<i class="fas fa-map-marker-alt"></i>
																</span>
																<?= $venueRow["city_name"] ?>
															</li>
															<?php
														}
													}
												}
												?>
											</ul>
										</div>
										
									</div>
														
								</div>
							</div>
							<?php
						}
					}
					?>
					<!-- item - end -->

				</div>
				<!-- popular-venue-searches-carousel - end -->

			</div>
		</section>
		<!-- popular-venue-searches-section - end
		================================================== -->

		<!-- conference-section - start
		================================================== -->
		<section id="conference-section" class="conference-section clearfix">
			<div class="jarallax" style="background-image: url(assets/images/conference/pexels-photo-262669.jpg);">
				<div class="overlay-black sec-ptb-100">

					<div class="mb-50">
						<div class="container">
							<div class="row">

								<!-- section-title - start -->
								<div class="col-lg-6 col-md-12 col-sm-12">
									<div class="section-title text-left">
										<span class="line-style"></span>
										<!-- <small class="sub-title">harmoni venues</small> -->
										<h2 class="big-title"><strong>Iconic Venues</strong></h2>
									</div>
								</div>
								<!-- section-title - end -->

								<!-- conference-location - start -->
								<div class="col-lg-6 col-md-12 col-sm-12">
									<div class="conference-location ul-li clearfix">
										<ul>

											<!-- country-select - start -->
											<li class="country-select">
												<form action="#">
													<label for="country">Country :</label>
													<select class="custom-select" id="country">
														<?php
														$fetchCountries = "SELECT country_id, country_name FROM country_master
														ORDER BY country_name";
														$rs = $conn->query($fetchCountries);
														if ($rs->num_rows > 0) {
															while ($row = $rs->fetch_array()) {
																echo sprintf("<option value='%s'>%s</option>", 
																$row[0], $row[1]);
															}
														}
														else {
															echo "<option selected value=''>No Data</option>";
														}
														?>
													</select>	
												</form>
											</li>
											<!-- country-select - end -->

											<!-- city-select - start -->
											<li class="city-select">
												<form action="#!">
													<label for="city">city :</label>
													<select class="custom-select" id="city">
													
													</select>	
												</form>
											</li>
											<!-- city-select - end -->

										</ul>
									</div>
								</div>
								<!-- conference-location - end -->

							</div>
						</div>
					</div>

					<!-- conference-content-wrapper - start -->
					<div class="tab-wrapper">

						<!-- tab-menu - start -->
						<div class="container">
							<div class="row justify-content-lg-start">
								<div class="col-lg-6 col-md-12 col-sm-12">
									<div class="tab-menu">
										<ul class="nav tab-nav mb-50" id="venue-list">
											<?php
											$fetchVenues = "SELECT venue.venue_id, photo1, ROUND(AVG(rating), 1) AS rating, venue_name, capacity, per_day_rent
											FROM venue
											LEFT JOIN venue_rating ON venue.venue_id = venue_rating.venue_id
											GROUP BY venue_id";
											$rs = $conn->query($fetchVenues);
											if ($rs->num_rows > 0) {
												while ($row = $rs->fetch_assoc()) {
													echo sprintf(
													"<li class='nav-item'>
														<a class='nav-link active' id='nav-one-tab' href='./venue-details.php?i=%s' aria-expanded='true'>
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
												$row['venue_id'], $row['photo1'], $row['rating'], $row['venue_name'], $row['capacity'], $row['per_day_rent']);
												}
											}
											?>
											<!-- Sample Start -->
											<!-- <li class='nav-item'>
												<a class='nav-link active' id='nav-one-tab' data-toggle='tab' href='#nav-one' aria-expanded='true'>
													<span class='image'>
														<img src='assets/images/conference/RCJAKPP_00016_coddddnversion.jpg' alt='Image_not_found'>
													</span>
													<span class='title'>
														<strong class='yellow-color'>5 <i class='fas fa-star'></i> Chocolato </strong>
														Hotel
													</span>
													<small class='sub-title'>Party Room 2.500 seats</small>
													<small class='price yellow-color'>Price from $52/night</small>
												</a>
											</li> -->
											<!-- Sample End -->
										</ul>
										<div class="more-btn">
											<a href="#!">
												<strong class="yellow-color">VIEW ALL</strong> Venues
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- tab-menu - end -->

						<!-- tab-content - start -->
						<!-- <div class="tab-content"> -->
							<!-- tab-pane - start -->
							<!-- <div class="tab-pane fade active show" id="nav-one" role="tabpanel" aria-labelledby="nav-one-tab" aria-expanded="true">
								<div class="image">
									<img src="assets/images/conference/RCJAKPP_00016_coddddnversion.jpg" alt="Image_not_found">
									<a href="#!" class="custom-btn">
										booking now
									</a>
									<div class="badge-item">
										<div class="content">
											<i class="fas fa-star"></i>
											<strong>5.0</strong>
											<small>featured hotel</small>
										</div>
									</div>
								</div>
							</div> -->
							<!-- tab-pane - end -->

							<!-- tab-pane - start -->
							<!-- <div class="tab-pane fade" id="nav-two" role="tabpanel" aria-labelledby="nav-two-tab" aria-expanded="false">
								<div class="image">
									<img src="assets/images/conference/fresh-conference-room-microphones-decoration-ideas-collection-gallery-to-conference-room-microphones-home-ideas.jpg" alt="Image_not_found">
									<a href="#!" class="custom-btn">
										booking now
									</a>
									<div class="badge-item">
										<div class="content">
											<i class="fas fa-star"></i>
											<strong>5.0</strong>
											<small>featured hotel</small>
										</div>
									</div>
								</div>
							</div> -->
							<!-- tab-pane - end -->

							<!-- tab-pane - start -->
							<!-- <div class="tab-pane fade" id="nav-three" role="tabpanel" aria-labelledby="nav-three-tab" aria-expanded="false">
								<div class="image">
									<img src="assets/images/conference/RCTORON_00047ss.jpg" alt="Image_not_found">
									<a href="#!" class="custom-btn">
										booking now
									</a>
									<div class="badge-item">
										<div class="content">
											<i class="fas fa-star"></i>
											<strong>5.0</strong>
											<small>featured hotel</small>
										</div>
									</div>
								</div>
							- -6</div> -->
							<!-- tab-pane - end -->
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- event-section - start
		================================================== -->
		
		<!-- event-section - end
		================================================== -->





		<!-- event-gallery-section - start
		================================================== -->
		<section id="event-gallery-section" class="event-gallery-section sec-ptb-100 clearfix">

			<!-- section-title - start -->
			<div class="section-title text-center mb-50">
				<small class="sub-title">iconic gallery</small>
				<h2 class="big-title">Beautiful & <strong>Unforgettable Times</strong></h2>
			</div>
			<!-- section-title - end -->

			<div class="button-group filters-button-group mb-30">
				<button class="button is-checked" data-filter="*">
					<i class="fas fa-star"></i>
					<strong>all</strong> gallery
				</button>
				<button class="button" data-filter=".video-gallery">
					<i class="fas fa-play-circle"></i>
					<strong>video</strong> gallery
				</button>
				<button class="button" data-filter=".photo-gallery">
					<i class="far fa-image"></i>
					<strong>photo</strong> gallery
				</button>
			</div>

			<div class="grid zoom-gallery clearfix mb-80" data-isotope="{ &quot;masonry&quot;: { &quot;columnWidth&quot;: 0 } }">
				<div class="grid-item grid-item--height2 photo-gallery " data-category="photo-gallery">
					<a class="popup-link" href="assets/images/gallery/1.image.jpg">
						<img src="assets/images/gallery/1.image.jpg" alt="Image_not_found">
					</a>
					<div class="item-content">
						<h3>John Doe Wedding day</h3>
						<span>Wedding Party, 24 June 2016</span>
					</div>
				</div>
				<div class="grid-item grid-item--width2 video-gallery " data-category="video-gallery">
					<a class="popup-youtube" href="https://youtu.be/-haiaZ011OM">
						<img src="assets/images/gallery/2.image.jpg" alt="Image_not_found">
					</a>
					<div class="item-content">
						<h3>Business Conference in Dubai</h3>
						<span>Food Festival, 24 June 2016</span>
					</div>
				</div>
				<div class="grid-item photo-gallery " data-category="photo-gallery">
					<a class="popup-link" href="assets/images/gallery/3.image.jpg">
						<img src="assets/images/gallery/3.image.jpg" alt="Image_not_found">
					</a>
					<div class="item-content">
						<h3>Envato Author Fun Hiking</h3>
						<span>Food Festival, 24 June 2016</span>
					</div>
				</div>

				<div class="grid-item photo-gallery " data-category="photo-gallery">
					<a class="popup-link" href="assets/images/gallery/4.image.jpg">
						<img src="assets/images/gallery/4.image.jpg" alt="Image_not_found">
					</a>
					<div class="item-content">
						<h3>John Doe Wedding day</h3>
						<span>Wedding Party, 24 June 2016</span>
					</div>
				</div>
				<div class="grid-item grid-item--width2 video-gallery " data-category="video-gallery">
					<a class="popup-youtube" href="https://youtu.be/-haiaZ011OM">
						<img src="assets/images/gallery/5.image.jpg" alt="Image_not_found">
					</a>
					<div class="item-content">
						<h3>New Year Celebration</h3>
						<span>Food Festival, 24 June 2016</span>
					</div>
				</div>

				<div class="grid-item grid-item--width2 photo-gallery " data-category="photo-gallery">
					<a class="popup-link" href="assets/images/gallery/6.image.jpg">
						<img src="assets/images/gallery/6.image.jpg" alt="Image_not_found">
					</a>
					<div class="item-content">
						<h3>John Doe Wedding day</h3>
						<span>Wedding Party, 24 June 2016</span>
					</div>
				</div>
				<div class="grid-item video-gallery " data-category="video-gallery">
					<a class="popup-youtube" href="https://youtu.be/-haiaZ011OM">
						<img src="assets/images/gallery/7.image.jpg" alt="Image_not_found">
					</a>
					<div class="item-content">
						<h3>New Year Celebration</h3>
						<span>Food Festival, 24 June 2016</span>
					</div>
				</div>
				<div class="grid-item photo-gallery " data-category="photo-gallery">
					<a class="popup-link" href="assets/images/gallery/8.image.jpg">
						<img src="assets/images/gallery/8.image.jpg" alt="Image_not_found">
					</a>
					<div class="item-content">
						<h3>Envato Author Fun Hiking</h3>
						<span>Food Festival, 24 June 2016</span>
					</div>
				</div>
			</div>

			<div class="text-center">
				<a href="#!" class="custom-btn">view all gallery</a>
			</div>


		</section>
		<!-- event-gallery-section - end
		================================================== -->





		<!-- event-expertise-section - start
		================================================== -->
		<section id="event-expertise-section" class="event-expertise-section bg-gray-light sec-ptb-100 clearfix">
			<div class="container">

				<!-- section-title - start -->
				<div class="section-title text-center mb-50">
					<small class="sub-title">our services</small>
					<h2 class="big-title">Iconic <strong>Expertise</strong></h2>
				</div>
				<!-- section-title - end -->

				<!-- event-expertise-carousel - start -->
				<div id="event-expertise-carousel" class="event-expertise-carousel owl-carousel owl-theme">

					<!-- expertise-item - start -->
					<?php
					$fetchAvgStarting = "SELECT ROUND(AVG(per_day_rent), 2) FROM venue";
					$rs = $conn->query($fetchAvgStarting);
					if ($rs->num_rows > 0) {
						$row = $rs->fetch_array();
						if ($row[0] != null) {
							$avgVenueStarting = $row[0];
						}
						else {
							$avgVenueStarting = 0.0;
						}
					}
					?>
					<div class="item">
						<span class="expertise-title">iconic events</span>
						<div class="expertise-item">
							<div class="image image-wrapper">
								<img src="assets/images/experties/img1.jpg" alt="Image_not_found">
								<a href="#!" class="plus-effect"></a>
							</div>
							<div class="content">
								<h3 class="title">Venues</h3>
								<p>Start from <strong>&#8377; <?= $avgVenueStarting ?></strong></p>
							</div>
						</div>
					</div>
					<!-- expertise-item - end -->

					<!-- expertise-item - start -->
					<?php
					$fetchAvgStarting = "SELECT ROUND(AVG(starting_price), 2) FROM caterer";
					$rs = $conn->query($fetchAvgStarting);
					if ($rs->num_rows > 0) {
						$row = $rs->fetch_array();
						if ($row[0] != null) {
							$avgCatererStarting = $row[0];
						}
						else {
							$avgCatererStarting = 0.0;
						}
					}
					?>
					<div class="item">
						<span class="expertise-title">iconic events</span>
						<div class="expertise-item">
							<div class="image image-wrapper">
								<img src="assets/images/experties/img2.jpg" alt="Image_not_found">
								<a href="#!" class="plus-effect"></a>
							</div>
							<div class="content">
								<h3 class="title">Catering</h3>
								<p>Start from <strong>&#8377; <?= $avgCatererStarting ?></strong></p>
							</div>
						</div>
					</div>
					<!-- expertise-item - end -->

					<!-- expertise-item - start -->
					<?php
					$fetchAvgStarting = "SELECT ROUND(AVG(starting_price), 2) FROM photographer";
					$rs = $conn->query($fetchAvgStarting);
					if ($rs->num_rows > 0) {
						$row = $rs->fetch_array();
						if ($row[0] != null) {
							$avgPhotoStarting = $row[0];
						}
						else {
							$avgPhotoStarting = 0.0;
						}
					}
					?>
					<div class="item">
						<span class="expertise-title">iconic events</span>
						<div class="expertise-item">
							<div class="image image-wrapper">
								<img src="assets/images/experties/img3.jpg" alt="Image_not_found">
								<a href="#!" class="plus-effect"></a>
							</div>
							<div class="content">
								<h3 class="title">Photography</h3>
								<p>Start from <strong>&#8377; <?= $avgPhotoStarting ?></strong></p>
							</div>
						</div>
					</div>
					<!-- expertise-item - end -->

					<!-- expertise-item - start -->
					<?php
					$fetchAvgStarting = "SELECT ROUND(AVG(starting_price), 2) FROM musician";
					$rs = $conn->query($fetchAvgStarting);
					if ($rs->num_rows > 0) {
						$row = $rs->fetch_array();
						if ($row[0] != null) {
							$avgMusicStarting = $row[0];
						}
						else {
							$avgMusicStarting = 0.0;
						}
					}
					?>
					<div class="item">
						<span class="expertise-title">iconic events</span>
						<div class="expertise-item">
							<div class="image image-wrapper">
								<img src="assets/images/experties/img1.jpg" alt="Image_not_found">
								<a href="#!" class="plus-effect"></a>
							</div>
							<div class="content">
								<h3 class="title">Musicians</h3>
								<p>Start from <strong>&#8377; <?= $avgMusicStarting ?></strong></p>
							</div>
						</div>
					</div>
					<!-- expertise-item - end -->

					<!-- expertise-item - start -->
					<?php
					$fetchAvgDecoration = "";
					?>
					<div class="item">
						<span class="expertise-title">iconic events</span>
						<div class="expertise-item">
							<div class="image image-wrapper">
								<img src="assets/images/experties/img2.jpg" alt="Image_not_found">
								<a href="#!" class="plus-effect"></a>
							</div>
							<div class="content">
								<h3 class="title">Decorations <br> (Coming Soon)</h3>
								<p>Start from <strong>-</strong></p>
							</div>
						</div>
					</div> -->
					<!-- expertise-item - end

				</div>
				<!-- event-expertise-carousel - end -->

			</div>
		</section>
		<!-- event-expertise-section - end
		================================================== -->





		<!-- speaker-section - start
		================================================== -->
		
		<!-- speaker-section - end
		================================================== -->





		<!-- advertisement-section - start
		================================================== -->
		<!-- <section id="advertisement-section" class="advertisement-section clearfix" style="background-image: url(assets/images/special-offer-bg.png);">
			<div class="container">
				<div class="advertisement-content text-center">

					<h2 class="title-large white-color">Are you ready to make <strong>your Own Special Events?</strong></h2>
					<p class="mb-31">“Get started now, Harmoni event management PSD template.”</p>
					<a href="#!" class="purchase-btn">purchase now!</a>
					
				</div>
			</div>
		</section> -->
		<!-- advertisement-section - end
		================================================== -->




		

					<!-- latest-blog-wrapper - start -->
					<div class="col-lg-6 col-md-12 col-sm-12">
						<div class="latest-blog-wrapper">

							<!-- section-title - start -->
							<div class="section-title mb-30">
								<span class="line-style"></span>
								<small class="sub-title">our blog</small>
								<h2 class="big-title">latest <strong>events</strong></h2>
							</div>
							<!-- section-title - end -->

							<?php
							$fetchLatestEvents = "SELECT venue_name, type_name, city_name, review, DATE_FORMAT(start_datetime, '%e %M %Y') AS booked_at
							FROM booking_master
							INNER JOIN venue_booking ON venue_booking.booking_id = booking_master.booking_id
							INNER JOIN venue ON venue.venue_id = venue_booking.venue_id 
							INNER JOIN venue_rating ON venue_rating.venue_id = venue.venue_id
							INNER JOIN city_master ON venue.city_id = city_master.city_id
							INNER JOIN venue_type ON venue.type_id = venue_type.type_id
							ORDER BY booked_at DESC
							LIMIT 4";
							$rs = $conn->query($fetchLatestEvents);
							if ($rs->num_rows > 0) {
								while ($row = $rs->fetch_assoc()) {
									echo sprintf("<div class='latest-blog clearfix'>
									<div class='blog-image'>
										<img src='assets/images/blog/1.latest-blog.jpg' alt='Image_not_found'>
										<a href='#!' class='plus-effect'></a>
									</div>
									<div class='blog-content'>
										<div class='blog-title mb-30'>
											<h3>Event at a %s at %s in %s</h3>
											<span>%s</span>
										</div>
										<p class='m-0'>
											%s
										</p>
									</div>
								</div>", $row['type_name'], $row['venue_name'], $row['city_name'], $row['booked_at'], $row['review']);
								}
							}
							else {
								?>
								<div class="latest-blog clearfix">
								<div class="blog-image">
									<img src="assets/images/blog/1.latest-blog.jpg" alt="Image_not_found">
									<a href="#!" class="plus-effect"></a>
								</div>
								<div class="blog-content">
									<div class="blog-title mb-30">
										<h3>No Events Lately</h3>
										<span></span>
									</div>
									<p class="m-0"></p>
								</div>
							</div>
								<?php
							}
							?>

							<!-- latest-blog - start -->
							<!-- <div class="latest-blog clearfix">
								<div class="blog-image">
									<img src="assets/images/blog/1.latest-blog.jpg" alt="Image_not_found">
									<a href="#!" class="plus-effect"></a>
								</div>
								<div class="blog-content">
									<div class="blog-title mb-30">
										<h3>Barcelona Friday Food Truck Festival 26 Mei 2019</h3>
										<span>26 June 2018</span>
									</div>
									<p class="m-0">
										Harmoni gives you everything you need to host your best event yet. lorem ipsum diamet.
									</p>
								</div>
							</div> -->
							<!-- latest-blog - end -->

						</div>
					</div>
					<!-- latest-blog-wrapper - end -->
					
				</div>
			</div>
		</section>
		<!-- news-update-section - end
		================================================== -->





		<!-- footer-section2 - start
		================================================== -->
		<?php include_once("./footer.php"); ?>
		<!-- footer-section2 - end
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
				// variables
				selCountry = document.getElementById("country");
				selCity = document.getElementById("city");
				venueList = document.getElementById("venue-list");

				// listeners
				selCountry.addEventListener("change", function() {
					const xhr = new XMLHttpRequest();
					const data = "data="+selCountry.value;
					xhr.open("POST", "./async/cities-for-country.php", true);
					xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					xhr.onload = function() {
						selCity.innerHTML = this.responseText;
					}
					xhr.onerror = function() {
						alert("Server-side Error");
					}
					xhr.send(data);
				});

				selCity.addEventListener("change", function() {
					const xhr = new XMLHttpRequest();
					const data = "data="+selCity.value;
					xhr.open("POST", "./async/venues-for-city.php", true);
					xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					xhr.onload = function() {
						venueList.innerHTML = this.responseText;
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