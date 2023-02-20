<?php
$url = "https://isms.mimsms.com/smsapi";
$data = [
    "api_key" => "C200145763023f2451a9e0.97702620",
    "type" => "text",
    "contacts" => "01751968954",
    "senderid" => "8809601003450",
    "msg" => "smstext",
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);
curl_close($ch);
echo $response;
?>