<?php
require_once("./Connection.php");
require_once("./Session.php");

if ($session->get("userId") != null) {
	$userId = $session->get("userId");
	// if ($userId == null) {
	// 	$userId = 4;
	// }
	$status = "P";
	$totalPrice = 0;

	$fetchUser = "SELECT first_name, last_name, email_id, country_code, contact, country_name, address, city_name, state_name
    FROM user 
	INNER JOIN city_master ON user.city_id = city_master.city_id
	INNER JOIN state_master ON city_master.state_code = state_master.state_code
	INNER JOIN country_master ON city_master.country_id = country_master.country_id
	WHERE user_id = ?";

	$userStmt = $conn->prepare($fetchUser);
	$userStmt->bind_param("i", $userId);
	$userStmt->execute();
	$rsUser = $userStmt->get_result();
	$userRow = $rsUser->fetch_assoc();

	$firstName = $userRow['first_name'];
	$lastName = $userRow['last_name'];
	$emailId = $userRow['email_id'];
	$contact = $userRow['contact'];

	if ($_GET["i"]) {
		$bookingId = $_GET["i"];
		// booking exists
		$fetchStatus = "SELECT status FROM booking_master WHERE booking_id = ".$bookingId; 
		$rsB = $conn->query($fetchStatus);
		$status = $rsB->fetch_assoc()["status"];

		$fetchBookedCaterer = "SELECT company_name, decided_price, start_datetime, end_datetime, status
				FROM caterer
				INNER JOIN caterer_booking ON caterer.caterer_id = caterer_booking.caterer_id
				WHERE booking_id = ?";

		$stmt = $conn->prepare($fetchBookedCaterer);
		$stmt->bind_param("i", $bookingId);
		$stmt->execute();
		$rsCaterer = $stmt->get_result();
		if ($rsCaterer->num_rows > 0) {
			$catererRow = $rsCaterer->fetch_assoc();
		}

		$fetchBookedMusician = "SELECT company_name, decided_price, start_datetime, end_datetime, status
				FROM musician
				INNER JOIN musician_booking ON musician.musician_id = musician_booking.musician_id
				WHERE booking_id = ?";

		$stmt = $conn->prepare($fetchBookedMusician);
		$stmt->bind_param("i", $bookingId);
		$stmt->execute();
		$rsMusician = $stmt->get_result();
		if ($rsMusician->num_rows > 0) {
			$musicianRow = $rsMusician->fetch_assoc();
		}

		$fetchBookedPhotographer = "SELECT company_name, decided_price, start_datetime, end_datetime, status
				FROM photographer
				INNER JOIN photographer_booking ON photographer.photographer_id = photographer_booking.photographer_id
				WHERE booking_id = ?";

		$stmt = $conn->prepare($fetchBookedPhotographer);
		$stmt->bind_param("i", $bookingId);
		$stmt->execute();
		$rsPhoto = $stmt->get_result();
		if ($rsPhoto->num_rows > 0) {
			$photoRow = $rsPhoto->fetch_assoc();
		}

		$fetchBookedVenue = "SELECT venue_name, decided_price, start_datetime, end_datetime, status
				FROM venue
				INNER JOIN venue_booking ON venue.venue_id = venue_booking.venue_id
				WHERE booking_id = ?";

		$stmt = $conn->prepare($fetchBookedVenue);
		$stmt->bind_param("i", $bookingId);
		$stmt->execute();
		$rsVenue = $stmt->get_result();
		if ($rsVenue->num_rows > 0) {
			$venueRow = $rsVenue->fetch_assoc();
		}

	} else {
		echo "<h1>Invalid Request</h1>";
	}
	// } else {
	// 	echo "<h1>Execution Error</h1>";
	// }
} else {
	echo "<h1>Login required to view this page</h1>";
	header("Location: ./login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<title>Iconic - Booking</title>
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
								<span class="sub-title">booking</span>
								<h2 class="big-title">iconic <strong>booking</strong></h2>
							</div>
							<!-- breadcrumb-title - end -->

							<!-- breadcrumb-list - start -->
							<div class="breadcrumb-list">
								<ul>
									<li class="breadcrumb-item"><a href="index-1.html" class="breadcrumb-link">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">booking</li>
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





	<!-- booking-timeout-section - start
		================================================== -->
	<!-- <section id="booking-timeout-section" class="booking-timeout-section clearfix">
		<div class="container">
			<div class="row"> -->

				<!-- leftside-wrapper - start -->
				<!-- <div class="col-lg-7 col-md-12 col-sm-12">
					<div class="leftside-wrapper">
						<h3>Please complete booking <strong class="yellow-color">within 12:00 hours.</strong></h3>
						<p class="m-0">After 12:00 hours, the reservation we’re holding will be released to others.</p>
					</div>
				</div> -->
				<!-- leftside-wrapper - end -->

				<!-- rightside-wrapper - start -->
				<!-- <div class="col-lg-5 col-md-12 col-sm-12">
					<div class="rightside-wrapper">

						<div class="clock-wrapper">
							<ul class="countdown-list" data-countdown="2019/01/01"></ul>
						</div>

					</div>
				</div> -->
				<!-- rightside-wrapper - end -->
<!-- 
			</div>
		</div>
	</section> -->
	<!-- booking-timeout-section - end
		================================================== -->





	<!-- booking-section - start
		================================================== -->
	<section id="booking-section" class="booking-section bg-gray-light sec-ptb-100 clearfix">
		<div class="container">
			<div class="row">

				<!-- booking-content-wrapper - start -->
				<div class="col-lg-8 col-md-12 col-sm-12">
					<div class="booking-content-wrapper">

						<!-- order-summary - start -->
						<div class="order-summary mb-50">
							<!-- section-title - start -->
							<div class="section-title mb-30">
								<h2 class="big-title">booking <strong>summary</strong></h2>
							</div>
							<!-- section-title - end -->
							<div class="order-summary-table table-responsive">

								<table class="table text-center">
									<thead>
										<tr class="bg-gray-light">
											<th scope="col">service type</th>
											<th scope="col">service provider</th>
											<th scope="col">decided fees</th>
										</tr>
									</thead>
									<tbody>
										<?php
										if (isset($catererRow)) {
											$totalPrice += $catererRow['decided_price'];
											echo sprintf(
												"<tr class='bg-gray-light'>
														<th scope='row'>Caterer</th>
														<td>%s</td>
														<td>%s</td>
													</tr>",
												$catererRow['company_name'],
												$catererRow['decided_price']
											);
										}
										if (isset($musicianRow)) {
											$totalPrice += $musicianRow['decided_price'];
											echo sprintf(
												"<tr class='bg-gray-light'>
														<th scope='row'>Musician</th>
														<td>%s</td>
														<td>%s</td>
													</tr>",
												$musicianRow['company_name'],
												$musicianRow['decided_price']
											);
										}
										if (isset($photoRow)) {
											$totalPrice += $photoRow['decided_price'];
											echo sprintf(
												"<tr class='bg-gray-light'>
														<th scope='row'>Photographer</th>
														<td>%s</td>
														<td>%s</td>
													</tr>",
												$photoRow['company_name'],
												$photoRow['decided_price']
											);
										}
										if (isset($venueRow)) {
											$totalPrice += $venueRow['decided_price'];
											echo sprintf(
												"<tr class='bg-gray-light'>
														<th scope='row'>Venue</th>
														<td>%s</td>
														<td>%s</td>
													</tr>",
												$venueRow['venue_name'],
												$venueRow['decided_price']
											);
										}
										?>
										<!-- <tr>
												<th scope="row">Harmoni Package 2</th>
												<td>$120.00</td>
												<td>$5.00</td>
												<td><input type="text" value="5"></td>
												<td>$675.00</td>
											</tr> -->
										<tr class="tfooter">
											<th colspan="4" class="text-left">order total</th>
											<td>&#8377;<?= $totalPrice ?></td>
										</tr>
									</tbody>
								</table>

							</div>
						</div>
						<!-- order-summary - end -->



						<!-- reg-info - start -->
						<div class="reg-info mb-50">

							<!-- section-title - start -->
							<div class="section-title mb-30">
								<h2 class="big-title">registration <strong>information</strong></h2>
							</div>
							<!-- section-title - end -->

							<!-- row - start -->
							<div class="row">

								<!-- ticket-buying-form - start -->
								<div class="col-lg-6 col-md-6 col-sm-12">
									<div class="ticket-buying-form form-wrapper">
										<h3 class="form-title">booking buyer</h3>

										<form action="#">
											<div class="form-item">
												<input type="text" placeholder="First Name" value="<?= $firstName ?>" readonly>
											</div>
											<div class="form-item">
												<input type="text" placeholder="Last Name" value="<?= $lastName ?>" readonly>
											</div>
											<div class="form-item">
												<input type="email" placeholder="Email Address" value="<?= $emailId ?>" readonly>
											</div>
											<div class="form-item">
												<input type="email" placeholder="Contact" value="<?= $contact ?>" readonly>
											</div>
										</form>

									</div>
								</div>
								<!-- ticket-buying-form - end -->

							</div>
							<!-- row - end -->

						</div>
						<!-- reg-info - end -->



						<!-- billing-info - start -->
						<div class="billing-info mb-50">

							<!-- section-title - start -->
							<div class="section-title mb-30">
								<h2 class="big-title">billing <strong>information</strong></h2>
							</div>
							<!-- section-title - end -->

							<!-- billing-form - start -->
							<div class="billing-form form-wrapper">
								<form action="#" method="post">

									<div class="form-item">
										<input type="text" placeholder="Country" readonly value="<?= $userRow["country_name"] ?>">
									</div>
									<div class="form-item">
										<input type="text" placeholder="Address" readonly value="<?= $userRow["address"] ?>">
									</div>

									<!-- form-item-group - start -->
									<div class="form-item-group mb-50">
										<ul>

											<li>
												<div class="form-item">
													<input type="text" placeholder="City" readonly value="<?= $userRow["city_name"] ?>">
												</div>
											</li>
											<li>
												<div class="form-item">
													<input type="text" placeholder="City" readonly value="<?= $userRow["state_name"] ?>">
												</div>
											</li>
											<!-- <li>
												<div class="form-item">
													<input type="text" placeholder="Zip Code">
												</div>
											</li> -->

										</ul>
									</div>
									<!-- form-item-group - end -->

									<div class="text-center">
										<?php
										if ($status != "D") {
											?>
											<a href="<?= './pay.php?total='.$totalPrice.'&bId='.$bookingId ?>">
												<button name="btnPay" type="button" class="custom-btn">
													pay now
												</button>
											</a>
											<?php
										}
										else {
											// Paid
											echo "Already Paid";
										}
										?>
									</div>

								</form>
							</div>
							<!-- billing-form - end -->

						</div>
						<!-- billing-info - end -->

					</div>
				</div>
				<!-- booking-content-wrapper - end -->
			</div>
	</section>
	<!-- booking-section - end
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
	<script src="assets/js/jquery.countdown.js"></script>

	<!-- color panal - jqury include -->
	<script src="assets/js/style-switcher.js"></script>

	<!-- custom jquery include -->
	<script src="assets/js/custom.js"></script>

	<script>
		function togglePaymentFields() {
			var paymentMethod = document.getElementById('payment-method-select').value;
			var cardDetails = document.getElementById('card-details');
			var upiDetails = document.getElementById('upi-details');
			var expiryDetails = document.getElementById('card-details');

			if (paymentMethod === 'Card') {
				cardDetails.style.display = 'block';
				expiryDetails.style.display = 'block';
				upiDetails.style.display = 'none';
			} else if (paymentMethod === 'UPI') {
				cardDetails.style.display = 'none';
				expiryDetails.style.display = 'none';
				upiDetails.style.display = 'block';
			}
		}
	</script>


</body>

</html>
