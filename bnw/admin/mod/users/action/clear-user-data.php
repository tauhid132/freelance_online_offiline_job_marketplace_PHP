<?php
include('../../../db/conn.php');
$id=$_POST['id'];

session_start();
$admin=$_SESSION['username'];

$username="";
$area="";
$cus_name="";
$password="";
    //$password = password_hash($password, PASSWORD_DEFAULT);
$com_name="";
$responsible_person="";
$conn_address="";
$bill_address="";
$mobile="";
$email="";
$nidNo="";
$status="Inactive";
$activation_date="";
$conn_type="";
$pack_name="";
$conn_media="";
$ip_address="";
$ont_mac="";
$monthly_bill="";
$due="";
$billing_type="";
$reference="";
$printInvoice="";
$fiberCode="";
$sendSms = "0";
$sendEmail = "0";
$apiEnabled = "0";
$printInvoice = "0";

$query=mysqli_query($conn,"select * from `users` where id='$id'");
$result=mysqli_fetch_array($query);
$user_id=$result['username'];
$new_data = $id;

mysqli_query($conn,"update `billing` set user_id='$new_data' where user_id='$user_id'");

mysqli_query($conn,"update `users` set cus_name='$cus_name',area='$area', username='$username', password='$password', com_name='$com_name', conn_address='$conn_address', responsible_person='$responsible_person', bill_address='$bill_address', email='$email', mobile='$mobile', nidNo='$nidNo', activation_date='$activation_date', status='$status', pack_name='$pack_name', conn_type='$conn_type', conn_media='$conn_media', ip_address='$ip_address', ont_mac='$ont_mac', due='$due', monthly_bill='$monthly_bill', reference='$reference', billing_type='$billing_type', printInvoice='$printInvoice',fiberCode='$fiberCode' where id='$id'");
mysqli_query($conn,"insert into `log` (action,module,action_by) values ('$id data is cleaned.','Users','$admin')");


?>