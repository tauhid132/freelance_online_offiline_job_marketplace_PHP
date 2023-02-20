<?php
$conn = mysqli_connect("localhost","root","","project_dbms");
$connect = new PDO("mysql:host=localhost;dbname=project_dbms","root","");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$resultForSettings = mysqli_query($conn, "select * from `setting`");
$resultForSettings=mysqli_fetch_assoc($resultForSettings);
$url = $resultForSettings['link'];
$siteName = $resultForSettings['siteName'];
$enableAPI = $resultForSettings['enableApi'];
$enableAutoDisconnect = $resultForSettings['enableAutoUser'];


//Store Logged In User Info
$loggedUsername = "tauhid";
$adminInfoQuery = mysqli_query($conn, "SELECT * FROM `admin` WHERE username = '$loggedUsername'");
$adminInfoResult = mysqli_fetch_assoc($adminInfoQuery);



?>