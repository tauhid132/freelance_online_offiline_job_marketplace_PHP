<?php
	$id=$_POST['id'];
	include('../../../db/conn.php');
	mysqli_query($conn,"delete from `products` where id='$id'");
	//header('Location: ' . $_SERVER['HTTP_REFERER']);
?>