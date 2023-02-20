<?php
include('../../../../database/dbconnect.php');
$id = $_GET['id'];

$query=mysqli_query($conn,"select * from `service_portfolio` where id='$id'");
$result=mysqli_fetch_array($query);

$status = $result['status'];

if($status){
	mysqli_query($conn, "UPDATE service_portfolio SET status = 0 WHERE id = '$id'");
}else{
	mysqli_query($conn, "UPDATE service_portfolio SET status = 1 WHERE id = '$id'");
}



header('Location: ' . $_SERVER['HTTP_REFERER']);

?>