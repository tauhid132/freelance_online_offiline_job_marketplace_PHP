<?php
include('../../../../database/dbconnect.php');
$id = $_GET['id'];

$query=mysqli_query($conn,"select * from `job_posts` where id='$id'");
$result=mysqli_fetch_array($query);

$status = $result['status'];

if($status){
	mysqli_query($conn, "UPDATE job_posts SET status = 0 WHERE id = '$id'");
}else{
	mysqli_query($conn, "UPDATE job_posts SET status = 1 WHERE id = '$id'");
}



header('Location: ' . $_SERVER['HTTP_REFERER']);

?>