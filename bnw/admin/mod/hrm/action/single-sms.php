<?php
include('../../../db/conn.php');

$smsbody = $_POST['smsbody'];
$smstext = $smsbody;
$mobile = $_POST['mobile'];


include('../../sms/smssender.php');

header('Location: ' . $_SERVER['HTTP_REFERER']);

?>