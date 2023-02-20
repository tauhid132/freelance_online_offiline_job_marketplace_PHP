<?php
	include('../../../db/conn.php');
	session_start();
	$admin=$_SESSION['username'];
	//$id = mysqli_real_escape_string($conn, $_POST["id"]);
    $planName = mysqli_real_escape_string($conn, $_POST["planName"]);	 
    $planType = mysqli_real_escape_string($conn, $_POST["planType"]);
    $planBW = mysqli_real_escape_string($conn, $_POST["planBW"]);
	
	if($_POST['id']!=""){
		$id=$_POST['id'];
		mysqli_query($conn,"update `monthly_plans` set planName='$planName',planType='$planType',planBW='$planBW' where id='$id'");
	    //mysqli_query($conn,"insert into `log` (action,module,action_by) values ('Zone/Area: $area_name updated.','Settings','$admin')");
	}else{
		mysqli_query($conn,"insert into `monthly_plans` (planName,planType,planBW) values ('$planName','$planType','$planBW')");
		//mysqli_query($conn,"insert into `log` (action,module,action_by) values ('Zone/Area: $area_name added.','Settings','$admin')");
		
	
	}
	
	
	
	

	

	
	
	
	
	
	
	
?>