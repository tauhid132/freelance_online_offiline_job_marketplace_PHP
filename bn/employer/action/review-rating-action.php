<?php  
include ('../../database/dbconnect.php');
$id = $_POST['job_id'];
$rating = $_POST['rating'];
$comment = $_POST['comment'];


mysqli_query($conn, "UPDATE hire_employee SET jobRating = '$rating',  jobComment = '$comment' WHERE id = '$id'");
header('Location: ' . $_SERVER['HTTP_REFERER']);

?>