<?php  
include ('../../database/dbconnect.php');

$jobTitle = $_POST['jobTitle'];
$serviceCategory = $_POST['serviceCategory'];
$jobDescription = $_POST['jobDescription'];
$serviceSalary = $_POST['serviceSalary'];
$serviceSalaryMethod = $_POST['serviceSalaryMethod'];
$jobWorkingType = $_POST['jobWorkingType'];
$jobDeadline = $_POST['jobDeadline'];
$jobExperience = $_POST['jobExperience'];
$email = $_POST['email'];

mysqli_query($conn, "INSERT INTO job_posts (email ,jobTitle, serviceCategory, 	jobDescription, jobSalary, jobSalaryMethod, jobWorkingType, jobDeadline, jobExperience) 
		VALUES 
		('$email','$jobTitle','$serviceCategory', '$jobDescription', '$serviceSalary', '$serviceSalaryMethod', '$jobWorkingType', '$jobDeadline', '$jobExperience')
	");




header('Location: ../my-job-posts.php');



?>