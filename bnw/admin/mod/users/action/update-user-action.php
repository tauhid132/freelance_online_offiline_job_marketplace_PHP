<?php
include('../../../db/conn.php');
$id=$_GET['id'];


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
$area=$_POST['area'];
$cus_name=$_POST['cus_name'];
$password=$_POST['password'];
$password = password_hash($password, PASSWORD_DEFAULT);
$com_name=$_POST['com_name'];
$responsible_person=$_POST['responsible_person'];
$conn_address=$_POST['conn_address'];
$bill_address=$_POST['bill_address'];
$mobile=$_POST['mobile'];
$email=$_POST['email'];
$nidNo=$_POST['nidNo'];
$status=$_POST['status'];
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
$mobile2=$_POST['mobile2'];

$fiberCode=$_POST['fiberCode'];

mysqli_query($conn,"update `users` set cus_name='$cus_name',area='$area', username='$username', password='$password', com_name='$com_name', conn_address='$conn_address', responsible_person='$responsible_person', bill_address='$bill_address', email='$email', mobile='$mobile', mobile2='$mobile2', nidNo='$nidNo', activation_date='$activation_date', status='$status', pack_name='$pack_name', conn_type='$conn_type', conn_media='$conn_media', ip_address='$ip_address', ont_mac='$ont_mac', due='$due', monthly_bill='$monthly_bill', reference='$reference', billing_type='$billing_type', printInvoice='$printInvoice',fiberCode='$fiberCode',sendSms='$sendSms',sendEmail='$sendEmail',apiEnabled='$apiEnabled',apiServer='$apiServer' where id='$id'");
header('location:../allusers.php');
?>