<?php
	$id=$_POST['id'];
	include('../../../db/conn.php');
	mysqli_query($conn,"delete from `ticket_type` where id='$id'");
	
?>