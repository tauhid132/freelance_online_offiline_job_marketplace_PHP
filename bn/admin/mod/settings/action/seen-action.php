<?php
	include('../../../db/conn.php');
	session_start();
	//$admin=$_SESSION['username'];
	//$id = mysqli_real_escape_string($conn, $_POST["id"]);
    $senderName = mysqli_real_escape_string($conn, $_POST["receiver"]);
    $receiverName = mysqli_real_escape_string($conn, $_POST["sender"]);
   
	
    mysqli_query($conn,"update `messages` set ifSeen='1' where senderName='$senderName' &&  receiverName='$receiverName'");
	
	
	
	

	

	
	
	
	
	
	
	
?>