<?php
include('../../../db/conn.php');
$admin=$_SESSION['username'];

$exp_type=$_POST['exp_type'];
$description=$_POST['description'];
$amount=$_POST['amount'];
$date=$_POST['date'];
$exp_by=$_POST['exp_by'];
$month=$_POST['month'];	
if($_POST['id']!=""){
	$id=$_POST['id'];
	mysqli_query($conn,"update `expences` set exp_type='$exp_type', description='$description', amount='$amount', date='$date', exp_by='$exp_by' where id='$id'");
	    //mysqli_query($conn,"insert into `expences` (exp_type,description,amount,date,exp_by,month) values ('$exp_type','$description','$amount','$date','$exp_by','$month')");
}else{
	mysqli_query($conn,"insert into `expences` (exp_type,description,amount,date,exp_by,month) values ('$exp_type','$description','$amount','$date','$exp_by','$month')");
}

mysqli_query($conn,"insert into `log` (action,module,action_by) values ('New Expence Added.[$description , $amount]. $response','Accounts','$admin')");



?>