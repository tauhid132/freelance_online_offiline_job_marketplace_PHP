<?php
include('../../../db/conn.php');
$id=$_POST['id'];
$new_pass=$_POST['new_pass'];
$new_pass = password_hash($new_pass, PASSWORD_DEFAULT);
mysqli_query($conn,"update `users` set password='$new_pass' where id='$id'");

?>