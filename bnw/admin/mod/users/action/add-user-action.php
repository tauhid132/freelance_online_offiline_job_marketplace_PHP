<?php
include('../../../db/conn.php');

session_start();
$admin=$_SESSION['username'];

if(isset($_POST['sendSms'])){
	$sendSms = 1;
}else{
	$sendSms = 0;
}
if(isset($_POST['sendEmail'])){
	$sendEmail = 1;
}else{
	$sendEmail = 0;
}
if(isset($_POST['apiEnabled'])){
	$apiEnabled = 1;
}else{
	$apiEnabled = 0;
}
if(isset($_POST['printInvoice'])){
	$printInvoice = 1;
}else{
	$printInvoice = 0;
}

$apiServer = $_POST['apiServer'];

$username=$_POST['username'];
$area=mysqli_real_escape_string($conn, $_POST["area"]);
$cus_name=$_POST['cus_name'];
$password=$_POST['password'];
$password = password_hash($password, PASSWORD_DEFAULT);
$com_name=$_POST['com_name'];
$responsible_person=$_POST['responsible_person'];
$conn_address=$_POST['conn_address'];
$bill_address=$_POST['bill_address'];
$mobile=$_POST['mobile'];
$mobile2=$_POST['mobile2'];
$email=$_POST['email'];
$nidNo=$_POST['nidNo'];
$activation_date=$_POST['activation_date'];
$conn_type=$_POST['conn_type'];
$pack_name=$_POST['pack_name'];
$conn_media=$_POST['conn_media'];
$ip_address=$_POST['ip_address'];
$ont_mac=$_POST['ont_mac'];
$monthly_bill=$_POST['monthly_bill'];
$due=$_POST['due'];
$billing_type=$_POST['billing_type'];
$reference=$_POST['reference'];
$printInvoice=$_POST['printInvoice'];
$fiberCode=$_POST['fiberCode'];
$status=$_POST['status'];

mysqli_query($conn,"insert into `users` (cus_name,username,password,com_name,responsible_person,conn_address,bill_address,area,email,mobile,mobile2,nidNo,activation_date,pack_name,conn_type,conn_media,ip_address,ont_mac,monthly_bill,due,billing_type,reference,fiberCode,printInvoice,status,sendSms,sendEmail,apiEnabled,apiServer) values 
	('$cus_name','$username','$password','$com_name','$responsible_person','$conn_address','$bill_address','$area','$email','$mobile','$mobile2','$nidNo','$activation_date','$pack_name','$conn_type','$conn_media','$ip_address','$ont_mac','$monthly_bill','$due','$billing_type','$reference','$fiberCode','$printInvoice','$status','$sendSms','$sendEmail','$apiEnabled','$apiServer')");
mysqli_query($conn,"insert into `log` (action,module,action_by) values ('New User Added. UserID: $username','Users','$admin')");
header('location:../allusers.php');

?>