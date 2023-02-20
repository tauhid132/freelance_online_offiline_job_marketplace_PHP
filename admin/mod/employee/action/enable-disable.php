<?php
include('../../../../database/dbconnect.php');
$id = $_GET['id'];

$query=mysqli_query($conn,"select * from `employee` where id='$id'");
$result=mysqli_fetch_array($query);

$status = $result['acStatus'];

if($status){
	mysqli_query($conn, "UPDATE employee SET acStatus = 0 WHERE id = '$id'");
}else{
	mysqli_query($conn, "UPDATE employee SET acStatus = 1 WHERE id = '$id'");
}



header('Location: ' . $_SERVER['HTTP_REFERER']);

?>