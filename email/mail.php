<?php
require "PHPMailer/PHPMailerAutoload.php";


//$to   = 'tauhid132@gmail.com';
$from = 'atstechnologybd@gmail.com';
$name = 'support@atsbd.net';
//$subject = 'test56';
//$body = 'ggg.'; 
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true; 

$mail->SMTPSecure = 'ssl'; 
$mail->Host = 'hostarchives.com';
$mail->Port = 465;  
$mail->Username = 'support@atsbd.net';
$mail->Password = 'atssupport@2022#';   

   //   $path = 'reseller.pdf';
   //   $mail->AddAttachment($path);

$mail->IsHTML(true);
$mail->From="support@atsbd.net";
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
