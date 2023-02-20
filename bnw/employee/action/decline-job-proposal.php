<?php
include ('../../database/dbconnect.php');
$job_id = $_GET['job-id'];



mysqli_query($conn, "UPDATE job_offers SET status = 2 WHERE id = '$job_id'");


header('Location: ' . $_SERVER['HTTP_REFERER']);
?>