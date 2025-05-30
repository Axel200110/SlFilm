<?php
session_start();
if (!isset($_SESSION['e'])) {
	header('Location: signin.php');
}

?>
<?php
if (isset($_GET['message']) && $_GET['message'] === 'delete_success') {
    echo "<div style='color: green; font-weight: bold;'>Record deleted successfully!</div>";
}
?>

<?php

if (isset($_POST['sub'])) {
	include('conn.php');

	// Extract form data
	$cover = $_FILES['pimg']['name'];
	$covert = $_FILES['pimg']['tmp_name'];
	$title = $_POST["title"];
	$director = $_POST["director"];
	$cast = $_POST["cast"];
	$description = $_POST["decs"];
	$releaseYear = $_POST["year"];
	$runtime = $_POST["runtime"];
	$quality = $_POST["quality"];
	$age = $_POST["Age"];
	$countries = $_POST["country"];
	$rating = $_POST["rating"];
	$genres = $_POST["genre"];
	$img2 = $_FILES['gallery']['name'];
	$img2t = $_FILES['gallery']['tmp_name'];
	$itemType = $_POST["item_Type"];

	$movie = $_FILES['movie']['name'];
	$moviet = $_FILES['movie']['tmp_name'];
	$movielink = $_POST["link"];

	$sql = "INSERT INTO `admin_add_premiere_item`(`cover`, `title`, `director`, `cast`, `description`, `release_year`, `runtime`, `quality`, `age`, `country`,`rating`, `genre`, `upload_photos`, `item_type`, `movie_file`, `link`)
	VALUES ('$cover', '$title', '$director', '$cast', '$description', '$releaseYear', '$runtime', '$quality', '$age', '$countries','$rating', '$genres', '$img2', '$itemType', '$movie', '$movielink')";


	// Execute the SQL query for movies
	if (mysqli_query($conn, $sql)) {
        move_uploaded_file($covert, "coverimages/" . $cover);
        move_uploaded_file($img2t, "uploadphotos/" . $img2);
        move_uploaded_file($moviet, "movieimg/" . $movie);

        $successMessage = "Premiere item published successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>



<!DOCTYPE html>
<html lang="en">


<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- CSS -->
	<link rel="stylesheet" href="css/bootstrap-reboot.min.css">
	<link rel="stylesheet" href="css/bootstrap-grid.min.css">
	<link rel="stylesheet" href="css/magnific-popup.css">
	<link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
	<link rel="stylesheet" href="css/select2.min.css">
	<link rel="stylesheet" href="css/ionicons.min.css">
	<link rel="stylesheet" href="css/admin.css">

	<!-- Favicons -->
	<link rel="icon" type="image/png" href="icon/cine.png">
	<link rel="apple-touch-icon" href="icon/cine.png">


	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="Thuwan Sajin">
	<title>SLFilm – Online Movies, TV Shows & Cinema </title>
	<style>
        /* Popup styling */
        #popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 999;
        }

        #popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
            background: #1a1a1a;
            color: #fff;
            padding: 20px 30px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
        }

        #popup button {
            margin-top: 20px;
            padding: 10px 20px;
            background: #ffc107;
            color: black;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #popup button:hover {
            background: #e0a800;
        }
    </style>
</head>

<body>

