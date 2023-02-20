<?php
include ('../database/dbconnect.php');
$jobPostId = $_POST['jobPostId'];
$applicantEmail = $_POST['email'];
$proposal = $_POST['proposal'];
$serviceId = $_POST['serviceId'];
$employer_email = $_POST['employer_email'];

mysqli_query($conn, "INSERT INTO apply_job (applicantEmail , jobPostId , proposalText, serviceId) VALUES ('$applicantEmail', '$jobPostId', '$proposal', '$serviceId')");
mysqli_query($conn, "INSERT INTO notifications (email, notification) VALUES('$employer_email','A new aplicant apply for your Job Post.')");
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>