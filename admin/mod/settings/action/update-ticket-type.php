<?php
	include('../../../db/conn.php');
	session_start();
	$admin=$_SESSION['username'];
	//$id = mysqli_real_escape_string($conn, $_POST["id"]);
    $type_name = mysqli_real_escape_string($conn, $_POST["type_name"]);
	
    
	if($_POST['id']!=""){
		$id=$_POST['id'];
		mysqli_query($conn,"update `ticket_type` set type_name='$type_name' where id='$id'");
	    mysqli_query($conn,"insert into `log` (action,module,action_by) values ('New Zone/Area: dsfsdd.','Settings','$admin')");
	}else{
		mysqli_query($conn,"insert into `ticket_type` (type_name) values ('$type_name')");
		//mysqli_query($conn,"insert into `log` (action,module,action_by) values ('Zone/Area: $area_name updated.','Settings','$admin')");
		
	
	}
	
	
	
	

	

	
	
	
	
	
	
	
?>