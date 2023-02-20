<?php
session_start();
$admin=$_SESSION['username'];

include('../../../db/conn.php');
include('../includes/routeros_api.class.php');			
include('../includes/connapi.php');
$expiredUsers = array();
if($enableAutoDisconnect==1){
	$sql = "SELECT * FROM users WHERE status='Expired' && apiEnabled='1'";
	if($result = mysqli_query($conn, $sql)){
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_array($result)){
				$expiredUsers[] = $row['username'];
			}

		}
	}
}

foreach ($expiredUsers as $username ) {
	$userid = $username;
	include('disable-user-action.php');
}
$response = "Successfully Disabled!!";
echo json_encode($response);
?>