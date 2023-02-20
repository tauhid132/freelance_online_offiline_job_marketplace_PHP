<?php

include('../../../db/conn.php');
include('../includes/routeros_api.class.php');			
include('../includes/connapi.php');
$userid=$_POST['id'];
$query=mysqli_query($conn,"select * from `users` where username='$userid'");
$result=mysqli_fetch_array($query);
$apiServer = $result['apiServer'];


mysqli_query($conn,"update `users` set  status='Expired' where username='$userid'");

$userid = strtolower($userid);

$ARRAYSEC = ${$apiServer}->comm("/ppp/secret/print");
$num = count($ARRAYSEC);
for($i=0; $i<$num; $i++){
	if($ARRAYSEC[$i]['name']==$userid){
		$userID=$i;

	}
}


	//Disable Secret User
$testServergg = ${$apiServer}->comm("/ppp/secret/disable
	=.id=".$userID."");	
	//Commenting users secret
$testServergg = ${$apiServer}->comm("/ppp/secret/set", array(
	"comment"	=> "Disabled by API::Expired",
	"numbers"	=> $userID,
));	

$ARRAYSEC2 = ${$apiServer}->comm("/ppp/active/print");
$num2 = count($ARRAYSEC2);
for($j=0; $j<$num2; $j++){
	if($ARRAYSEC2[$j]['name']==$userid){
		$userID2=$j;
			// echo $userID;

	}

}
	//Removing user from active list
$testServergg = ${$apiServer}->comm("/ppp/active/remove
	=.id=".$userID2."");


	//send sms to user
$mobile= $result['mobile'];
$smstext="Dear user, Your Internet is Expired! Please recharge your account. For Payment visit atsbd.net/pay-bill. Helpline: 01304779890. ATS Technology";
include('../../sms/smssender.php');

mysqli_query($conn,"insert into `log` (action,module,action_by) values ('User: $userid disabled!','API','API')");
mysqli_query($conn,"update `users` set  status='Expired' where username='$username'");


?>