<?php
	include('../../../db/conn.php');
	session_start();
	$admin=$_SESSION['username'];
	//$id = mysqli_real_escape_string($conn, $_POST["id"]);
    $area_name = mysqli_real_escape_string($conn, $_POST["area_name"]);	 
    $area_code = mysqli_real_escape_string($conn, $_POST["area_code"]);
	$comment = mysqli_real_escape_string($conn, $_POST["comment"]);
	if($_POST['id']!=""){
		$id=$_POST['id'];
		mysqli_query($conn,"update `service_area` set area_name='$area_name',area_code='$area_code',comment='$comment' where id='$id'");
	    mysqli_query($conn,"insert into `log` (action,module,action_by) values ('Zone/Area: $area_name updated.','Settings','$admin')");
	}else{
		mysqli_query($conn,"insert into `service_area` (area_name,area_code,comment) values ('$area_name','$area_code','$comment')");
		mysqli_query($conn,"insert into `log` (action,module,action_by) values ('Zone/Area: $area_name added.','Settings','$admin')");
		
	
	}
	
	
	
	

	

	
	
	
	
	
	
	
?>