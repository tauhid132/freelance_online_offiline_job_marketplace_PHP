<?php
	include('../../../db/conn.php');
	session_start();
	$admin=$_SESSION['username'];
	//$id = mysqli_real_escape_string($conn, $_POST["id"]);
    $sms_name = mysqli_real_escape_string($conn, $_POST["sms_name"]);	 
    $text = mysqli_real_escape_string($conn, $_POST["text"]);
	if($_POST['id']!=""){
		$id=$_POST['id'];
		mysqli_query($conn,"update `sms_template` set sms_name='$sms_name',text='$text' where id='$id'");
	    mysqli_query($conn,"insert into `log` (action,module,action_by) values ('SMS Template No:$id is updated.','SMS','$admin')");
	}else{
		mysqli_query($conn,"insert into `sms_template` (sms_name,text) values ('$sms_name','$text')");
		mysqli_query($conn,"insert into `log` (action,module,action_by) values ('New SMS Template Created.','SMS','$admin')");
	}	
	
	
	
	

	

	
	
	
	
	
	
	
?>