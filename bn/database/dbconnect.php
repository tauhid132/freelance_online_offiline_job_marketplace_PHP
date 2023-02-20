<?php
$conn = mysqli_connect("localhost","root","","project_dbms");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$resultForSettings = mysqli_query($conn, "select * from `setting`");
$resultForSettings=mysqli_fetch_assoc($resultForSettings);
$url = $resultForSettings['link'];
$siteName = $resultForSettings['siteName'];
?>