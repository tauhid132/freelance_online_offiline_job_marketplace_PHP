<?php
include('../../../../database/dbconnect.php');
$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM employer  WHERE id = '$id'");


header('Location: ' . $_SERVER['HTTP_REFERER']);

?>