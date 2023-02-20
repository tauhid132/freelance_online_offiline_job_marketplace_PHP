<?php
include('conn.php');
	$id=$_GET['id'];
	$query=mysqli_query($conn,"select * from `billing` where id='$id'");
	$result=mysqli_fetch_array($query);
	$amount=$result['paid_bill'];
	$month= $result['billing_month'];
	$username= $result['user_id'];
    $smstext="Dear Customer, your Internet bill of $month Tk.$amount is received. Thank You for the payment. ATS Technology";


    $query2=mysqli_query($conn,"select * from `users` where username='$username'");
	$result2=mysqli_fetch_array($query2);
	$mobile=$result2['mobile'];




$url = "http://esms.mimsms.com/smsapi";
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
  curl_close($ch);
  return $response;
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>