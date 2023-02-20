<?php
	include('../../../db/conn.php');
	$month=date('F-Y');
	
	
	
	
	mysqli_query($conn,"insert into salary (emp_name, emp_id, salary, pre_advance, month)
select fullName, username, salary, account , '$month'
from employee ");
	$response = "Salary Successfully Generated!!";
echo json_encode($response);

?>
