<?php
	$id=$_POST['id'];
	
	include('../../../db/conn.php');
	mysqli_query($conn,"delete from `expences` where id='$id' ");
?>