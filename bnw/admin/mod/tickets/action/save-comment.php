<?php
	$id=$_POST['id'];
	$comment=$_POST['comment'];
	include('../../../db/conn.php');
	
	mysqli_query($conn,"update `tickets` set review='$comment' where id='$id'");
	//header('location:../leftusers.php');
?>