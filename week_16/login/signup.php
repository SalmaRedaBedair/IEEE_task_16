<?php
session_start();
include_once("./includes/signup.inc.php")
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/signup.css">
</head>

<body>
    <div class="container">
        <h2>Registration</h2>
        <form method="post" href="">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="uid" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="pwd" required>
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="pwdrepeat" required>
            </div>
            <button type="submit" name="submit">Register</button>
        </form>
    </div>
</body>

</html>