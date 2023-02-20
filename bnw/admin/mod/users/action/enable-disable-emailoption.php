<?php
include('../../../db/conn.php');
session_start();
$admin=$_SESSION['username'];
$id=$_POST['id'];
$query2=mysqli_query($conn,"select * from `users` where id='$id'");
$result2=mysqli_fetch_array($query2);

if($result2['sendEmail']==0){
	mysqli_query($conn,"update `users` set sendEmail='1' where id='$id'");
	//mysqli_query($conn,"insert into `log` (action,module,action_by) values ('API Enabled.','Settings','$admin')");
	$response="Enabled Email!!";

}else if($result2['sendEmail']==1){
	mysqli_query($conn,"update `users` set sendEmail='0' where id='$id'");
	//mysqli_query($conn,"insert into `log` (action,module,action_by) values ('API Disabled.','Settings','$admin')");
	$response="Disabled Email!!";
}
echo json_encode($response);
?>