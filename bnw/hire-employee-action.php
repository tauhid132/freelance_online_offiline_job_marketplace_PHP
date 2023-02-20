<?php
include ('database/dbconnect.php');
$employee_email = $_POST['employee_email'];
$employer_email = $_POST['employer_email'];
$portfolio_id = $_POST['portfolio_id'];
echo $employer_email;
echo $employee_email;

mysqli_query($conn, "INSERT INTO hire_employee (employeeEmail, employerEmail, servicePortfolioId) VALUES ('$employee_email', '$employer_email', '$portfolio_id')");
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>