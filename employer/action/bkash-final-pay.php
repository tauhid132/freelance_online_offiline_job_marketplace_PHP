<?php  
include ('../../database/dbconnect.php');

$otp = $_POST['otp'];
$pay_amount = $_POST['pay_amount'];
$job_id = $_POST['job-id'];

mysqli_query($conn, "INSERT INTO job_payments (jobId, payAmount, payMethod) VALUES ('$job_id', '$pay_amount','bkash')");


?>