<?php
include ('../database/dbconnect.php');
session_start();
$email = $_SESSION['email'];
$post_id = $_POST['sid'];
$countNow = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM bookmark_service_portfolio WHERE email = '$email' and service_portfolio = '$post_id'"));

if($countNow[0]>0){
	mysqli_query($conn,"DELETE from bookmark_service_portfolio WHERE email = '$email' and service_portfolio = '$post_id'  ");
}else{
	mysqli_query($conn, "INSERT INTO bookmark_service_portfolio (email, service_portfolio) VALUES ('$email','$post_id')");
}

?>