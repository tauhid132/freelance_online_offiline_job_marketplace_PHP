<?php
//require_once('../db/conn.php');

$emailSettingQuery = mysqli_query($conn, "SELECT * FROM `email_setting`");
$emailSettingResult = mysqli_fetch_assoc($emailSettingQuery);

require "PHPMailer/PHPMailerAutoload.php";


$to   = 'tauhid132@gmail.com';
$from = 'atstechnologybd@gmail.com';
$name = $emailSettingResult['from_name'];
//$subject = 'test56';
//$body = 'ggg.'; 
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true; 

$mail->SMTPSecure = 'ssl'; 
$mail->Host = $emailSettingResult['smtp_server'];
$mail->Port = $emailSettingResult['port'];  
$mail->Username = $emailSettingResult['username'];
$mail->Password = $emailSettingResult['password'];  

   //   $path = 'reseller.pdf';
   //   $mail->AddAttachment($path);

$mail->IsHTML(true);
$mail->From=$emailSettingResult['from_email'];
$mail->FromName=$name;
        //$mail->Sender=$from;
        //$mail->AddReplyTo($from, $name);
$mail->Subject = $subject;
$mail->Body = $body;
$mail->AddAddress($to);
if(!$mail->Send())
{
    $error ="Please try Later, Error Occured while Processing...";
    return $error; 
}
else 
{
    $error = "Thanks You !! Your email is sent.";  
    return $error;
}




?>
