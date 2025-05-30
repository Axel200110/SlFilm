<?php
session_start();

if (!isset($_SESSION['id'])) {
	header("Location: signin.php");
	exit;
}

include('conn.php');

// $u_id = $_SESSION['id'];

// // Check if the user has made a payment
// $sql = "SELECT * FROM payment WHERE u_id = $u_id";
// $result = mysqli_query($conn, $sql);

// if (mysqli_num_rows($result) === 0) {
// 	header("Location: pricing.php");
// 	exit;
// var_dump($_SESSION['id']);
// }
?>
<!-- Your catalog page content here -->

<!DOCTYPE html>
<html lang="en">


<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- CSS -->
	<link rel="stylesheet" href="css/bootstrap-reboot.min.css">
	<link rel="stylesheet" href="css/bootstrap-grid.min.css">
	<link rel="stylesheet" href="css/.carousel.min.css">
	<link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
	<link rel="stylesheet" href="css/nouislider.min.css">
	<link rel="stylesheet" href="css/ionicons.min.css">
	<link rel="stylesheet" href="css/magnific-popup.css">
	<link rel="stylesheet" href="css/plyr.css">
	<link rel="stylesheet" href="css/photoswipe.css">
	<link rel="stylesheet" href="css/default-skin.css">
	<link rel="stylesheet" href="css/main.css">

	<!-- Favicons -->
	<link rel="icon" type="image/png" href="icon/cine.png">
	<link rel="apple-touch-icon" href="icon/cine.png">


	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="Thuwan Sajin">
	<title>SLFilm – Online Movies, TV Shows & Cinema</title>
</head>

<body class="body">
	<!-- header -->
	<header class="header">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="header__content">
						<a href="index.php" class="header__logo">
							<img src="img/logo1.svg" alt="">
						</a>
						<!-- end header logo -->

						<!-- header nav -->
						<ul class="header__nav">

							<!-- end dropdown -->
							<li class="header__nav-item">
								<a href="index.php" class="header__nav-link">Home</a>
							</li>

							<li class="header__nav-item">
								<a href="catalog.php" class="header__nav-link">Catalog</a>
							</li>


							<li class="header__nav-item">
								<a href="https://axel200110.github.io/Thuwa2001.github.io/" class="header__nav-link">About Me</a>
							</li>

							<!-- dropdown -->
							<li class="dropdown header__nav-item">
								<a class="dropdown-toggle header__nav-link header__nav-link--more" href="#" role="button" id="dropdownMenuMore" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon ion-ios-more"></i></a>

								<ul class="dropdown-menu header__dropdown-menu scrollbar-dropdown" aria-labelledby="dropdownMenuMore">
									<li><a href="about.html">About</a></li>
									<li><a href="contacts.php">Contacts</a></li>
									<li><a href="faq.html">Help center</a></li>
									<li><a href="privacy.html">Privacy policy</a></li>


								</ul>
							</li>
							<!-- end dropdown -->
						</ul>
						<!-- end header nav -->

						<!-- header auth -->
						<!-- <div class="header__auth"> -->
						<!-- <form action="#" class="header__search">
								<input class="header__search-input" type="text" placeholder="Search...">
								<button class="header__search-button" type="button">
									<i class="icon ion-ios-search"></i>
								</button>
								<button class="header__search-close" type="button">
									<i class="icon ion-md-close"></i>
								</button>
							</form>

							<button class="header__search-btn" type="button">
								<i class="icon ion-ios-search"></i>
							</button> -->


						<?php
						if (isset($_SESSION['id'])) {
						?>
							<a href="signout.php" class="header__sign-in">
								<i class="icon ion-ios-log-out"></i>
								<span>Log Out</span>
							</a>
						<?php
						}
						?>
					</div>
					<!-- end header auth -->

					<!-- header menu btn -->
					<button class="header__btn" type="button">
						<span></span>
						<span></span>
						<span></span>
					</button>
					<!-- end header menu btn -->
				</div>
			</div>
		</div>
		</div>
	</header>
	<!-- end header -->

	<!-- page title -->
	<section class="section section--first section--bg" data-bg="img/section/section.jpg">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section__wrap">
						<!-- section title -->
						<h1 class="section__title">Catalog</h1>
						<!-- end section title -->

						<!-- breadcrumb -->
						<ul class="breadcrumb">
							<li class="breadcrumb__item"><a href="index.php">Home</a></li>
							<li class="breadcrumb__item breadcrumb__item--active">Catalog</li>
						</ul>
						<!-- end breadcrumb -->
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end page title -->

	<!-- catalog -->
	<div class="catalog">
		<div class="container">
			<div class="row row--grid">
				<?php
				include('conn.php');
				$sql = "SELECT * FROM `admin_add_item_movies`";
				$result = mysqli_query($conn, $sql);
				while ($row = mysqli_fetch_array($result)) {
				?>
					<div class="col-4">
						<div class="card">
							<div class="card__cover" style="height:400px;  width:270px;">
								<img src="../admin/coverimages/<?php echo $row['cover']; ?>" class="card-img-top">
								<a href="details.php?movie_id=<?php echo $row['id']; ?>" class="card__play"><i class="icon ion-ios-play-circle"></i></a>
								<span class="card__rate card__rate--green"><?php echo $row['rating'] ?></span>
							</div>
							<div class="card__content">
								<h3 class="card__title"><a href="details.php?movie_id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></h3>
								<span class="card__category">
									<a href="<?php echo $row['genre'] ?>"><?php echo $row['genre'] ?></a>
								</span>
							</div>
						</div>
					</div>
				<?php
				}
				?>
			</div>
		</div>
	</div>
	<!-- end catalog -->

	<!-- section -->
	<section class="section section--border">

		<div class="container">
			<div class="row">
				<div class="col-12">
					<h2 class="home__title">Expected Premiere</h2><br><br>

				</div>
			</div>
			<div class="catalog">
				<div class="container">
					<div class="row row--grid">
						<?php
						include('conn.php');
						$sqlww = "SELECT * FROM `admin_add_premiere_item`  ORDER BY id DESC LIMIT 5";
						$resultww = mysqli_query($conn, $sqlww);
						while ($rowe = mysqli_fetch_array($resultww)) {
						?>
							<div class="col-4">
								<div class="card">
									<div class="card__cover" style="height:400px;  width:270px;">
										<img src="../admin/coverimages/<?php echo $rowe['cover']; ?>" class="card-img-top">
										<a href="details.php?movie_id=<?php echo $rowe['id']; ?>" class="card__play"><i class="icon ion-ios-play-circle"></i></a>
										<span class="card__rate card__rate--green"><?php echo $rowe['rating'] ?></span>
									</div>
									<div class="card__content">
										<h3 class="card__title"><a href="details.php?movie_id=<?php echo $rowe['id']; ?>"><?php echo $rowe['title']; ?></a></h3>
										<span class="card__category">
											<a href="<?php echo $rowe['genre'] ?>"><?php echo $rowe['genre'] ?></a>
										</span>
									</div>
								</div>
							</div>
						<?php
						}
						?>
					</div>
				</div>
			</div>



			<!-- end card -->


		</div>
		</div>
	</section>
	<!-- end section -->

	<!-- section -->
	<section class="section section--border">
		<div class="container">
			<div class="row">
				<div class="col-12 col-xl-10">
					<h2 class="section__title section__title--mb"><b>SLFilm</b> – Best Place for Movies</h2>
					<p class="section__text">SL Film is a dynamic platform for movie enthusiasts, offering a seamless experience to watch and download movies online. With an extensive collection of films from various genres and languages, SL Film caters to a global audience.
