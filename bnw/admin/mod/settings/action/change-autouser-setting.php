<?php
include('../../../db/conn.php');
session_start();
$admin=$_SESSION['username'];
$query2=mysqli_query($conn,"select * from `setting` where id='1'");
$result2=mysqli_fetch_array($query2);

if($result2['enableAutoUser']==0){
	mysqli_query($conn,"update `setting` set enableAutoUser='1' where id='1'");
	mysqli_query($conn,"insert into `log` (action,module,action_by) values ('Auto Disconnection Enabled.','Settings','$admin')");
	$response="Auto Disconnection Enabled!!";

}else if($result2['enableAutoUser']==1){
	mysqli_query($conn,"update `setting` set enableAutoUser='0' where id='1'");
	mysqli_query($conn,"insert into `log` (action,module,action_by) values ('Auto Disconnection Disabled.','Settings','$admin')");
	$response="Auto Disconnection Disabled!!";
}
echo json_encode($response);
?>