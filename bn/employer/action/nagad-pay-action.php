<?php  
include ('../../database/dbconnect.php');


$pay_amount = $_POST['salary'];
$job_id = $_POST['job_id'];

mysqli_query($conn, "INSERT INTO job_payments (jobId, payAmount, payMethod) VALUES ('$job_id', '$pay_amount','Nagad')");

$query=mysqli_query($conn,"SELECT * FROM hire_employee  WHERE id = '$job_id';");
$result=mysqli_fetch_array($query);
$employee_email = $result['employeeEmail'];
mysqli_query($conn, "INSERT INTO notifications (email, notification) VALUES('$employee_email','Payment Received Successfully for JOB-ID: $job_id')");

header('Location: ../payment.php');
?>