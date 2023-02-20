<?php  
include ('../../database/dbconnect.php');
session_start();
$email = $_SESSION['email'];
$id = $_POST['id'];
$jobTitle = $_POST['jobTitle'];
$serviceCategory = $_POST['serviceCategory'];
$jobDescription = $_POST['jobDescription'];
$jobSalary = $_POST['jobSalary'];
$jobSalaryMethod = $_POST['jobSalaryMethod'];
$jobWorkingType = $_POST['jobWorkingType'];
$jobDeadline = $_POST['jobDeadline'];
$jobExperience = $_POST['jobExperience'];


mysqli_query($conn, "UPDATE job_posts SET email = '$email', jobTitle = '$jobTitle',serviceCategory = '$serviceCategory',jobDescription = '$jobDescription',jobSalary = '$jobSalary',jobSalaryMethod = '$jobSalaryMethod',jobWorkingType = '$jobWorkingType',jobDeadline = '$jobDeadline', jobExperience = '$jobExperience' WHERE id = '$id'");




 header('Location: ' . $_SERVER['HTTP_REFERER']);
?>