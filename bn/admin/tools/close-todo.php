<?php
	$id=$_POST['id'];
	include('../db/conn.php');
	
	mysqli_query($conn,"update `todolist` set status='1' where id='$id'");
	//header('location:../leftusers.php');
?>