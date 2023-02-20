<?php  
include ('../../database/dbconnect.php');

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM job_posts WHERE id = '$id'");
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>