<?php
session_start();
$admin=$_SESSION['username'];
include('../../../db/conn.php');
$id = mysqli_real_escape_string($conn, $_POST["id"]);
$pre_advance = mysqli_real_escape_string($conn, $_POST["pre_advance"]);	 
$meal = mysqli_real_escape_string($conn, $_POST["meal"]);
$commission = mysqli_real_escape_string($conn, $_POST["commission"]);
$paid = mysqli_real_escape_string($conn, $_POST["paid"]);
$date = mysqli_real_escape_string($conn, $_POST["date"]);
$fullName = mysqli_real_escape_string($conn, $_POST["emp_name"]);
$salary = mysqli_real_escape_string($conn, $_POST["salary"]);
$total = $salary + $commission - $meal - (-$pre_advance); 
$account = $total - $paid;





mysqli_query($conn,"update `employee` set account='$account' where fullName='$fullName'");

mysqli_query($conn,"update `salary` set pre_advance='$pre_advance',meal='$meal',commission='$commission',paid='$paid',date='$date',salary='$salary' where id='$id'");

mysqli_query($conn,"insert into `log` (action,module,action_by) values ('EMP:$fullName salary sheet updated.','Accounts','$admin')");




?>