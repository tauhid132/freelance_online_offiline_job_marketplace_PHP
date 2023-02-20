<?php
$url = "https://esms.mimsms.com/smsapi";
  $data = [
    "api_key" => "C2006488600af9e92648e2.93379022",
    "type" => "text",
    "contacts" => "$mobile",
    "senderid" => "8809612446205",
    "msg" => "$smstext",
  ];

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $response = curl_exec($ch);
?>