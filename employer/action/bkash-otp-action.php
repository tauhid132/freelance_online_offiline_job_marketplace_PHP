<?php  
include ('../../database/dbconnect.php');

$mobileNo = $_POST['mobile'];
$smstext = \random_int(100000, 999999);

$url = "https://isms.mimsms.com/smsapi";
  $data = [
    "api_key" => "C200145763023f2451a9e0.97702620",
    "type" => "text",
    "contacts" => "$mobileNo",
    "senderid" => "8809601003450",
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
  


$pay_amount = $_POST['pay_amount'];
$job_id = $_POST['job-id'];

mysqli_query($conn, "INSERT INTO bkash_otp (otp, mobile) VALUES ('$smstext', '$mobileNo')");

?>