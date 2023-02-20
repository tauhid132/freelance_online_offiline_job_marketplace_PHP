<?php
include('../../../db/conn.php');
session_start();
$admin=$_SESSION['username'];


$smsbody = $_POST['smsbody'];
$smstext = $smsbody;
$mobile = $_POST['mobile'];


include('../../sms/smssender.php');

mysqli_query($conn,"insert into `log` (action,module,action_by) values ('SMS Sent to  $mobile. $response','SMS','$admin')");

?>