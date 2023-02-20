<?php
include ('../database/dbconnect.php');
$offeredBy = $_POST['employer_email'];
$serviceId = $_POST['portfolio_id'];

mysqli_query($conn, "INSERT INTO job_offers (offeredBy , serviceId ) VALUES ('$offeredBy', '$serviceId')");
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>