<?php
if (isset($_POST["submit"])) {
    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];
    $pwdrepeat = $_POST['pwdrepeat'];
    $email = $_POST['email'];

    include_once('./classes/dbh.classes.php');
    include_once('./classes/signup.classes.php');
    include_once('./classes/signup-contr.classes.php');

    $signup=new signupContr($uid,$pwd,$pwdrepeat,$email);

    $signup->signupUser();

    header('location: ./index.php?error=none');
}