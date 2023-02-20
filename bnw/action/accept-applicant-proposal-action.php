<?php
include ('../database/dbconnect.php');
$employee_email = $_POST['employee_email'];
$employer_email = $_POST['employer_email'];
$portfolio_id = $_POST['portfolio_id'];
echo $employer_email;
echo $employee_email;

mysqli_query($conn, "INSERT INTO hire_employee (employeeEmail, employerEmail, servicePortfolioId) VALUES ('$employee_email', '$employer_email', '$portfolio_id')");
$p_id = $_POST['proposal_id'];
mysqli_query($conn, "UPDATE apply_job set status = 1 WHERE id = '$p_id'");
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>