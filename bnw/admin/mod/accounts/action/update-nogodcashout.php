<?php
include('../../../db/conn.php');
session_start();
$admin=$_SESSION['username'];

$month = date("F-Y");

$nogodCashedOut = mysqli_real_escape_string($conn, $_POST["nogodCashedOut"]);
mysqli_query($conn,"update `onlinepayment` set nogodCashedOut='$nogodCashedOut' where month='$month'");
mysqli_query($conn,"insert into `log` (action,module,action_by) values ('Nogod Cashout Balance Updated.','Acounts','$admin')");	    



?>