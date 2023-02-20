<?php

include('../../../db/conn.php');
include('../includes/routeros_api.class.php');			
include('../includes/connapi.php');
$userid=$_POST['id'];
$query=mysqli_query($conn,"select * from `users` where username='$userid'");
$result=mysqli_fetch_array($query);
$apiServer = $result['apiServer'];

mysqli_query($conn,"update `users` set  status='Active' where username='$userid'");


$userid = strtolower($userid);

$ARRAYSEC = ${$apiServer}->comm("/ppp/secret/print");
$num = count($ARRAYSEC);
for($i=0; $i<$num; $i++){
	if($ARRAYSEC[$i]['name']==$userid){
		$userID=$i;

	}
}


	//Disable Secret User
$testServergg = ${$apiServer}->comm("/ppp/secret/enable
	=.id=".$userID."");	
	//Commenting users secret
$testServergg = ${$apiServer}->comm("/ppp/secret/set", array(
	"comment"	=> "",
	"numbers"	=> $userID,
));	

mysqli_query($conn,"insert into `log` (action,module,action_by) values ('User: $userid Enabled!','API','API')");

?>