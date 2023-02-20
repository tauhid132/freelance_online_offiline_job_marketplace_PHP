<?php
	include('../../../db/conn.php');
	
	$user_id=$_POST['user_id'];
	$cus_name=$_POST['cus_name'];
	$on_account=$_POST['on_account'];
	$amount=$_POST['amount'];
	$month=$_POST['month'];
	$gen_by=$_POST['gen_by'];	
	
	mysqli_query($conn,"insert into `otc_others` (user_id,cus_name,on_account,amount,gen_by,month) values ('$user_id','$cus_name','$on_account','$amount','$gen_by','$month')");
	
	
	
	
	
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	
?>