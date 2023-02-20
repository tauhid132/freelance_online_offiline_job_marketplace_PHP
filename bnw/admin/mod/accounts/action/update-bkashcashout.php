<?php
include('../../../db/conn.php');
session_start();
$admin=$_SESSION['username'];

$month = date("F-Y");

$bkashCashedOut = mysqli_real_escape_string($conn, $_POST["bkashCashedOut"]);
mysqli_query($conn,"update `onlinepayment` set bkashCashedOut='$bkashCashedOut' where month='$month'");
mysqli_query($conn,"insert into `log` (action,module,action_by) values ('Bkash Cashout Balance Updated.','Acounts','$admin')");	    



?>