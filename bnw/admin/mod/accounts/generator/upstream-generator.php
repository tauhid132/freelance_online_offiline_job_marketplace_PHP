<?php
	include('../../../db/conn.php');
	$month=date('F-Y');
	
	
	
	
	mysqli_query($conn,"insert into upstream_bill (upstream, month, bill, due)
select upstream, '$month', bill, account 
from upstream ");
$response = "Upstream Bill Successfully Generated!!";
echo json_encode($response);
	

?>
