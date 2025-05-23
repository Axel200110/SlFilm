<?php
session_start();
$message = "";

if (isset($_POST['verify'])) {
    $enteredCode = $_POST['code'];

    if ($enteredCode == $_SESSION['verification_code']) {
        // Verification successful
        $_SESSION['id'] = $_SESSION['temp_user_id'];
        $_SESSION['e'] = $_SESSION['temp_email'];

        // Clear temporary session variables
        unset($_SESSION['verification_code']);
        unset($_SESSION['temp_user_id']);
        unset($_SESSION['temp_email']);

        $message = "Verification successful! Redirecting...";
        header("Refresh: 3; url=index.php"); // Redirect after 3 seconds
    } else {
        $message = "Invalid verification code. Please try again.";
    }
}
?>

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSS -->
    <link rel="stylesheet" href="css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="css/main.css">

    <link rel="icon" type="image/png" href="icon/cine.png">
    <link rel="apple-touch-icon" href="icon/cine.png">

    <title>Verify Code</title>

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
<body class="body">

    <div class="sign section--bg" data-bg="img/section/section.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sign__content">
                        <!-- Verification form -->
                        <form class="sign__form" method="post">
                            <a href="#" class="sign__logo">
                                <img src="img/logo1.svg" alt="">
                            </a>

                            <h2 style="color:white">Enter Verification Code</h2>
                            <div class="sign__group">
                                <input type="text" class="sign__input" placeholder="Enter code" name="code" required>
                            </div>

                            <button class="sign__btn" type="submit" name="verify">Verify</button>
                        </form>
                        <!-- End verification form -->
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
        // Display popup message
        const message = "<?php echo $message; ?>"; // PHP message passed to JS
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
