<?php

$subject = "Internet Connection Supportd";
$body = "This is body";
require 'class/class.phpmailer.php';
$mail = new PHPMailer;
    $mail->IsSMTP();                //Sets Mailer to send message using SMTP
    $mail->Host = 'https://hostarchives.com';   //Sets the SMTP hosts of your Email hosting, this for Godaddy
    $mail->Port = '465';                //Sets the default SMTP server port
    $mail->SMTPAuth = true;             //Sets SMTP authentication. Utilizes the Username and Password variables
    $mail->Username = 'no-reply@atsbd.net';         //Sets SMTP username
    $mail->Password = 'passfornoreply';          //Sets SMTP password
    $mail->SMTPSecure = 'ssl';              //Sets connection prefix. Options are "", "ssl" or "tls"
    $mail->From = 'no-reply@atsbd.net';         //Sets the From email address for the message
    $mail->FromName = 'ATS Technology';        //Sets the From name of the message
    $mail->AddAddress("tauhid132@gmail.com");   //Adds a "To" address
    //$mail->AddCC($_POST["email"], $_POST["name"]);  //Adds a "Cc" address
    $mail->WordWrap = 50;             //Sets word wrapping on the body of the message to a given number of characters
    //$mail->AddAttachment('pdf_files/test.pdf', 'test.pdf');
    $mail->IsHTML(true);              //Sets message type to HTML       
    $mail->Subject = $subject;       //Sets the Subject of the message
    $mail->Body = $body;        //An HTML or plain text message body
    if($mail->Send())               //Send an Email. Return true on success or false on error
    {
      $err = '<label class="text-success">Thank you for contacting us</label>';
  }else{
      $err = '<label class="text-danger">Failed</label>';
  }

  $mail->isSMTP();
  $mail->SMTPDebug = 2; 
  $mail->SMTPAuth = true;
  
  //update log
    //mysqli_query($conn,"insert into `log` (action,module,action_by) values ('New Ticket Created.','Tickets','admin')");

   // header('location:../alltickets.php');

?>