<?php
	include('../../../db/conn.php');
	
	$username=$_POST['username'];
	$full_name=$_POST['full_name'];
	$role=$_POST['role'];
	$password=$_POST['password'];
    $password = password_hash($password, PASSWORD_DEFAULT);
	
	
	mysqli_query($conn,"insert into `admin` (username,full_name,role,password) values ('$username','$full_name','$role','$password')");
	
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	
?>