<div id="popup-overlay"></div>
    <div id="popup">
        <h3 id="popup-message"></h3>
        <button onclick="closePopup()">OK</button>
    </div>


	<!-- header -->
	<header class="header">
		<div class="header__content">
			<!-- header logo -->
			<a href="index.php" class="header__logo">
				<img src="img/logo.svg" alt="">
			</a>
			<!-- end header logo -->

			<!-- header menu btn -->
			<button class="header__btn" type="button">
				<span></span>
				<span></span>
				<span></span>
			</button>
			<!-- end header menu btn -->
		</div>
	</header>
	<!-- end header -->

	<!-- sidebar -->
	<div class="sidebar">
		<!-- sidebar logo -->
		<a href="index.php" class="header__logo">
			<img src="img/logo.svg" alt="" style="padding-left: 20px;">
		</a>
		<!-- end sidebar logo -->

		<!-- sidebar user -->
		<div class="sidebar__user">
			<div class="sidebar__user-img">
				<img src="img/user.svg" alt="">
			</div>

			<div class="sidebar__user-title">
				<span>Admin</span>
				<?php if (isset($_SESSION['name'])) { ?>
					<p><?php echo $_SESSION['name']; ?></p>

				<?php
				}
				?>
			</div>


			<button class="sidebar__user-btn" type="button">
				<a href="logout.php" class="icon ion-ios-log-out"></a>
			</button>
		</div>
		<!-- end sidebar user -->

		<!-- sidebar nav -->
		<div class="sidebar__nav-wrap">
			<ul class="sidebar__nav">
				<li class="sidebar__nav-item">
					<a href="index.php" class="sidebar__nav-link"><i class="icon ion-ios-keypad"></i> <span>Dashboard</span></a>
				</li>

				<li class="sidebar__nav-item">
					<a href="catalog.php" class="sidebar__nav-link"><i class="icon ion-ios-film"></i> <span>Catalog</span></a>
				</li>

				<li class="sidebar__nav-item">
					<a href="premiere_item.php" class="sidebar__nav-link sidebar__nav-link"><i class="icon ion-ios-film"></i> <span>Premiere Items</span></a>
				</li>
				<li class="sidebar__nav-item">
					<a href="newItem.php" class="sidebar__nav-link sidebar__nav-link"><i class="icon ion-ios-film"></i> <span>New Items</span></a>
				</li>
				<!-- collapse -->
				<li class="sidebar__nav-item">
					<a class="sidebar__nav-link" data-toggle="collapse" href="#collapseMenu" role="button" aria-expanded="true" aria-controls="collapseMenu"><i class="icon ion-ios-copy"></i> <span>Pages</span> <i class="icon ion-md-arrow-dropdown"></i></a>

					<ul class="collapse show sidebar__menu" id="collapseMenu">
						<li><a href="add-item.php">Add item</a></li>
						<li><a class="active" href="add-premiereitem.php">Add premiere item</a></li>
						<li><a href="add_pricing_plan.php">Add Pricing Plan</a></li>
					</ul>
				</li>
				<!-- end collapse -->

				<li class="sidebar__nav-item">
					<a href="users.php" class="sidebar__nav-link"><i class="icon ion-ios-contacts"></i> <span>Users</span></a>
				</li>


				<li class="sidebar__nav-item">
					<a href="reviews.php" class="sidebar__nav-link"><i class="icon ion-ios-star-half"></i> <span>Reviews</span></a>
				</li>
				<li class="sidebar__nav-item">
					<a href="comments.php" class="sidebar__nav-link sidebar__nav-link"><i class="icon ion-ios-star-half"></i> <span>Comments</span></a>
				</li>
				<li class="sidebar__nav-item">
					<a href="index.php" class="sidebar__nav-link"><i class="icon ion-ios-arrow-round-back"></i> <span>Back to Filmlane</span></a>
				</li>
			</ul>
		</div>
		<!-- end sidebar nav -->

		<!-- sidebar copyright -->
		<div class="sidebar__copyright">© SLFilm, 2019—2024. <br>Create by <a href="https://axel200110.github.io/portfolio.giyhub.io/" target="_blank">Thuwan Sajin</a></div>
		<!-- end sidebar copyright -->
	</div>
	<!-- end sidebar -->

	<!-- main content -->
	<main class="main">
		<div class="container-fluid">
			<div class="row">
				<!-- main title -->
				<div class="col-12">
					<div class="main__title">
						<h2>Add Premiere item</h2>
					</div>
				</div>
				<!-- end main title -->

				<!-- form -->
				<div class="col-12">
					<form class="form" method="post" enctype="multipart/form-data">
						<div class="row row--form">
							<div class="col-12 col-md-5 form__cover">
								<div class="row row--form">
									<div class="col-12 col-sm-6 col-md-12">
										<div class="form__img">
											<label for="form__img-upload">Upload cover (270 x 400)</label>
											<input id="form__img-upload" name="pimg" type="file" accept=".png, .jpg, .jpeg">
											<img id="form__img" src="#" alt=" ">
										</div>
									</div>
								</div>
							</div>

							<div class="col-12 col-md-7 form__content">
								<div class="row row--form">
									<div class="col-12">
										<input type="text" class="form__input" placeholder="Title" name="title">
									</div>
									<div class="col-12">
										<input type="text" class="form__input" placeholder="Director" name="director">
									</div>
									<div class="col-12">
										<textarea id="cast" name="cast" class="form__textarea" placeholder="Cast"></textarea>
									</div>

									<div class="col-12">
										<textarea id="description" name="decs" class="form__textarea" placeholder="Description"></textarea>
									</div>

									<div class="col-12 col-sm-6 col-lg-3">
										<input type="text" class="form__input" name="year" placeholder="Release year">
									</div>

									<div class="col-12 col-sm-6 col-lg-3">
										<input type="text" class="form__input" name="runtime" placeholder="Running timed in minutes">
									</div>

									<div class="col-12 col-sm-6 col-lg-3">
										<select class="js-example-basic-single" id="quality" name="quality">
											<option value=""></option>
											<option value="FullHD">FullHD</option>
											<option value="HD">HD</option>
										</select>
									</div>

									<div class="col-12 col-sm-6 col-lg-3">
										<input type="text" class="form__input" name="Age" placeholder="Age">
									</div>

									<div class="col-12 col-lg-6">
										<select class="js-example-basic-multiple" id="country" name="country" multiple="multiple">
											<option value="Afghanistan">Afghanistan</option>
											<option value="Åland Islands">Åland Islands</option>
											<option value="Albania">Albania</option>
											<option value="Algeria">Algeria</option>
											<option value="American Samoa">American Samoa</option>
											<option value="Andorra">Andorra</option>
											<option value="Angola">Angola</option>
											<option value="Anguilla">Anguilla</option>
											<option value="Antarctica">Antarctica</option>
											<option value="Antigua and Barbuda">Antigua and Barbuda</option>
											<option value="Argentina">Argentina</option>
											<option value="Armenia">Armenia</option>
											<option value="Aruba">Aruba</option>
											<option value="Australia">Australia</option>
											<option value="Austria">Austria</option>
											<option value="Azerbaijan">Azerbaijan</option>
											<option value="Bahamas">Bahamas</option>
											<option value="Bahrain">Bahrain</option>
											<option value="Bangladesh">Bangladesh</option>
											<option value="Barbados">Barbados</option>
											<option value="Belarus">Belarus</option>
											<option value="Belgium">Belgium</option>
											<option value="Belize">Belize</option>
											<option value="Benin">Benin</option>
											<option value="Bermuda">Bermuda</option>
											<option value="Bhutan">Bhutan</option>
											<option value="Bolivia">Bolivia</option>
											<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
											<option value="Botswana">Botswana</option>
											<option value="Bouvet Island">Bouvet Island</option>
											<option value="Brazil">Brazil</option>
											<option value="Brunei Darussalam">Brunei Darussalam</option>
											<option value="Bulgaria">Bulgaria</option>
											<option value="Burkina Faso">Burkina Faso</option>
											<option value="Burundi">Burundi</option>
											<option value="Cambodia">Cambodia</option>
											<option value="Cameroon">Cameroon</option>
											<option value="Canada">Canada</option>
											<option value="Cape Verde">Cape Verde</option>
											<option value="Cayman Islands">Cayman Islands</option>
											<option value="Central African Republic">Central African Republic</option>
											<option value="Chad">Chad</option>
											<option value="Chile">Chile</option>
											<option value="China">China</option>
											<option value="Colombia">Colombia</option>
											<option value="Comoros">Comoros</option>
											<option value="Congo">Congo</option>
											<option value="Congo">Congo</option>
											<option value="Cook Islands">Cook Islands</option>
											<option value="Costa Rica">Costa Rica</option>
											<option value="Cote D'ivoire">Cote D'ivoire</option>
											<option value="Croatia">Croatia</option>
											<option value="Cuba">Cuba</option>
											<option value="Cyprus">Cyprus</option>
											<option value="Czech Republic">Czech Republic</option>
											<option value="Denmark">Denmark</option>
											<option value="Djibouti">Djibouti</option>
											<option value="Dominica">Dominica</option>
											<option value="Dominican Republic">Dominican Republic</option>
											<option value="Ecuador">Ecuador</option>
											<option value="Egypt">Egypt</option>
											<option value="El Salvador">El Salvador</option>
											<option value="Equatorial Guinea">Equatorial Guinea</option>
											<option value="Eritrea">Eritrea</option>
											<option value="Estonia">Estonia</option>
											<option value="Ethiopia">Ethiopia</option>
											<option value="Faroe Islands">Faroe Islands</option>
											<option value="Fiji">Fiji</option>
											<option value="Finland">Finland</option>
											<option value="France">France</option>
											<option value="Gabon">Gabon</option>
											<option value="Gambia">Gambia</option>
											<option value="Georgia">Georgia</option>
											<option value="Germany">Germany</option>
											<option value="Ghana">Ghana</option>
											<option value="Gibraltar">Gibraltar</option>
											<option value="Greece">Greece</option>
											<option value="Greenland">Greenland</option>
											<option value="Grenada">Grenada</option>
											<option value="Guadeloupe">Guadeloupe</option>
											<option value="Guam">Guam</option>
											<option value="Guatemala">Guatemala</option>
											<option value="Guernsey">Guernsey</option>
											<option value="Guinea">Guinea</option>
											<option value="Guinea-bissau">Guinea-bissau</option>
											<option value="Guyana">Guyana</option>
											<option value="Haiti">Haiti</option>
											<option value="Honduras">Honduras</option>
											<option value="Hong Kong">Hong Kong</option>
											<option value="Hungary">Hungary</option>
											<option value="Iceland">Iceland</option>
											<option value="India">India</option>
											<option value="Indonesia">Indonesia</option>
											<option value="Iran">Iran</option>
											<option value="Iraq">Iraq</option>
											<option value="Ireland">Ireland</option>
											<option value="Isle of Man">Isle of Man</option>
											<option value="Israel">Israel</option>
											<option value="Italy">Italy</option>
											<option value="Jamaica">Jamaica</option>
											<option value="Japan">Japan</option>
											<option value="Jersey">Jersey</option>
											<option value="Jordan">Jordan</option>
											<option value="Kazakhstan">Kazakhstan</option>
											<option value="Kenya">Kenya</option>
											<option value="Kiribati">Kiribati</option>
											<option value="Korea">Korea</option>
											<option value="Kuwait">Kuwait</option>
											<option value="Kyrgyzstan">Kyrgyzstan</option>
											<option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
											<option value="Latvia">Latvia</option>
											<option value="Lebanon">Lebanon</option>
											<option value="Lesotho">Lesotho</option>
											<option value="Liberia">Liberia</option>
											<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
											<option value="Liechtenstein">Liechtenstein</option>
											<option value="Lithuania">Lithuania</option>
											<option value="Luxembourg">Luxembourg</option>
											<option value="Macao">Macao</option>
											<option value="Macedonia">Macedonia</option>
											<option value="Madagascar">Madagascar</option>
											<option value="Malawi">Malawi</option>
											<option value="Malaysia">Malaysia</option>
											<option value="Maldives">Maldives</option>
											<option value="Mali">Mali</option>
											<option value="Malta">Malta</option>
											<option value="Marshall Islands">Marshall Islands</option>
											<option value="Martinique">Martinique</option>
											<option value="Mauritania">Mauritania</option>
											<option value="Mauritius">Mauritius</option>
											<option value="Mayotte">Mayotte</option>
											<option value="Mexico">Mexico</option>
											<option value="Moldova">Moldova</option>
											<option value="Monaco">Monaco</option>
											<option value="Mongolia">Mongolia</option>
											<option value="Montenegro">Montenegro</option>
											<option value="Montserrat">Montserrat</option>
											<option value="Morocco">Morocco</option>
											<option value="Mozambique">Mozambique</option>
											<option value="Myanmar">Myanmar</option>
											<option value="Namibia">Namibia</option>
											<option value="Nauru">Nauru</option>
											<option value="Nepal">Nepal</option>
											<option value="Netherlands">Netherlands</option>
											<option value="Netherlands Antilles">Netherlands Antilles</option>
											<option value="New Caledonia">New Caledonia</option>
											<option value="New Zealand">New Zealand</option>
											<option value="Nicaragua">Nicaragua</option>
											<option value="Niger">Niger</option>
											<option value="Nigeria">Nigeria</option>
											<option value="Niue">Niue</option>
											<option value="Norfolk Island">Norfolk Island</option>
											<option value="Northern Mariana Islands">Northern Mariana Islands</option>
											<option value="Norway">Norway</option>
											<option value="Oman">Oman</option>
											<option value="Pakistan">Pakistan</option>
											<option value="Palau">Palau</option>
											<option value="Panama">Panama</option>
											<option value="Papua New Guinea">Papua New Guinea</option>
											<option value="Paraguay">Paraguay</option>
											<option value="Peru">Peru</option>
											<option value="Philippines">Philippines</option>
											<option value="Pitcairn">Pitcairn</option>
											<option value="Poland">Poland</option>
											<option value="Portugal">Portugal</option>
											<option value="Puerto Rico">Puerto Rico</option>
											<option value="Qatar">Qatar</option>
											<option value="Reunion">Reunion</option>
											<option value="Romania">Romania</option>
											<option value="Russian Federation">Russian Federation</option>
											<option value="Rwanda">Rwanda</option>
											<option value="Samoa">Samoa</option>
											<option value="San Marino">San Marino</option>
											<option value="Sao Tome and Principe">Sao Tome and Principe</option>
											<option value="Saudi Arabia">Saudi Arabia</option>
											<option value="Senegal">Senegal</option>
											<option value="Serbia">Serbia</option>
											<option value="Seychelles">Seychelles</option>
											<option value="Sierra Leone">Sierra Leone</option>
											<option value="Singapore">Singapore</option>
											<option value="Slovakia">Slovakia</option>
											<option value="Slovenia">Slovenia</option>
											<option value="Solomon Islands">Solomon Islands</option>
											<option value="Somalia">Somalia</option>
											<option value="South Africa">South Africa</option>
											<option value="Spain">Spain</option>
											<option value="Sri Lanka">Sri Lanka</option>
											<option value="Sudan">Sudan</option>
											<option value="Suriname">Suriname</option>
											<option value="Swaziland">Swaziland</option>
											<option value="Sweden">Sweden</option>
											<option value="Switzerland">Switzerland</option>
											<option value="Syrian Arab Republic">Syrian Arab Republic</option>
											<option value="Taiwan">Taiwan</option>
											<option value="Tajikistan">Tajikistan</option>
											<option value="Tanzania">Tanzania</option>
											<option value="Thailand">Thailand</option>
											<option value="Timor-leste">Timor-leste</option>
											<option value="Togo">Togo</option>
											<option value="Tokelau">Tokelau</option>
											<option value="Tonga">Tonga</option>
											<option value="Trinidad and Tobago">Trinidad and Tobago</option>
											<option value="Tunisia">Tunisia</option>
											<option value="Turkey">Turkey</option>
											<option value="Turkmenistan">Turkmenistan</option>
											<option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
											<option value="Tuvalu">Tuvalu</option>
											<option value="Uganda">Uganda</option>
											<option value="Ukraine">Ukraine</option>
											<option value="United Arab Emirates">United Arab Emirates</option>
											<option value="United Kingdom">United Kingdom</option>
											<option value="United States">United States</option>
											<option value="Uruguay">Uruguay</option>
											<option value="Uzbekistan">Uzbekistan</option>
											<option value="Vanuatu">Vanuatu</option>
											<option value="Venezuela">Venezuela</option>
											<option value="Viet Nam">Viet Nam</option>
											<option value="Western Sahara">Western Sahara</option>
											<option value="Yemen">Yemen</option>
											<option value="Zambia">Zambia</option>
											<option value="Zimbabwe">Zimbabwe</option>
											<option value="">USA</option>
										</select>
									</div>
									<div class="col-12 col-sm-6 col-lg-3">
										<input type="text" class="form__input" name="rating" placeholder="Rating">
									</div>
									<div class="col-12 col-lg-6">
										<select class="js-example-basic-multiple" name="genre" id="genre" multiple="multiple">
											<option value="Action">Action</option>
											<option value="Animation">Animation</option>
											<option value="Comedy">Comedy</option>
											<option value="Crime">Crime</option>
											<option value="Drama">Drama</option>
											<option value="Fantasy">Fantasy</option>
											<option value="Historical">Historical</option>
											<option value="Horror">Horror</option>
											<option value="Romance">Romance</option>
											<option value="Science-fiction">Science-fiction</option>
											<option value="Thriller">Thriller</option>
											<option value="Western">Western</option>
											<option value="Otheer">Otheer</option>
										</select>
									</div>

									<div class="col-12">
										<div class="form__gallery">
											<label id="gallery1" for="form__gallery-upload">Upload photos</label>
											<input data-name="#gallery1" id="form__gallery-upload" name="gallery" class="form__gallery-upload" type="file" accept=".png, .jpg, .jpeg" multiple>
										</div>
									</div>
								</div>
							</div>


							<div class="col-12">
								<ul class="form__radio">
									<li>
										<span>Item type:</span>
									</li>
									<li>
										<input id="type1" type="radio" name="item_Type" value="Movie" checked="">
										<label for="type1">Movie</label>
									</li>
									<li>
										<input id="type2" type="radio" name="item_Type" value="TV Series">
										<label for="type2">TV Series</label>
									</li>
								</ul>
							</div>


							<div class="col-12">
								<div class="row row--form">
									<div class="col-12">
										<div class="form__video">
											<label id="movie1" for="form__video-upload">Upload video</label>
											<input data-name="#movie1" id="form__video-upload" name="movie" class="form__video-upload" type="file" accept="video/mp4,video/x-m4v,video/*">
										</div>
									</div>

									<div class="col-12">
										<input type="text" class="form__input" placeholder="Or add a link" name="link">
									</div>

									<div class="col-12">
										<button type="submit" class="form__btn" name="sub">publish</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
				<!-- end form -->
			</div>
		</div>
	</main>
	<!-- end main content -->
	<script>
        // Display popup if there is a 
		// 
		// message
        const message = "<?php echo $successMessage; ?>";
        if (message) {
            const popup = document.getElementById('popup');
            const overlay = document.getElementById('popup-overlay');
            const popupMessage = document.getElementById('popup-message');

            popupMessage.innerText = message;
            popup.style.display = 'block';
            overlay.style.display = 'block';

            // Automatically close popup and redirect after 3 seconds
            setTimeout(() => {
                closePopup();
                window.location.href = "premiere_item.php"; // Redirect to another page
            }, 3000);
        }

        // Close popup manually
        function closePopup() {
            document.getElementById('popup').style.display = 'none';
            document.getElementById('popup-overlay').style.display = 'none';
        }
    </script>
	<!-- JS -->
	<script src="js/jquery-3.5.1.min.js"></script>
	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/jquery.mousewheel.min.js"></script>
	<script src="js/jquery.mCustomScrollbar.min.js"></script>
	<script src="js/select2.min.js"></script>
	<script src="js/admin.js"></script>
</body>


</html>