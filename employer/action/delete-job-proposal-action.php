<?php  
include ('../../database/dbconnect.php');

$id = $_GET['job-id'];

mysqli_query($conn, "DELETE FROM job_offers WHERE id = '$id'");
header('Location: ' . $_SERVER['HTTP_REFERER']);