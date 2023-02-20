<?php
include ('../../database/dbconnect.php');
$method = $_POST['method'];
$amount = $_POST['amount'];
$email = $_POST['email'];

mysqli_query($conn, "INSERT INTO transfer_balance (email, transferAmount, transferMethod) VALUES ('$email', '$amount', '$method') ");


header('Location: ' . $_SERVER['HTTP_REFERER']);
?>