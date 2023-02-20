<?php
include('../../../db/conn.php');
session_start();
$admin=$_SESSION['username'];
$id = mysqli_real_escape_string($conn, $_POST["id"]);
$monthly_bill2 = mysqli_real_escape_string($conn, $_POST["monthly_bill"]);	 
$pre_due2 = mysqli_real_escape_string($conn, $_POST["pre_due"]);

$query=mysqli_query($conn,"select * from `billing` where id='$id'");
$result=mysqli_fetch_array($query);

$totalbill = $result['monthly_bill'] + $result['pre_due'];
$totalpaid = $_POST['paid_bill'] + $_POST['paid_due'];
$current_due = $totalbill - $totalpaid;

$username=$result['user_id'];
$month= $result['billing_month'];
$amount=$_POST['paid_bill'] + $_POST['paid_due'] ;
$paid_bill=$_POST['paid_bill'];
$paid_due=$_POST['paid_due'];

$query2=mysqli_query($conn,"select * from `users` where username='$username'");
$result2=mysqli_fetch_array($query2);
$mobile=$result2['mobile'];


$pay_date=$_POST['pay_date'];
	//$received_by=$_POST['received_by'];
$pay_method=$_POST['pay_method'];
$trxid = $_POST['trxid'];

$today = date("Y-m-10"); 
$expireDate = date("Y-m-d", strtotime("$today +1 month"));
mysqli_query($conn,"update `users` set due='$current_due', status='Active', expireDate='$expireDate' where username='$username'");

mysqli_query($conn,"update `billing` set paid_bill='$paid_bill',paid_due='$paid_due',pay_date='$pay_date',pay_method='$pay_method',monthly_bill='$monthly_bill2',pre_due='$pre_due2',trxid='$trxid' where id='$id'");

	//update log
mysqli_query($conn,"insert into `log` (action,module,action_by) values ('Payment added in $username. Monthly($paid_bill) & Due($paid_due) by $pay_method.','Accounts','$admin')");


if (isset($_POST['sendsms'])){

	$smstext="Dear Subsciber, Your payment Tk.$amount is received. Your Current Due is Tk.$current_due. Thank you for the payment. ATS Technology";
	include('../../sms/smssender.php');

	mysqli_query($conn,"insert into `log` (action,module,action_by) values ('Confirmation SMS Sent to $username. $response','SMS','$admin')");
}
if (isset($_POST['sendemail'])){

	$clientEmail = $result2['email'];
	$subject ="Bill Payment [Username: $username]";
	$body = "Dear $user_id,<br>
			 Your payment Tk.$amount is received.<br>
			 Current Due is Tk.$current_due.<br>
			 Thank you for the payment.
			<br>
			<br>
			Best Regards,<br>
			Accounts <br>
			<b>ATS Technology</b>
	";
	include('../../email/emailsender.php');

	mysqli_query($conn,"insert into `log` (action,module,action_by) values ('Confirmation Email Sent to $username. $response','Email','$admin')");
}



header('Location: ' . $_SERVER['HTTP_REFERER']);

?>