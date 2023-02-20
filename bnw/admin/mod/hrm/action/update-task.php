<?php
include('../../../db/conn.php');
session_start();
$admin=$_SESSION['username'];

$description = mysqli_real_escape_string($conn, $_POST["description"]);
$assigned_person = mysqli_real_escape_string($conn, $_POST["assigned_person"]);
$created_by = mysqli_real_escape_string($conn, $_POST["created_by"]);

if($_POST['id']!=""){
	$id=$_POST['id'];
	mysqli_query($conn,"update `tasks` set description='$description',assigned_person='$assigned_person',created_by='$created_by' where id='$id'");
	mysqli_query($conn,"insert into `log` (action,module,action_by) values ('TaskID: $id is updated.','Tasks','$admin')");
}else{
	mysqli_query($conn,"insert into `tasks` (description,assigned_person,created_by) values ('$description','$assigned_person','$created_by')");
	mysqli_query($conn,"insert into `log` (action,module,action_by) values ('New Task Created.','Tasks','$admin')");
}

$query=mysqli_query($conn,"select * from `employee` where username='$assigned_person'");
$result=mysqli_fetch_array($query);

if (isset($_POST['sendsms'])){
	$mobile=$result['mobile'];
	$smstext="Dear $assigned_person, Your Task: $description.";
	include('../../sms/smssender.php');

}


?>