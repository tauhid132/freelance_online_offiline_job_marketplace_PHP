<?php
include('../../../db/conn.php');
session_start();
$admin=$_SESSION['username'];


$id=$_POST['id'];
$cus_name=$_POST['cus_name'];
$user_id=$_POST['user_id'];
$address=$_POST['address'];
$mobile=$_POST['mobile'];
$left_on=$_POST['left_on'];
$monthly_bill=$_POST['monthly_bill'];




if($_POST['id']!=""){
	$id=$_POST['id'];
	mysqli_query($conn,"update `left_client` set cus_name='$cus_name',user_id='$user_id',address='$address',mobile='$mobile',left_on='$left_on',monthly_bill='$monthly_bill' where id='$id'");
	mysqli_query($conn,"insert into `log` (action,module,action_by) values ('Left-User [$user_id] updated.','Tickets','$admin')");

}else{
	mysqli_query($conn,"insert into `left_client` (cus_name,user_id,address,mobile,left_on,monthly_bill) values ('$cus_name','$user_id','$address','$mobile','$left_on','$monthly_bill')");
	mysqli_query($conn,"insert into `log` (action,module,action_by) values ('New Left-User Created.','Tickets','$admin')");
}












?>