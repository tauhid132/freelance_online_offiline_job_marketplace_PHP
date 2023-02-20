<?php  
include ('../../database/dbconnect.php');
$id = $_POST['job-id'];
$timestamp = $_POST['timestamp'];



mysqli_query($conn, "UPDATE hire_employee SET jobFinishTime = '$timestamp' , jobStatus = 2 WHERE id = '$id'");
header('Location: ' . $_SERVER['HTTP_REFERER']);

?>