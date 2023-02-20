<?php  
include ('../../../db/conn.php');
session_start();
$admin = $_SESSION['username'];

$sms_type=$_POST['sms_type'];

foreach ($_POST['selectedUsers'] as $selected) {
	$query=mysqli_query($conn,"select * from `users` where username='$selected'");
	$result=mysqli_fetch_array($query);
	$mobile=$result['mobile'];

	if($sms_type=='bill-rem-1'){
		$smstext="Dear user, Please pay your Internet Bill by bKash. Payment A/C 01304779899. Reference: $selected. For Assistance visit atsbd.net/pay-bill. ATS Technology";
	}elseif ($sms_type=='bill-rem-warn') {
		$smstext="Dear user, Please pay your Internet Bill by bkash. Payment A/C 01304779899. Reference: $selected. For Assistance visit atsbd.net/pay-bill. ATS Technology";
	}else{
		$smstext="";
	}
    
	include('../smssender.php');
	mysqli_query($conn,"insert into `log` (action,module,action_by) values ('Reminder SMS Sent to $selected. $response','SMS','$admin')");
}

?>