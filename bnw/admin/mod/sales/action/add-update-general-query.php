<?php
include('../../../db/conn.php');
session_start();
$admin=$_SESSION['username'];

$id = mysqli_real_escape_string($conn, $_POST["id"]);
$fullName = mysqli_real_escape_string($conn, $_POST["fullName"]);
$address = mysqli_real_escape_string($conn, $_POST["address"]);
$mobileNo = mysqli_real_escape_string($conn, $_POST["mobileNo"]);
$comment = mysqli_real_escape_string($conn, $_POST["comment"]);
$executive = mysqli_real_escape_string($conn, $_POST["executive"]);
$reference = mysqli_real_escape_string($conn, $_POST["reference"]);
$status = mysqli_real_escape_string($conn, $_POST["status"]);


if($_POST['id']!=""){
	$id=$_POST['id'];
	mysqli_query($conn,"update `generalquery` set fullName='$fullName',address='$address',mobileNo='$mobileNo',comment='$comment',executive='$executive',reference='$reference',status='$status' where id='$id'");
	//mysqli_query($conn,"insert into `log` (action,module,action_by) values ('Connection Request No: $id is updated.','Sales','$admin')");

}else{
	mysqli_query($conn,"insert into `generalquery` (fullName,address,mobileNo,comment,executive,reference,status) values ('$fullName','$address','$mobileNo','$comment','$executive','$reference','$status')");
    $ticketId = mysqli_insert_id($conn);
	//mysqli_query($conn,"insert into `log` (action,module,action_by) values ('New Connection Request Created.','Sales','$admin')");
}
// $query=mysqli_query($conn,"select * from `users` where username='$user_id'");
// $result=mysqli_fetch_array($query);
// if (isset($_POST['sendsms'])){

//   $mobile=$result['mobile'];
//   $smstext="Dear $user_id, We have received your complain. [Tkt ID: $ticketId]. Issue: $ticket_details. Concern Dept. will contact you ASAP. ATS" ;
//   include('../../sms/smssender.php');

// }

// if (isset($_POST['sendemail'])){

//   $clientEmail = $result['email'];
//   $subject ="New Ticket has been created (TKT ID: $ticketId)";
//   $body = "Dear $user_id,<br>
//         Your Complain has been received.<br>
//         Issue: $ticket_details.<br>
//         Concern Dept. will contact you ASAP.
//         <br>
//         <br>
//         Best Regards,<br>
//         Support Team <br>
//         <b>ATS Technology</b>
//         ";

//   include('../../email/emailsender.php');
// }





	








?>