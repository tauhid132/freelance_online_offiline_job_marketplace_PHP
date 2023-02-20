<?php
include('../../../db/conn.php');
$user_id=$_POST['user_id'];
$cus_name=$_POST['cus_name'];
$monthly_bill=$_POST['monthly_bill'];
$due=$_POST['due'];
$month=$_POST['month'];


mysqli_query($conn,"insert into billing (user_id, cus_name, monthly_bill, pre_due, billing_month) values ('$user_id','$cus_name','$monthly_bill','$due','$month')
	");

mysqli_query($conn,"update `users` set due=($monthly_bill + $due) where username='$user_id'");
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
