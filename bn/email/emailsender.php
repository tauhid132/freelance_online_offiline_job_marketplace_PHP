<?php

$subject = "ss";
$body = "ss";
require 'class/class.phpmailer.php';

  $mail = new PHPMailer;
  //Tell PHPMailer to use SMTP
  $mail->isSMTP();
  //Enable SMTP debugging
  // 0 = off (for production use)
  // 1 = client messages
  // 2 = client and server messages
  $mail->SMTPDebug = 2;
  //Ask for HTML-friendly debug output
  $mail->Debugoutput = 'html';
  //Set the hostname of the mail server
  $mail->Host = 'smtp.gmail.com';
  //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
  $mail->Port = 587;
  $mail->SMTPSecure = 'tls';
  $mail->SMTPAuth = true;
  $mail->Username = "tauhid132@gmail.com";
  $mail->Password = "TauhiD-01751968954";

  //Set who the message is to be sent from
  $mail->setFrom('tauhid132@gmail.com', 'First Last');
  $mail->addReplyTo('tauhid132@gmail.com', 'First Last');
  $mail->addAddress('tauhid132@gmail.com', 'John Doe');
  $mail->WordWrap = 50;                                 
  $mail->isHTML(true);                                  
  $mail->Subject = 'Here is the subject';
  $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
  $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

  if(!$mail->send()) {
      echo 'Message could not be sent.';
      echo 'Mailer Error: ' . $mail->ErrorInfo;
  } else {
      echo 'Message has been sent';
  } 
?>