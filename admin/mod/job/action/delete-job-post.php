<?php
include('../../../../database/dbconnect.php');
$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM job_posts  WHERE id = '$id'");
//mysqli_query($conn, "DELETE FROM aplly  WHERE id = '$id'");

header('Location: ' . $_SERVER['HTTP_REFERER']);

?>