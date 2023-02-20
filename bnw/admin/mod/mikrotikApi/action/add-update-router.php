<?php
include('../../../db/conn.php');
session_start();
$admin=$_SESSION['username'];

$serverName = mysqli_real_escape_string($conn, $_POST["serverName"]);
$ipAddress = mysqli_real_escape_string($conn, $_POST["ipAddress"]);
$username = mysqli_real_escape_string($conn, $_POST["username"]);
$password = mysqli_real_escape_string($conn, $_POST["password"]);

if($_POST['id']!=""){
	$id=$_POST['id'];
	mysqli_query($conn,"update `mikrotiklist` set serverName='$serverName',ipAddress='$ipAddress',username='$username',password='$password' where id='$id'");
	mysqli_query($conn,"insert into `log` (action,module,action_by) values ('Router: $serverName is updated.','API','$admin')");
}else{
	mysqli_query($conn,"insert into `mikrotiklist` (serverName,ipAddress,username,password) values ('$serverName','$ipAddress','$username','$password')");
	mysqli_query($conn,"insert into `log` (action,module,action_by) values ('New Router Added.','API','$admin')");
}




?>