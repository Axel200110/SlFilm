<?php
session_start();
if (!isset($_SESSION['e'])) {
    header('Location: signin.php');
    exit;
}

include('conn.php');
$message = ""; // Initialize message

if (isset($_POST['sub'])) {
    $plan = $_POST['plan'];
    $price = $_POST['price'];
    $duration = $_POST['duration'];
    $resolution = $_POST['resolution'];
    $availability = $_POST['availability'];
    $compatibility = $_POST['compatibility'];
    $support = $_POST['support'];

    $sql = "INSERT INTO `add_pricing_plan`(`plan_name`, `price`, `duration`, `resolution`, `availability`, `compatibility`, `support`) 
            VALUES ('$plan','$price','$duration','$resolution','$availability','$compatibility','$support')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $message = "Pricing Plan Added Successfully!";
    } else {
        $message = "Failed to add the Pricing Plan. Please try again.";
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

    <title>SLFilm – Add Pricing Plan</title>

    <style>
        /* Popup Modal Styles */
        #popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 300px;
        }

        #popup button {
            margin-top: 10px;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #popup button:hover {
            background: #0056b3;
        }

        #popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
    </style>
</head>

<body>
    <div class="sign section--bg" data-bg="img/section/section.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sign__content">
                        <!-- Pricing Plan Form -->
                        <form class="form" method="post">
                            <h2>Add Pricing Plan</h2>
                            <div class="form__group">
                                <input type="text" class="form__input" name="plan" placeholder="Plan Name" required>
                            </div>
                            <div class="form__group">
                                <input type="text" class="form__input" name="price" placeholder="Price" required>
                            </div>
                            <div class="form__group">
                                <input type="text" class="form__input" name="duration" placeholder="Duration" required>
                            </div>
                            <div class="form__group">
                                <input type="text" class="form__input" name="resolution" placeholder="Resolution" required>
                            </div>
                            <div class="form__group">
                                <input type="text" class="form__input" name="availability" placeholder="Availability" required>
                            </div>
                            <div class="form__group">
                                <input type="text" class="form__input" name="compatibility" placeholder="Compatibility" required>
                            </div>
                            <div class="form__group">
                                <input type="text" class="form__input" name="support" placeholder="Support" required>
                            </div>
                            <button type="submit" class="form__btn" name="sub">Publish</button>
                        </form>
                        <!-- End Pricing Plan Form -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Popup Modal -->
    <div id="popup-overlay"></div>
    <div id="popup">
        <p id="popup-message"></p>
        <button onclick="closePopup()">OK</button>
    </div>

    <!-- JS -->
    <script>
        const message = "<?php echo $message; ?>";
        if (message) {
            const popup = document.getElementById('popup');
            const overlay = document.getElementById('popup-overlay');
            const popupMessage = document.getElementById('popup-message');

            // Set the message and show the popup
            popupMessage.innerText = message;
            popup.style.display = 'block';
            overlay.style.display = 'block';
        }

        // Function to close the popup
        function closePopup() {
            document.getElementById('popup').style.display = 'none';
            document.getElementById('popup-overlay').style.display = 'none';

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

   