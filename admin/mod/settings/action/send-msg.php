<?php
	include('../../../db/conn.php');
	session_start();
	$admin=$_SESSION['username'];
	//$id = mysqli_real_escape_string($conn, $_POST["id"]);
    $senderName = mysqli_real_escape_string($conn, $_POST["sender"]);
    $receiverName = mysqli_real_escape_string($conn, $_POST["receiver2"]);
    $messageBody = mysqli_real_escape_string($conn, $_POST["message"]);
    $convBetween = "$senderName-$receiverName";
	
    mysqli_query($conn,"insert into `messages` (senderName,receiverName,messageBody,convBetween) values ('$senderName','$receiverName','$messageBody','$convBetween')");
	
	
	
	

	

	
	
	
	
	
	
	
?>