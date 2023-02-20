<?php
include('../../../db/conn.php');

$cus_name=$_POST['cus_name'];
$user_id=$_POST['user_id'];
$address=$_POST['address'];
$mobile=$_POST['mobile'];
$left_on=$_POST['left_on'];
$monthly_bill=$_POST['monthly_bill'];



mysqli_query($conn,"insert into `left_client` (cus_name,user_id,address,mobile,left_on,monthly_bill) values ('$cus_name','$user_id','$address','$mobile','$left_on','$monthly_bill')");

header('Location: ' . $_SERVER['HTTP_REFERER']);

?>