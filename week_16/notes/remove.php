<?php
$conn=require_once('connection.php');
if(isset($_GET['id']))
$conn->remove($_GET['id']);
?>