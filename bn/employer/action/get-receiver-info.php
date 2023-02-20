<?php
include ('../../database/dbconnect.php');
session_start();
$receiver = $_POST['receiver'];

$output = ''; 
$query=mysqli_query($conn,"SELECT * FROM employee  WHERE emailAddress = '$receiver';");
$result=mysqli_fetch_array($query);
$output = '
<div class="msger-header-title">
<img height="40px" width="40px" style="border-radius:100px; margin-right:10px" src="../'.$result['imageLink'].'">  '.$result['fullName'].'
</div>
';

echo $output;
?>