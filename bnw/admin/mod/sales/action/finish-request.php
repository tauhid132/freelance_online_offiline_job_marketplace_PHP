<?php
include('../../../db/conn.php');
$id=$_POST['id'];

date_default_timezone_set('Asia/Dhaka');
$close_date= date('Y-m-d H:i:s');


$query=mysqli_query($conn,"select * from `newconnectionrequest` where id='$id'");
$result=mysqli_fetch_array($query);
$mobile = $result['mobileNo'];
$userId = $result['user_id']; 

mysqli_query($conn,"update `newconnectionrequest` set finishTime='$close_date',status='3' where id='$id'");




$smstext="Dear user, Welcome to ATS Technology Family. Your UserID is $userId. Support: 01700833725,01700833726. FTP: vas.atsbd.net . ATS Technology" ;
include('../../sms/smssender.php');

// $query2=mysqli_query($conn,"select * from `users` where username='$user_id'");
// $result2=mysqli_fetch_array($query2);
// $clientEmail=$result2['email'];



// $clientEmail = $result2['email'];
// $subject ="New Ticket has been created (TKT ID: $id)";
// $body = "Dear $user_id,<br>
//         Your Ticket has been been closed.<br>
       
//         <br>
//         <br>
//         Best Regards,<br>
//         Support Team <br>
//         <b>ATS Technology</b>
//         ";

// include('../../email/emailsender.php');


// mysqli_query($conn,"insert into `log` (action,module,action_by) values ('Ticket No: $id Closed.','Tickets','admin')");

?>