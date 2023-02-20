<?php
include ('database/dbconnect.php');
$email = $_POST['email'];
$sql = "SELECT * from employer WHERE emailAddress = '$email'";
$result = mysqli_query($conn, $sql);
$datas = array();

if(mysqli_num_rows($result) > 0){
	echo json_encode(1);
}else{
	echo json_encode(0);
}
?>