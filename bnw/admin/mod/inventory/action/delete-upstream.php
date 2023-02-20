<?php
	$id=$_POST['id'];
	include('../../../db/conn.php');
	mysqli_query($conn,"delete from `upstream` where id='$id'");
?>