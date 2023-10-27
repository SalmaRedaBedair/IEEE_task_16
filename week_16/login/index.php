<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script>
        function closeErrorBox() {
            var errorBox = document.getElementById("errorBox");
            errorBox.parentNode.removeChild(errorBox);
        }
    </script>
</head>

<body>
    <div class="container">
        <?php
        if (isset($_GET['error']) && $_GET['error'] != "none") {
            $errorMessage = htmlspecialchars($_GET['error']);
            echo '<div id="errorBox" class="error-box">
                    <span class="error-message">' . $errorMessage . '</span>
                    <button class="close-button" onclick="closeErrorBox()">Close</button>
                </div>';
        }
        ?>
        <h1>Welcome to Your Home Screen!</h1>
        <div class="buttons">
            <?php
            if (!isset($_SESSION['user_id'])) {
                ?>
                <a href="login.php" class="login-button">Login</a>
                <a href="signup.php" class="signup-button">Sign Up</a>
                <?php
            } else {
                ?>
                <a href="includes/logout.inc.php" class="logout-button">Logout</a>
                <?php
            }
            ?>
        </div>
    </div>

    <div id="errorDialog" class="dialog">
        <div class="dialog-content">
            <h2>Error</h2>
            <p>An error occurred. Please try again.</p>
            <button id="closeButton">Close</button>
        </div>
    </div>
</body>

</html