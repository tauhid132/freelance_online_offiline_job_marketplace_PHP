<?php  
include ('../../../db/conn.php');
session_start();
$admin = $_SESSION['username'];

$mobile=$_POST['mobile'];
$smstext=$_POST['smsbody'];
include('../smssender.php');
mysqli_query($conn,"insert into `log` (action,module,action_by) values ('SMS sent to $mobile. [$response]','SMS','$admin')");



?>