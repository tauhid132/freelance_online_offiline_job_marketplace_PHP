<?php
include('../../../../database/dbconnect.php');
$id = $_GET['id'];

mysqli_query($conn, "UPDATE transfer_balance SET status = 1 WHERE id = '$id'");




header('Location: ' . $_SERVER['HTTP_REFERER']);

?>