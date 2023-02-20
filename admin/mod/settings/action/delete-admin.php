<?php
	$id=$_POST['id'];
	include('../../../db/conn.php');
	mysqli_query($conn,"delete from `admin` where id='$id'");
	
?>