<?php
	$new_name=$_POST['new_name'];
	include('../../../db/conn.php');
	mysqli_query($conn,"update `setting` set siteName='$new_name' where id='1'");
?>