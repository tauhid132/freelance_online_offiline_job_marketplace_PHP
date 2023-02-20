<?php  
include ('../../../db/conn.php');
session_start();
$admin = $_SESSION['username'];

$sms_text=$_POST['sms_text'];

foreach ($_POST['selectedUsers'] as $selected) {
	$query=mysqli_query($conn,"select * from `users` where username='$selected'");
	$result=mysqli_fetch_array($query);

	$mobile=$result['mobile'];




	$smstext = $sms_text;

	include('../smssender.php');
	mysqli_query($conn,"insert into `log` (action,module,action_by) values ('SMS Sent to $selected. $response','SMS','$admin')");
}

?>