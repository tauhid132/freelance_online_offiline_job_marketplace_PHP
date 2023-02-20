<?php
include('../../../db/conn.php');
$month=date('F-Y');


mysqli_query($conn,"insert into billing (user_id, cus_name, monthly_bill, pre_due, billing_month)
	select username, cus_name, monthly_bill, due , '$month'
	from users where status !='Inactive' ");

mysqli_query($conn,"update `users` set due=(monthly_bill + due) where status!='Inactive'");


mysqli_query($conn,"insert into `onlinepayment` (month) values ('$month')");
$response = "Successfully Generated!!";
echo json_encode($response);
?>
