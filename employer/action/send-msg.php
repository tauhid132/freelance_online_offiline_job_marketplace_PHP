<?php
include ('../../database/dbconnect.php');
session_start();
$email=$_SESSION['email'];
	//$id = mysqli_real_escape_string($conn, $_POST["id"]);
$senderName = mysqli_real_escape_string($conn, $_POST["sender"]);
$receiverName = mysqli_real_escape_string($conn, $_POST["receiver2"]);
$messageBody = mysqli_real_escape_string($conn, $_POST["message"]);
$convBetween = "$senderName-$receiverName";

mysqli_query($conn,"insert into `messages` (senderEmail,receiverEmail,text) values ('$senderName','$receiverName','$messageBody')");














?>