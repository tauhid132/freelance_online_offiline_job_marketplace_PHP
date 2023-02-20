<?php
	$id=$_POST['id'];
	include('../db/conn.php');
	mysqli_query($conn,"delete from `todolist` where id='$id'");
	//header('location:../leftusers.php');
?>