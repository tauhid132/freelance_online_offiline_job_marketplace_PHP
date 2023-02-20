<?php
include('../../../db/conn.php');


session_start();
$admin=$_SESSION['username'];


$id = mysqli_real_escape_string($conn, $_POST["id"]);

$paid = mysqli_real_escape_string($conn, $_POST["paid"]);
$amount = mysqli_real_escape_string($conn, $_POST["amount"]);
$pay_method = mysqli_real_escape_string($conn, $_POST["pay_method"]);


$date = mysqli_real_escape_string($conn, $_POST["date"]);








mysqli_query($conn,"update `otc_others` set paid='$paid', pay_date='$date', pay_date='$date', amount='$amount', pay_method='$pay_method' where id='$id'");
mysqli_query($conn,"insert into `log` (action,module,action_by) values ('OTC Payment Added [No: $id].','Accounts','$admin')");






?>