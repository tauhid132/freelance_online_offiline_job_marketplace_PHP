<?php
	include('../db/conn.php');
	session_start();
	$admin=$_SESSION['username'];
	//$id = mysqli_real_escape_string($conn, $_POST["id"]);
    $policeStation = mysqli_real_escape_string($conn, $_POST["policeStation"]);	 
    $city = mysqli_real_escape_string($conn, $_POST["city"]);
    
	
	if($_POST['id']!=""){
		$id=$_POST['id'];
		mysqli_query($conn,"update `operation_area` set policeStation='$policeStation',city='$city' where id='$id'");
	    //mysqli_query($conn,"insert into `log` (action,module,action_by) values ('Zone/Area: $area_name updated.','Settings','$admin')");
	}else{
		mysqli_query($conn,"insert into `operation_area` (policeStation, city) values ('$policeStation','$city')");
		//mysqli_query($conn,"insert into `log` (action,module,action_by) values ('Zone/Area: $area_name added.','Settings','$admin')");
		
	
	}
	
	
	
	

	

	
	
	
	
	
	
	
?>