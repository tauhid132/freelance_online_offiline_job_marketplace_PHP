<?php
$todayDate = date("Y-m-d");
echo $todayDate;
include('../../../db/conn.php');
$sql = "SELECT * FROM users WHERE username='MK0004' && expireDate='$todayDate'";
if($result = mysqli_query($conn, $sql)){
	if(mysqli_num_rows($result) > 0){
		while ($row = mysqli_fetch_array($result)) {
			$userId = $row['username'];
			$expireDate = $row['expireDate'];
			if($row['due']>0){
				mysqli_query($conn,"update `users` set status='Expired' where username='$userId'");
			}
		}
	}
}
?>