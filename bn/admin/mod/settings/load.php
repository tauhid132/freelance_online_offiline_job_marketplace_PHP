<?php
session_start();
$username = $_SESSION['username'];
include('../../db/conn.php');
$sender = $_POST['sender'];
$receiver = $_POST['receiver'];
$output = ''; 
$output .= '<input type="hidden" name="sender" id="sender" value="'.$sender.'" class="form-control">
            <input type="hidden" name="receiver" id="receiver" value="'.$receiver.'" class="form-control">';

$i=1;
$sql25 = "SELECT * FROM messages WHERE (senderName='$sender' && receiverName='$receiver') || (senderName='$receiver' && receiverName='$sender') order by timestamp asc";
if($result25 = mysqli_query($conn, $sql25)){
  if(mysqli_num_rows($result25) > 0){
    while($row = mysqli_fetch_array($result25)){
      $id = $row['id'];
      if($row['senderName']==$username){
       $output .= '<div class="direct-chat-msg left mt-3">
       <div class="direct-chat-info clearfix"> <span class="direct-chat-name pull-right">'.$row['senderName'].'</span> <span class="direct-chat-timestamp pull-left">'.$row['timestamp'].'</span> </div>
       <img class="direct-chat-img float-right" src="'. $url.'/dist/img/img3.jpg" alt="user image">  

       <div class="direct-chat-text float-right mr-1"> '.$row['messageBody'].' </div>
       </div>';
     }else{
       $output .= '<div class="direct-chat-msg mt-3 ">
       <div class="direct-chat-info clearfix"> <span class="direct-chat-name pull-left">'.$row['senderName'].'</span> <span class="direct-chat-timestamp pull-right">'.$row['timestamp'].'</span> </div>
       <img class="direct-chat-img" src="'. $url.'/dist/img/img3.jpg" alt="user image"> 
       <div class="direct-chat-text test"> '.$row['messageBody'].' </div>
       </div>';
     }

     
     $i++;
   }
 }else{
  $output .= '<h1>No Conversation Found!!</h1>';
 }
}

echo $output;  

?>