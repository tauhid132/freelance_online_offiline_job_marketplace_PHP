<?php
	include('../db/conn.php');
	session_start();
	
    $todoName = $_POST['todoName'];
    $createdBy = $_POST['createdBy'];

	mysqli_query($conn,"insert into `todolist`(todoName,createdBy) values ('$todoName','$createdBy')");
	
	
	
	
	

	

	
	
	
	
	
	
	
?>