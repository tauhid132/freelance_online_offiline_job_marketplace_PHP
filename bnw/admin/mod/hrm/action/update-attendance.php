<?php
include('../../../db/conn.php');
session_start();
$admin=$_SESSION['username'];


	$attendance_date = $_POST["attendance_date"];
	$username = $_POST["username"];


	$query = '
	SELECT attendance_date FROM attendance 
	WHERE attendance_date = "'.$attendance_date.'"
	';
	$statement = $connect->prepare($query);
	$statement->execute();
	if($statement->rowCount() > 0)
	{
		$message='<div class="alert alert-danger">Date Exists</div>';
	}
	else{
		for($count = 0; $count < count($username); $count++){
			$data = array(
				':username'         =>  $username[$count],
				':attendance_status'  =>  $_POST["attendance_status".$username[$count].""],
				':attendance_date'    =>  $attendance_date,
			);
			$query = "
			INSERT INTO attendance 
			(username, attendance_status, attendance_date) 
			VALUES (:username, :attendance_status, :attendance_date)
			";
			$statement = $connect->prepare($query);
			$statement->execute($data);

			$message='<div class="alert alert-success">Attendance Added Successfully</div>';
		}
	}



?>