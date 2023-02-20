<?php
	$id=$_GET['id'];
	include('../../../db/conn.php');
	mysqli_query($conn,"delete from `sms_template` where id='$id'");
	header('Location: ' . $_SERVER['HTTP_REFERER']);
?>