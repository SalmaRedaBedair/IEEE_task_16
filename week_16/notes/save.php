<?php
$conn = require_once('connection.php');
if ($_POST['id'] != "") {
    $conn->updateNotes($_POST);
} else{
    $conn->addNotes($_POST);
}
    


?>