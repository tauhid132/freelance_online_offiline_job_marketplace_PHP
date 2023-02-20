<?php
include('../../../db/conn.php');
session_start();
$admin=$_SESSION['username'];


$attendance_date = $_POST["attendance_date"];
$username = $_POST["username"];
if($_POST['attendance_action']=='add'){

	$query = '
	SELECT attendance_date FROM attendance 
	WHERE attendance_date = "'.$attendance_date.'"
	';
	$statement = $connect->prepare($query);
	$statement->execute();
	if($statement->rowCount() > 0)
	{
		$message='Data Already Exists!';
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

			$message='Attendance Added Successfully!';
		}
	}
}else if($_POST['attendance_action']=='update'){

	$query = '
	SELECT attendance_date FROM attendance 
	WHERE attendance_date = "'.$attendance_date.'"
	';
	$statement = $connect->prepare($query);
	$statement->execute();
	if($statement->rowCount() > 0)
	{
		mysqli_query($conn,"delete from `attendance` where attendance_date='$attendance_date' ");
	}
	
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

		$message='Attendance Updated Successfully!';
	}
	
}

echo json_encode($message);

?>