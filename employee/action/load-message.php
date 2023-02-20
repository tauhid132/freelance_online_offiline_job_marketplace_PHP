<?php
include ('../../database/dbconnect.php');
session_start();
$receiver = $_POST['receiver'];
$email = $_SESSION['email'];
$output = ''; 
$output .= '<input type="hidden" name="sender" id="sender" value="'.$email.'" class="form-control">
            <input type="hidden" name="receiver" id="receiver" value="'.$receiver.'" class="form-control">';
$sql7 = "SELECT * FROM messages WHERE (senderEmail='$email' && receiverEmail='$receiver') || (senderEmail='$receiver' && receiverEmail='$email') order by timestamp asc";
if($result7 = mysqli_query($conn, $sql7)){
	if(mysqli_num_rows($result7) > 0){
		while($row = mysqli_fetch_array($result7)){
			if($row['senderEmail'] != $email){
				$output .= '<div class="msg left-msg">


				<div class="msg-bubble">
				<div class="msg-info">
				
				
				</div>

				<div class="msg-text">

				'.$row['text'].'
				</div>
				<div class="msg-info-time">'.$row['timestamp'].'</div>
				</div>
				</div>';
			}else{
				$output .= '
				<div class="msg right-msg">
				<div


				<div class="msg-bubble">
				<div class="msg-info">
				
				
				</div>

				<div class="msg-text">
				'.$row['text'].'
				</div>
				<div class="msg-info-time">'.$row['timestamp'].'</div>
				</div>
				</div>';
			}

		}
	}
} 
echo $output;
?>