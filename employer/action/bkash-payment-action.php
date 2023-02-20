<?php  
include ('../../database/dbconnect.php');

$otp = $_POST['otp'];
$pay_amount = $_POST['pay_amount'];
$job_id = $_POST['job-id'];

$query=mysqli_query($conn,"SELECT * FROM bkash_otp  WHERE otp = '$otp'");
$result=mysqli_fetch_array($query);


date_default_timezone_set("Asia/Dhaka");
$expireTime = $result['timestamp'];
$fExpire = date('Y-m-d H:i:s', strtotime('+50 minutes', strtotime($expireTime)));
$currentTime = date("Y-m-d H:i:s");
$now = strtotime($currentTime);
$expire = strtotime($fExpire);

if($expire > $now){
	
	echo json_encode(1);
}else{
	echo json_encode(0);
}

?>