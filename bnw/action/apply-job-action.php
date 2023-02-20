<?php
include ('../database/dbconnect.php');
$jobPostId = $_POST['jobPostId'];
$applicantEmail = $_POST['email'];
$proposal = $_POST['proposal'];
$serviceId = $_POST['serviceId'];

mysqli_query($conn, "INSERT INTO apply_job (applicantEmail , jobPostId , proposalText, serviceId) VALUES ('$applicantEmail', '$jobPostId', '$proposal', '$serviceId')");
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>