<?php
	$id=$_POST['id'];
	include('../../../db/conn.php');
	mysqli_query($conn,"delete from `left_client` where id='$id'");
	//header('location:../leftusers.php');
?>