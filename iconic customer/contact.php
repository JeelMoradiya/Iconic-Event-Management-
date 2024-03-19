<?php
require_once("./Connection.php");
require_once("./Session.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Extract form data
	$name = $_POST["name"];
	$email = $_POST["email"];
	$contact = $_POST["contact"];
	$subject = $_POST["subject"];
	$message = $_POST["massage"];

	// Sanitize and escape input data to prevent SQL injection
	$name = mysqli_real_escape_string($conn, $name);
	$email = mysqli_real_escape_string($conn, $email);
	$contact = mysqli_real_escape_string($conn, $contact);
	$subject = mysqli_real_escape_string($conn, $subject);
	$message = mysqli_real_escape_string($conn, $message);

	// Prepare SQL query
	$sql = "INSERT INTO contact (name, email, contact, subject, message) 
            VALUES ('$name', '$email', '$contact', '$subject', '$message')";

	if ($conn->query($sql) === TRUE) {
		// Send an email using PHPMailer
		$mail = new PHPMailer(true);

		try {
			//Server settings
			$mail->isSMTP();
			$mail->Host = 'smtp.example.com';  // SMTP server
			$mail->SMTPAuth = true;
			$mail->Username = 'iconicevent10@gmail.com'; // SMTP username
			$mail->Password = 'huflnyujsspklgeh'; // SMTP password
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
			$mail->Port = 587;

			//Recipients
			$mail->setFrom($email);
			$mail->addAddress('iconicevent10@gmail.com'); // Email recipient

			//Content
			$mail->isHTML(false);
			$mail->Subject = 'New Contact Form Submission';
			$mail->Body = "Name: $name\nEmail: $email\nContact: $contact\nSubject: $subject\nMessage: $message";

			$mail->send();
			echo "Record inserted successfully. Email sent!";
		} catch (Exception $e) {
			echo "Record inserted successfully. Email could not be sent. Error: {$mail->ErrorInfo}";
		}
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<title>Iconic - contact</title>
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


	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.css" rel="stylesheet" />
	
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
								<span class="sub-title">contact us now</span>
								<h2 class="big-title">keep <strong>in touch</strong></h2>
							</div>
							<!-- breadcrumb-title - end -->

							<!-- breadcrumb-list - start -->
							<div class="breadcrumb-list">
								<ul>
									<li class="breadcrumb-item"><a href="index-1.php" class="breadcrumb-link">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">contact us</li>
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





	<!-- contact-section - start
		================================================== -->
	<section id="contact-section" class="contact-section sec-ptb-100 clearfix">
		<div class="container">

			<!-- section-title - start -->
			<div class="section-title mb-50">
				<small class="sub-title">contact us</small>
				<h2 class="big-title">Keep in touch <strong>with iconic</strong></h2>
			</div>
			<!-- section-title - end -->

			<!-- contact-form - start -->
			<div class="contact-form form-wrapper text-center">
				<form class="needs-validation" action="contact.php" method="post" novalidate>
					<div class="row">

						<div class="col-lg-6 col-md-6 col-sm-12">
							<div class="form-item">
								<input type="text" id="name" placeholder="Your Name" required>
								<div class="invalid-feedback">Please enter your Name!</div>
							</div>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-12">
							<div class="form-item">
								<input type="email" name="email" placeholder="Email Address" required>
								<div class="invalid-feedback">Please enter a valid Email address!</div>
							</div>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-12">
							<div class="form-item">
								<input type="text" id="subject" placeholder="Your Subject" required>
								<div class="invalid-feedback">Please enter a subject!</div>
							</div>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-12">
							<div class="form-item">
								<input type="tel" name="contact" placeholder="Phone Number" required>
								<div class="invalid-feedback">Please enter a valid Contact Number!</div>
							</div>
						</div>

						<div class="col-lg-12 col-md-12 col-sm-12">
							<textarea name="massage" placeholder="Your Message" required></textarea>
							<div class="invalid-feedback">Please enter a massage!</div>
							<button type="submit" name="submit" class="custom-btn">send mail</button>
						</div>

					</div>
				</form>
			</div>
			<!-- contact-form - end -->

		</div>
	</section>
	<!-- contact-section - end
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

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.js"></script>


	<script>
		// JavaScript validation for the form
		const form = document.querySelector('.needs-validation');

		form.addEventListener('submit', function(event) {
			if (!form.checkValidity()) {
				event.preventDefault();
				event.stopPropagation();
			}
			form.classList.add('was-validated');
		});
	</script>
</body>

</html>