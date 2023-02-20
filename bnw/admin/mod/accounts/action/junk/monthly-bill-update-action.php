<?php
	include('../../../db/conn.php');
	$id=$_GET['id'];
	
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
	
	
    mysqli_query($conn,"update `users` set due='$current_due' where username='$username'");
	
	mysqli_query($conn,"update `billing` set paid_bill='$paid_bill',paid_due='$paid_due',pay_date='$pay_date',pay_method='$pay_method' where id='$id'");
	
	
	
	if (isset($_POST['sendsms'])){
	
	
	
	
    $smstext="Dear Subsciber, Your payment Tk.$amount is received. Your Current Due is Tk.$current_due. Thank you for the payment. ATS Technology";




$url = "http://esms.mimsms.com/smsapi";
$number="88017,88018,88019";
$text="Hello Bangladesh";
$data = [
    "api_key" => "C20064885ee37d4c291cd8.35143811",
    "type" => "text",
    "contacts" => "$mobile",
    "senderid" => "8809612446205",
    "msg" => "$smstext",
  ];

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $response = curl_exec($ch);
header('Location: ' . $_SERVER['HTTP_REFERER']);
	}else{
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
	
	
	
	
	
?>