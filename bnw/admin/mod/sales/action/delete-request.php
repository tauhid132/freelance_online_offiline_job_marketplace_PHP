<?php
	$id=$_POST['id'];
	include('../../../db/conn.php');
	mysqli_query($conn,"delete from `newconnectionrequest` where id='$id'");
	
?>