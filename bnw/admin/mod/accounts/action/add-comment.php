<?php
	$id=$_POST['id'];
	$comment=$_POST['comment'];
	include('../../../db/conn.php');
	
	mysqli_query($conn,"update `billing` set comment='$comment' where id='$id'");
	//header('location:../leftusers.php');
?>