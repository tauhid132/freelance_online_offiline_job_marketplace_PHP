<?php
include ('../../database/dbconnect.php');
$job_id = $_GET['job-id'];


$query=mysqli_query($conn,"SELECT * FROM job_offers  WHERE id = '$job_id';");
$result=mysqli_fetch_array($query);

$hireBy = $result['offeredBy'];
$serviceId = $result['serviceId'];

$query2=mysqli_query($conn,"SELECT * FROM service_portfolio  WHERE id = '$serviceId';");
$result2=mysqli_fetch_array($query2);

$employee_email = $result2['employee_email'];




mysqli_query($conn, "INSERT INTO hire_employee (employeeEmail, employerEmail, servicePortfolioId) VALUES ('$employee_email', '$hireBy', '$serviceId')");

$hire_job_id = mysqli_insert_id($conn);


mysqli_query($conn, "UPDATE job_offers SET status = 1, jobId = '$hire_job_id' WHERE id = '$job_id'");


header('Location: ' . $_SERVER['HTTP_REFERER']);
?>