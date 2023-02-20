<?php
	include('../../../db/conn.php');
	$id=$_POST['id'];
	
	date_default_timezone_set('Asia/Dhaka');
	$close_date= date('Y-m-d H:i:s');
	
	
	
	
	mysqli_query($conn,"update `tasks` set status='Closed',finish_time='$close_date' where id='$id'");
	
	
	//update log
	mysqli_query($conn,"insert into `log` (action,module,action_by) values ('Ticket No: $id Finished.','Taks','admin')");
	//header('location:../tasks.php');
?>