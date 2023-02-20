<?php
include('../../../db/conn.php');
session_start();
$admin=$_SESSION['username'];
$id = mysqli_real_escape_string($conn, $_POST["id"]);
$monthly_bill = mysqli_real_escape_string($conn, $_POST["monthly_bill"]);	 
$pre_due = mysqli_real_escape_string($conn, $_POST["pre_due"]);

$query=mysqli_query($conn,"select * from `billing` where id='$id'");
$result=mysqli_fetch_array($query);



$username=$result['user_id'];

$totalPaid = $result['paid_bill'] + $result['paid_due'];




$current_due=($monthly_bill+$pre_due) - $totalPaid;


mysqli_query($conn,"update `users` set due='$current_due' where username='$username'");

mysqli_query($conn,"update `billing` set monthly_bill='$monthly_bill',pre_due='$pre_due' where id='$id'");

	//update log
mysqli_query($conn,"insert into `log` (action,module,action_by) values ('Invoice updated of $username','Accounts','$admin')");



?>