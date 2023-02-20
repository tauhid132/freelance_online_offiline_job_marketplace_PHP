<?php
	$id=$_POST['id'];
	include('../db/conn.php');
	mysqli_query($conn,"delete from `operation_area` where id='$id'");
?>