<br>
<b style="color:yellow">Features:</b>
<br>
Vast Movie Library: From timeless classics to the latest releases, SL Film provides a comprehensive selection to satisfy every movie lover’s preferences.
High-Quality Streaming and Downloads: Enjoy movies in HD quality, with options for different resolutions to suit your device and internet speed.
User-Friendly Interface: The site is designed for easy navigation, making it simple to search, explore, and access content.
Regular Updates: SL Film frequently updates its library to include the newest films and trending titles.
Multi-Device Compatibility: Accessible on smartphones, tablets, laptops, and desktops for on-the-go entertainment.
Whether you're in the mood for action-packed blockbusters, heartfelt dramas, or laugh-out-loud comedies, SL Film ensures an enjoyable viewing experience anytime, anywhere.</p>

				</div>
			</div>

		</div>
	</section>
	<!-- end section -->

	<!-- footer -->
	<footer class="footer">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="footer__content">
						<a href="index.php" class="header__logo">
							<img src="img/logo1.svg" alt="">
						</a>
						<span class="footer__copyright">© SLFilm, 2019—2024 <br> Create by <a href="https://axel200110.github.io/Thuwa2001.github.io/" target="_blank">Thuwan Sajin</a></span>

						<nav class="footer__nav">
							<a href="about.html">About Us</a>
							<a href="contacts.php">Contacts</a>
							<a href="privacy.html">Privacy policy</a>
						</nav>

						<button class="footer__back" type="button">
							<i class="icon ion-ios-arrow-round-up"></i>
						</button>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- end footer -->

	<!-- JS -->
	<script src="js/jquery-3.5.1.min.js"></script>
	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/jquery.mousewheel.min.js"></script>
	<script src="js/jquery.mCustomScrollbar.min.js"></script>
	<script src="js/wNumb.js"></script>
	<script src="js/nouislider.min.js"></script>
	<script src="js/plyr.min.js"></script>
	<script src="js/photoswipe.min.js"></script>
	<script src="js/photoswipe-ui-default.min.js"></script>
	<script src="js/main.js"></script>
</body>

</html>