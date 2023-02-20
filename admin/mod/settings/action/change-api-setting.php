<?php
include('../../../db/conn.php');
session_start();
$admin=$_SESSION['username'];
$query2=mysqli_query($conn,"select * from `setting` where id='1'");
$result2=mysqli_fetch_array($query2);

if($result2['enableApi']==0){
	mysqli_query($conn,"update `setting` set enableApi='1' where id='1'");
	mysqli_query($conn,"insert into `log` (action,module,action_by) values ('API Enabled.','Settings','$admin')");
	$response="API Enabled!!";

}else if($result2['enableApi']==1){
	mysqli_query($conn,"update `setting` set enableApi='0' where id='1'");
	mysqli_query($conn,"insert into `log` (action,module,action_by) values ('API Disabled.','Settings','$admin')");
	$response="API Disabled!!";
}
echo json_encode($response);
?>