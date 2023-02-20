<?php
include('../../../db/conn.php');
session_start();
$admin=$_SESSION['username'];
$id=$_POST['id'];
$query2=mysqli_query($conn,"select * from `users` where id='$id'");
$result2=mysqli_fetch_array($query2);

if($result2['autoDisconnect']==0){
	if($result2['apiEnabled']==0){
		$response="Enable API First!!";
	}else{
		mysqli_query($conn,"update `users` set autoDisconnect='1' where id='$id'");
	//mysqli_query($conn,"insert into `log` (action,module,action_by) values ('API Enabled.','Settings','$admin')");
		$response="Auto Disconnection Activated!!";
	}

}else if($result2['autoDisconnect']==1){
	mysqli_query($conn,"update `users` set autoDisconnect='0' where id='$id'");
	//mysqli_query($conn,"insert into `log` (action,module,action_by) values ('API Disabled.','Settings','$admin')");
	$response="Auto Disconnection Deactivated!!";
}
echo json_encode($response);
?>