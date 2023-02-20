<?php
include('../../../db/conn.php');
$id=$_POST['id'];

date_default_timezone_set('Asia/Dhaka');
$close_date= date('Y-m-d H:i:s');


// $query=mysqli_query($conn,"select * from `newconnectionrequest` where id='$id'");
// $result=mysqli_fetch_array($query);
// $assignedExecutive = $result['assignedExecutive'];
// $cusName = $result['fullName'];
// $address = $result['fullAddress'];
// $contact = $result['mobileNo'];

// $query2=mysqli_query($conn,"select * from `employee` where username='$assignedExecutive'");
// $result2=mysqli_fetch_array($query2);
// $mobile = $result2['mobile'];

mysqli_query($conn,"update `tickets` set startProcessingTime='$close_date',status='1' where id='$id'");

// $smstext="New Connction Activation: Cus Name:$cusName, Address:$address, Contact:$contact " ;
// include('../../sms/smssender.php');

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


 mysqli_query($conn,"insert into `log` (action,module,action_by) values ('$mobile.','Tickets','admin')");

?>