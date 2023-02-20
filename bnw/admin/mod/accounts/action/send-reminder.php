<?php
include('../../../db/conn.php');
session_start();
$admin=$_SESSION['username'];

$id=$_POST['id'];
$query=mysqli_query($conn,"select * from `billing` where id='$id'");
$result=mysqli_fetch_array($query);
  //$amount=$result['monthly_bill'];
  //$month= $result['billing_month'];
$username= $result['user_id'];
$smstext="Dear User, Please pay your Internet bill by bKash.(Payment-01304779899). Please put ($username) in Reference. For assistance visit atsbd.net/pay-bill or call 01700833726. ATS Technology";

$query2=mysqli_query($conn,"select * from `users` where username='$username'");
$result2=mysqli_fetch_array($query2);
$mobile=$result2['mobile'];


include('../../sms/smssender.php');
mysqli_query($conn,"insert into `log` (action,module,action_by) values ('Confirmation SMS Sent to $username. $response','SMS','$admin')");

?>

