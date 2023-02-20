<?php
include ('database/dbconnect.php');
session_start();


if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
	include('index-employer.php');
}else{
	$userType = $_SESSION['userType'];
	// echo $userType;
	if($userType == 1){
		include('index-employee.php');
	}else if($userType == 0){
		include('index-employer.php');
	}
}

?>
