<?php
include('../../../db/conn.php');
session_start();
$admin=$_SESSION['username'];
$id=$_POST['id'];
$leftReason=$_POST['leftReason'];
$query=mysqli_query($conn,"select * from `users` where id='$id'");
$result=mysqli_fetch_array($query);


$user_id=$result['username'];
$cus_name=$result['cus_name'];
$address=$result['conn_address'];
$monthly_bill=$result['monthly_bill'];
$mobile=$result['mobile'];
$left_on = $_POST['leftDate'];


mysqli_query($conn,"insert into `left_client` (cus_name,user_id,address,mobile,left_on,monthly_bill,leftReason) values ('$cus_name','$user_id','$address','$mobile','$left_on','$monthly_bill','$leftReason')");
mysqli_query($conn,"insert into `log` (action,module,action_by) values ('$user_id is shifted to left clients.','Users','$admin')");
?>