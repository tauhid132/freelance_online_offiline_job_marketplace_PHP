<?php
	$id=$_POST['id'];
	include('../db/conn.php');
	mysqli_query($conn,"delete from `service_categories` where id='$id'");
?>