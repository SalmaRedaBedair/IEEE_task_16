<?php
session_start();
include_once("./includes/login.inc.php")
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>

<body>
    <div class="container">
        <h2>Login</h2>
        <form href="" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="uid" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="pwd" required>
            </div>
            <button type="submit" name="submit">Login</button>
        </form>
    </div>
</body>

</html>
<?php
include_once("./includes/login.inc.php")
?>