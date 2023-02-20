<?php
include('../../../db/conn.php');
session_start();
$admin=$_SESSION['username'];
 $status = mysqli_real_escape_string($conn, $_POST["status"]);
	 $equip_type = mysqli_real_escape_string($conn, $_POST["equip_type"]);
	 $vendor = mysqli_real_escape_string($conn, $_POST["vendor"]);
	 $sl_no = mysqli_real_escape_string($conn, $_POST["sl_no"]);
	 $mac = mysqli_real_escape_string($conn, $_POST["mac"]);
	 $used_in = mysqli_real_escape_string($conn, $_POST["used_in"]);

if($_POST['id']!=""){
	$id=$_POST['id'];
	mysqli_query($conn,"update `equipments` set status='$status', equip_type='$equip_type',vendor='$vendor', sl_no='$sl_no', mac='$mac', used_in='$used_in' where id='$id'");
	mysqli_query($conn,"insert into `log` (action,module,action_by) values ('ONU No: $id Updated.','Inventory','$admin')");

}else{
	mysqli_query($conn,"insert into `equipments` (equip_type,sl_no,mac,vendor,status,used_in) values ('$equip_type','$sl_no','$mac','$vendor','$status','$used_in')");
	mysqli_query($conn,"insert into `log` (action,module,action_by) values ('New ONU Added.','Inventory','$admin')");
}


?>