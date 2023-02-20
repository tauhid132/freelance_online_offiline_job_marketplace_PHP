<?php
include ('../database/dbconnect.php');
$offeredBy = $_POST['employer_email'];
$serviceId = $_POST['portfolio_id'];

$offeredTo = $_POST['employee_email'];

mysqli_query($conn, "INSERT INTO job_offers (offeredBy , serviceId ) VALUES ('$offeredBy', '$serviceId')");
mysqli_query($conn, "INSERT INTO notifications (email, notification) VALUES('$offeredTo','You Have Got New Job Proposal')");
header('Location: ../index.php');
?>