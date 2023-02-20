<?php  
include ('../../database/dbconnect.php');
$id = $_POST['job-id'];
$timestamp = $_POST['timestamp'];



mysqli_query($conn, "UPDATE hire_employee SET jobStartTime = '$timestamp',  jobStatus = 1 WHERE id = '$id'");

?>