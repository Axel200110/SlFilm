<?php
include('conn.php');
$plan_id = $_GET['id']; // Get the ID of the plan to edit
$sql = "SELECT * FROM add_pricing_plan WHERE plan_id = $plan_id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

$successMessage = ""; // Initialize success message

if (isset($_POST['update'])) {
    $plan_name = $_POST['plan_name'];
    $price = $_POST['price'];
    $duration = $_POST['duration'];
    $resolution = $_POST['resolution'];

    // Update query
    $sql = "UPDATE add_pricing_plan SET 
            plan_name='$plan_name', 
            price='$price', 
            duration='$duration', 
            resolution='$resolution' 
            WHERE plan_id = $plan_id";

    // Execute query
    if (mysqli_query($conn, $sql)) {
        $successMessage = "Pricing Plan Updated Successfully!";
       
    } else {
        echo "Error updating record: " . mysqli_error($conn);
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
        #popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
            background: #1a1a1a;
            color: #fff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.7);
            text-align: center;
            width: 400px;
        }

        #popup h3 {
            margin-bottom: 15px;
            font-size: 18px;
            color: #fff;
        }

        #popup button {
            margin-top: 20px;
            padding: 10px 20px;
            background: #ffc107;
            color: #000;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #popup button:hover {
            background: #e0a800;
        }

        #popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 999;
        }
    </style>
</head>

<body class="body">
    <!-- Popup -->
    <div id="popup-overlay"></div>
    <div id="popup">
        <h3 id="popup-message">Pricing Plan Updated Successfully!</h3>
        <button onclick="closePopup()">Close</button>
    </div>

    <section class="section d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-7 col-xl-8">
                    <div class="row">
                        <!-- Section Title -->
                        <div class="col-12">
                            <h2 style="color:white" class="section__title section__title--lg">Edit Pricing Plan</h2>
                        </div>
                        <!-- End Section Title -->

                        <div class="col-12">
                            <form class="form form--contacts" method="post">
                                <div class="row row--form">
                                    <div class="col-12">
                                        <input type="text" class="form__input" placeholder="Plan Name" name="plan_name" value="<?php echo htmlspecialchars($row['plan_name']); ?>" required>
                                    </div>

                                    <div class="col-12">
                                        <input type="text" class="form__input" placeholder="Price" name="price" value="<?php echo htmlspecialchars($row['price']); ?>" required>
                                    </div>

                                    <div class="col-12">
                                        <input type="text" class="form__input" placeholder="Duration" name="duration" value="<?php echo htmlspecialchars($row['duration']); ?>" required>
                                    </div>

                                    <div class="col-12">
                                        <input type="text" class="form__input" placeholder="Resolution" name="resolution" value="<?php echo htmlspecialchars($row['resolution']); ?>" required>
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" class="form__btn" name="update">Update Plan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- JS -->
    <script>
    // Popup message logic
    const message = "<?php echo $successMessage; ?>";
    if (message) {
        const popup = document.getElementById('popup');
        const overlay = document.getElementById('popup-overlay');
        const popupMessage = document.getElementById('popup-message');

        // Set message and display popup
        popupMessage.innerText = message;
        popup.style.display = 'block';
        overlay.style.display = 'block';

        // Redirect after 3 seconds (3000 ms)
        setTimeout(() => {
            window.location.href = "index.php"; // Change to your desired redirect page
        }, 3000);
    }

    // Close popup function
    function closePopup() {
        document.getElementById('popup').style.display = 'none';
        document.getElementById('popup-overlay').style.display = 'none';
        window.location.href = "index.php"; // Redirect immediately if close is clicked
    }
</script>
<script src="js/jquery-3.5.1.min.js"></script>
	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/jquery.mousewheel.min.js"></script>
	<script src="js/jquery.mCustomScrollbar.min.js"></script>
	<script src="js/select2.min.js"></script>
	<script src="js/admin.js"></script>

</body>

</html>
