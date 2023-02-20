<?php
include('../../../db/conn.php');
session_start();
$admin=$_SESSION['username'];
$id=$_POST['id'];
$query2=mysqli_query($conn,"select * from `admin` where id='$id'");
$result2=mysqli_fetch_array($query2);

if($result2['status']==0){
	mysqli_query($conn,"update `admin` set status='1' where id='$id'");
	//mysqli_query($conn,"insert into `log` (action,module,action_by) values ('API Enabled.','Settings','$admin')");
	$response="User Enabled!!";

}else if($result2['status']==1){
	mysqli_query($conn,"update `admin` set status='0' where id='$id'");
	//mysqli_query($conn,"insert into `log` (action,module,action_by) values ('API Disabled.','Settings','$admin')");
	$response="User Disabled!!";
}
echo json_encode($response);
?>