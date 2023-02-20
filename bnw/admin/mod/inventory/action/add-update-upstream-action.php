<?php
include('../../../db/conn.php');
session_start();
$admin=$_SESSION['username'];
 $upstream=$_POST['upstream'];
	$usages=$_POST['usages'];
	$bill=$_POST['bill'];
	$account=$_POST['account'];

if($_POST['id']!=""){
	$id=$_POST['id'];
	mysqli_query($conn,"update `upstream` set upstream='$upstream',usages='$usages',bill='$bill',account='$account' where id='$id'");
	mysqli_query($conn,"insert into `log` (action,module,action_by) values ('Upstream No: $id Updated.','Upstream','$admin')");

}else{
	mysqli_query($conn,"insert into `upstream` (upstream,usages,bill,account) values ('$upstream','$usages','$bill','$account')");
	mysqli_query($conn,"insert into `log` (action,module,action_by) values ('New Upstream Added.','Upstream','$admin')");
}


?>
