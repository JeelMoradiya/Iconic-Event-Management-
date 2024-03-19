<?php
require_once("./Connection.php");
require_once("./Session.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<title>Iconic - Blog</title>
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
	<style>
		.file-upload-box {
			display: flex;
			align-items: center;
			justify-content: center;
			width: 300px;
			/* Adjust the width as needed */
			height: 200px;
			/* Adjust the height as needed */
			border: 2px dashed #ccc;
			position: relative;
			overflow: hidden;
			cursor: pointer;
		}

		#image {
			display: none;
			/* Hide the file input element */
		}

		.preview-image {
			max-width: 100%;
			max-height: 100%;
			display: none;
			position: absolute;
			top: 0;
			left: 0;
		}
	</style>
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
								<span class="sub-title">our blogs</span>
								<h2 class="big-title">Iconic <strong>latest blogs</strong></h2>
							</div>
							<!-- breadcrumb-title - end -->

							<!-- breadcrumb-list - start -->
							<div class="breadcrumb-list">
								<ul>
									<li class="breadcrumb-item"><a href="index-1.php" class="breadcrumb-link">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">our blogs</li>
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


	<!-- blog-section - start
			================================================== -->
	<section id="blog-section" class="blog-section sec-ptb-100 clearfix">
		<div class="container">
			<div class="row">

				<div class="col-lg-8 col-md-12 col-sm-12">
					<!-- blog-wrapper - start -->
					<div class="blog-wrapper">
						<div class="layout-btn-group">
							<!-- <h3 class="float-left">change layout</h3> -->
							<ul class="nav blog-layout-menubar float-right">
								<li>
									<a class="active" data-toggle="tab" href="#grid-layout"><i class="fas fa-th"></i></a>
								</li>
								<li>
									<a data-toggle="tab" href="#list-layout"><i class="fas fa-th-list"></i></a>
								</li>
								<li>
									<a data-toggle="tab" href="#big-layout"><i class="fas fa-square"></i></a>
								</li>
							</ul>
						</div>

						<div class="tab-content">
							<!-- grid-layout - start -->
							<div id="grid-layout" class="tab-pane fade in active show">
								<div class="row">
									<?php
									// Retrieve blog posts from the database
									$sql = "SELECT title, description, image, created_at FROM blog_posts";
									$result = $conn->query($sql);

									if ($result->num_rows > 0) {
										while ($row = $result->fetch_assoc()) { ?>

											<!-- blog-grid-item - start -->
											<div class="col-lg-6 col-md-6 col-sm-12">
												<div class="blog-grid-item">

													<div class="event-date">
														<?php
														echo $row["created_at"];
														?>
													</div>

													<div class="blog-image">
														<?php
														echo '<img src="' . $row["image"] . '" class="img-fluid" />
											<a href="#!">';
														?>
													</div>

													<div class="blog-content">
														<?php
														echo '<h4 class="blog-title">' . $row["title"] . '</h4>
												<p class="mb-15">' . $row["description"] . '</p>';
														?>
													</div>
											<?php
										}
									} else {
										echo "No blog posts found.";
									}
											?>
												</div>
											</div>
											<!-- blog-grid-item - end -->


											<!-- pagination - start -->
											<!-- <div class="col-lg-12 col-md-12 col-sm-12">
										<div class="pagination ul-li clearfix">
											<ul>
												<li class="page-item prev-item">
													<a class="page-link" href="#!">Prev</a>
												</li>
												<li class="page-item active"><a class="page-link" href="#!">01</a></li>
												<li class="page-item"><a class="page-link" href="#!">02</a></li>
												<li class="page-item"><a class="page-link" href="#!">03</a></li>
												<li class="page-item"><a class="page-link" href="#!">04</a></li>
												<li class="page-item"><a class="page-link" href="#!">05</a></li>
												<li class="page-item next-item">
													<a class="page-link" href="#!">Next</a>
												</li>
											</ul>
										</div>
									</div> -->
											<!-- pagination - end -->

								</div>
							</div>
							<!-- grid-layout - end -->

							<!-- list-layout - start -->
							<div id="list-layout" class="tab-pane fade">

								<!-- blog-list-item - start -->
								<div class="blog-list-item clearfix">
									<?php
									// Retrieve blog posts from the database
									$sql = "SELECT title, description, image, created_at FROM blog_posts";
									$result = $conn->query($sql);

									if ($result->num_rows > 0) {
										while ($row = $result->fetch_assoc()) { ?>
											<div class="blog-image float-left">
												<?php
												echo '<img src="' . $row["image"] . '" class="img-fluid" />
											<a href="#!">';
												?>
												<!-- <a href="#!" class="plus-effect"></a> -->
												<div class="event-date">
													<?php
													echo $row["created_at"];
													?>
												</div>
											</div>

											<div class="blog-content float-right">
												<!-- <a href="#!" class="tag">
											<i class="fas fa-bookmark"></i>
											musical event
										</a> -->
												<?php
												echo '<h4 class="blog-title">' . $row["title"] . '</h4>
												<p class="mb-15">' . $row["description"] . '</p>';
												?>
											</div>
									<?php
										}
									} else {
										echo "No blog posts found.";
									}
									?>
								</div>
								<!-- blog-list-item - end -->


								<!-- pagination - start -->
								<!-- <div class="col-lg-12 col-md-12 col-sm-12">
									<div class="pagination ul-li clearfix">
										<ul>
											<li class="page-item prev-item">
												<a class="page-link" href="#!">Prev</a>
											</li>
											<li class="page-item active"><a class="page-link" href="#!">01</a></li>
											<li class="page-item"><a class="page-link" href="#!">02</a></li>
											<li class="page-item"><a class="page-link" href="#!">03</a></li>
											<li class="page-item"><a class="page-link" href="#!">04</a></li>
											<li class="page-item"><a class="page-link" href="#!">05</a></li>
											<li class="page-item next-item">
												<a class="page-link" href="#!">Next</a>
											</li>
										</ul>
									</div>
								</div> -->
								<!-- pagination - end -->

							</div>
							<!-- list-layout - end -->

							<!-- big-layout - start -->
							<div id="big-layout" class="tab-pane fade">

								<!-- blog-big-item - start -->
								<div class="blog-big-item clearfix">
									<?php
									// Retrieve blog posts from the database
									$sql = "SELECT title, description, image, created_at FROM blog_posts";
									$result = $conn->query($sql);

									if ($result->num_rows > 0) {
										while ($row = $result->fetch_assoc()) { ?>
											<div class="blog-image">
												<?php
												echo '<img src="' . $row["image"] . '" class="img-fluid" />
											<a href="#!">';
												?>
												<!-- <a href="#!" class="plus-effect"></a> -->
												<div class="event-date">
													<?php
													echo $row["created_at"];
													?>
												</div>
											</div>

											<div class="blog-content">
												<!-- <a href="#!" class="tag">
											<i class="fas fa-bookmark"></i>
											musical event
										</a> -->
												<?php
												echo '<h4 class="blog-title">' . $row["title"] . '</h4>
												<p class="mb-15">' . $row["description"] . '</p>';
												?>
											</div>
									<?php
										}
									} else {
										echo "No blog posts found.";
									}
									?>
								</div>
								<!-- blog-big-item - end -->

								<!-- pagination - start -->
								<!-- <div class="col-lg-12 col-md-12 col-sm-12">
									<div class="pagination ul-li clearfix">
										<ul>
											<li class="page-item prev-item">
												<a class="page-link" href="#!">Prev</a>
											</li>
											<li class="page-item active"><a class="page-link" href="#!">01</a></li>
											<li class="page-item"><a class="page-link" href="#!">02</a></li>
											<li class="page-item"><a class="page-link" href="#!">03</a></li>
											<li class="page-item"><a class="page-link" href="#!">04</a></li>
											<li class="page-item"><a class="page-link" href="#!">05</a></li>
											<li class="page-item next-item">
												<a class="page-link" href="#!">Next</a>
											</li>
										</ul>
									</div>
								</div> -->
								<!-- pagination - end -->
							</div>
							<!-- big-layout - end -->

						</div>
					</div>
					<!-- blog-wrapper - end -->
				</div>

				<div class="col-lg-12 col-md-6 col-sm-6">
					<div class="sidebar-section">
						<!-- faq-wrapper - start -->
						<div class="faq-wrapper">
							<div class="container contact-section  sec-ptb-100 clearfix">

								<!-- blog-form - start -->
								<div class="contact-form form-wrapper">
									<h4 class="mb-5 text-danger"><strong>Create Blogs : </strong></h4>

									<form class="needs-validation" action="blog.php" method="post" novalidate>

										<?php
										if ($_SERVER["REQUEST_METHOD"] == "POST") {
											// Retrieve form data
											$title = $_POST["title"];
											$description = $_POST["description"];

											// Handle image upload
											$targetDirectory = "uploads/";
											$targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
											move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);

											// Insert data into the database
											$sql = "INSERT INTO blog_posts (title, description, image) VALUES (?, ?, ?)";
											$stmt = $conn->prepare($sql);
											$stmt->bind_param("sss", $title, $description, $targetFile);

											if ($stmt->execute()) {
												echo "Blog post created successfully!";
											} else {
												echo "Error: " . $conn->error;
											}

											$stmt->close();
										}
										?>

										<div class="row text-center">

											<div class="col-lg-6 col-md-6 col-sm-12">
												<div class="col-md-5">
													<div class="file-upload-box">
														<label for="image" class="text-center">
															<i class="fas fa-upload"></i><br> Upload image
														</label>
														<input type="file" name="image" id="image" accept="image/*"> <!-- Accept only image files -->
														<img class="preview-image" id="preview" src="" alt="Preview Image">
														<div class="invalid-feedback">Please upload an image</div>
													</div>
												</div>
											</div>

											<div class="col-lg-6 col-md-6 col-sm-12">
												<div class="form-item">
													<input type="text" name="title" id="title" placeholder="Title" required />
													<div class="invalid-feedback">Please enter your Title!</div>
												</div>
												<div class="form-item">
													<textarea name="description" id="description" placeholder="Description" rows="4" required></textarea>
													<div class="invalid-feedback">Please enter a Description!</div>
												</div>
											</div>

											<div class="col-lg-0 col-md-12 col-sm-12">
												<button type="submit" name="submit" class="custom-btn">Post</button>
											</div>

										</div>
									</form>
								</div>
								<!-- blog-form - end -->

							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- blog-section - end
			================================================== -->
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

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.js"></script>

	<!-- custom jquery include -->
	<script src="assets/js/custom.js"></script>

</body>

</html>