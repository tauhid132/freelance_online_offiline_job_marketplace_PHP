<?php
	include('../../../db/conn.php');
	
	$username=$_POST['username'];
	$fullName=$_POST['fullName'];
	$role=$_POST['role'];
	$joining_date=$_POST['joining_date'];
	$salary=$_POST['salary'];
	$mobile=$_POST['mobile'];
	$email=$_POST['email'];
	if($_POST['id']!=""){
		$id=$_POST['id'];
		mysqli_query($conn,"update `employee` set username='$username', fullName='$fullName', role='$role', joining_date='$joining_date', salary='$salary', mobile='$mobile', email='$email' where id='$id'");
	    //mysqli_query($conn,"insert into `expences` (exp_type,description,amount,date,exp_by,month) values ('$exp_type','$description','$amount','$date','$exp_by','$month')");
	}else{
		mysqli_query($conn,"insert into `employee` (username,fullName,role,joining_date,salary,mobile,email) values ('$username','$fullName','$role','$joining_date','$salary','$mobile','$email')");
	}
	
	
	
	
	//header('Location: ' . $_SERVER['HTTP_REFERER']);
	
?>