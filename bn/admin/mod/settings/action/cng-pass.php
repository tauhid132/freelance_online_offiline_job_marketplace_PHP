<?php
	include('../../../db/conn.php');
	
	$username=$_POST['username'];
	$new_pass=$_POST['new_pass'];
	$new_pass = password_hash($new_pass, PASSWORD_DEFAULT);
	
		
	 mysqli_query($conn,"update `admin` set password='$new_pass' where username='$username'");
	
	
?>