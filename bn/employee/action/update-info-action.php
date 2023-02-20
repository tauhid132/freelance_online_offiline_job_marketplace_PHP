<?php  
include ('../../database/dbconnect.php');
$email = $_POST['email'];
$fullName = $_POST['fullName'];
$profession = $_POST['profession'];
$intro = $_POST['intro'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$streetNo = $_POST['streetNo'];
$policeStation = $_POST['policeStation'];
$district = $_POST['district'];
$country = $_POST['country'];
$mobileNo = $_POST['mobileNo'];


mysqli_query($conn, "UPDATE employee SET fullName = '$fullName', profession = '$profession',intro = '$intro',dob = '$dob',gender = '$gender',streetNo = '$streetNo',policeStation = '$policeStation',district = '$district',country = '$country',mobileNo = '$mobileNo' WHERE emailAddress = '$email'");
 header('Location: ' . $_SERVER['HTTP_REFERER']);
?>