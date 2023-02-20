<?php
include ('../../database/dbconnect.php');
session_start();
$userType = $_SESSION['userType'];
$password = $_POST['password'];
$email = $_SESSION['email'];
$passwordN = password_hash($password, PASSWORD_DEFAULT);

if($userType == 1){
	mysqli_query($conn,"UPDATE employee SET password = '$passwordN' WHERE emailAddress = '$email'");

}else{
	mysqli_query($conn,"UPDATE employer SET password = '$passwordN' WHERE emailAddress = '$email'");
}

 header('Location: ../dashboard.php ');
?>