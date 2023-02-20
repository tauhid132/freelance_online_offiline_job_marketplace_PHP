<?php
include('../../../db/conn.php');
session_start();
$admin=$_SESSION['username'];

$month = date("F-Y");

$bankCashedOut = mysqli_real_escape_string($conn, $_POST["bankCashedOut"]);
mysqli_query($conn,"update `onlinepayment` set bankCashedOut='$bankCashedOut' where month='$month'");
mysqli_query($conn,"insert into `log` (action,module,action_by) values ('Bank Cashout Balance Updated.','Acounts','$admin')");	    



?>