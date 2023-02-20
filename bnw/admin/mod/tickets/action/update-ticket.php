<?php
include('../../../db/conn.php');
session_start();
$admin=$_SESSION['username'];
//$id = mysqli_real_escape_string($conn, $_POST["id"]);
$ticket_type = mysqli_real_escape_string($conn, $_POST["ticket_type"]);	 
$ticket_details = mysqli_real_escape_string($conn, $_POST["ticket_details"]);
$user_id = mysqli_real_escape_string($conn, $_POST["user_id"]);
$username = mysqli_real_escape_string($conn, $_POST["username"]);
//$ass_person = mysqli_real_escape_string($conn, $_POST["ass_person"]);
$review = mysqli_real_escape_string($conn, $_POST["review"]);

$ass_person = $_POST['ass_person'];
foreach($ass_person as $person){
  $new_ass_person = $new_ass_person.' '.$person;
}

if($_POST['id']!=""){
	$id=$_POST['id'];
	mysqli_query($conn,"update `tickets` set ticket_type='$ticket_type',user_id='$user_id',username='$username',ticket_details='$ticket_details',ass_person='$new_ass_person',review='$review' where id='$id'");
	mysqli_query($conn,"insert into `log` (action,module,action_by) values ('Ticket No: $id Updated.','Tickets','$admin')");

}else{
	mysqli_query($conn,"insert into `tickets` (user_id,username,ticket_type,ticket_details,ass_person,created_by) values ('$user_id','$username','$ticket_type','$ticket_details','$new_ass_person','$created_by')");
    $ticketId = mysqli_insert_id($conn);
	mysqli_query($conn,"insert into `log` (action,module,action_by) values ('New Ticket Created.','Tickets','$admin')");
}
$query=mysqli_query($conn,"select * from `users` where username='$user_id'");
$result=mysqli_fetch_array($query);
if (isset($_POST['sendsms'])){

  $mobile=$result['mobile'];
  $smstext="Dear $user_id, We have received your complain. [Tkt ID: $ticketId]. Issue: $ticket_details. Concern Dept. will contact you ASAP. ATS" ;
  include('../../sms/smssender.php');

}

if (isset($_POST['sendemail'])){

  $clientEmail = $result['email'];
  $subject ="New Ticket has been created (TKT ID: $ticketId)";
  $body = "Dear $user_id,<br>
        Your Complain has been received.<br>
        Issue: $ticket_details.<br>
        Concern Dept. will contact you ASAP.
        <br>
        <br>
        Best Regards,<br>
        Support Team <br>
        <b>ATS Technology</b><br>
        Mobile: 01700833725-26
        ";

  include('../../email/emailsender.php');
}





	








?>