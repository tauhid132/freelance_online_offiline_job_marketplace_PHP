<?php
	include('../../../db/conn.php');
	 $id = mysqli_real_escape_string($conn, $_POST["id"]);
     $bill = mysqli_real_escape_string($conn, $_POST["bill"]);	 
     $due = mysqli_real_escape_string($conn, $_POST["due"]);
	 $paid = mysqli_real_escape_string($conn, $_POST["paid"]);
	 $upstream = mysqli_real_escape_string($conn, $_POST["upstream"]);
	 
	 $date = mysqli_real_escape_string($conn, $_POST["date"]);
	
	 $total = $bill + $due ; 
	 $account = $total - $paid;
	
	
	
	
	
    mysqli_query($conn,"update `upstream` set account='$account' where upstream='$upstream'");
	
	mysqli_query($conn,"update `upstream_bill` set bill='$bill',due='$due',paid='$paid', date='$date'where id='$id'");
	
	
	
	
	
	
	
?>