<?php
require "PHPMailer/PHPMailerAutoload.php";


//$to   = 'tauhid132@gmail.com';
$from = 'atstechnologybd@gmail.com';
$name = 'Work4All';
//$subject = 'Email Varification';
//$body = 'To Verify your account <a href="#">Click Here</a>.'; 
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true; 

$mail->SMTPSecure = 'tls'; 
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;  
$mail->Username = 'softrixbd@gmail.com';
$mail->Password = 'TauhiD-0175';   

   //   $path = 'reseller.pdf';
   //   $mail->AddAttachment($path);

$mail->IsHTML(true);
$mail->From="softrixbd@gmail.com";
$mail->FromName=$name;
        //$mail->Sender=$from;
        //$mail->AddReplyTo($from, $name);
$mail->Subject = $subject;
$mail->Body = $body;
$mail->AddAddress($to);
if(!$mail->Send())
{
    $error ="Please try Later, Error Occured while Processing...";
    //echo $error; 
}
else 
{
    $error = "Thanks You !! Your email is sent.";  
    //echo $error;
}




?>
