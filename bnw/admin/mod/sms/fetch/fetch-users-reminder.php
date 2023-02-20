<?php  
include ('../../../db/conn.php');
$month=date('F-Y');
$output = '';  




 if ($_POST['area']=='all_area') {
  $area=$_POST['area'];
  $sql="SELECT * FROM billing WHERE billing_month = '$month' && paid_bill=0 && paid_due=0";
  if ($result = mysqli_query($conn, $sql)) {
   if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {
      $userID=$row['user_id'];
      $query=mysqli_query($conn,"select * from `users` where username='$userID'");
      $result2=mysqli_fetch_array($query);
      $mobile=$result2['mobile'];
      $ifSend = $result2['sendSms'];
      if($ifSend=='1' && $mobile!=''){
       $output .= '<div class="form-check form-check-inline">
       <input class="" type="checkbox" name="selectedUsers"  checked value="' . $row['user_id'] . '" >
       <label class="" for="inlineRadio1">' . $row['user_id'] . '</label>
       </div>';
     }

   }
   mysqli_free_result($result);

 } 

 else {
   echo "No Number";
 }
} 


}else if ($_POST['area']!='all_area') {
  $area=$_POST['area'];
  $sql="SELECT * FROM billing WHERE billing_month = '$month' && paid_bill=0 && paid_due=0";
  if ($result = mysqli_query($conn, $sql)) {
   if (mysqli_num_rows($result) > 0) {

     while ($row = mysqli_fetch_assoc($result)) {
      $userID=$row['user_id'];
      $query=mysqli_query($conn,"select * from `users` where username='$userID'");
      $result2=mysqli_fetch_array($query);
      $mobile=$result2['mobile'];
      $areaU=$result2['area'];
      $ifSend = $result2['sendSms'];
      if($areaU==$area && $mobile!='' && $ifSend=='1'){
       $output .= '<div class="form-check form-check-inline">
       <input class="" type="checkbox" name="selectedUsers"  checked value="' . $row['user_id'] . '" >
       <label class="" for="inlineRadio1">' . $row['user_id'] . '</label>
       </div>';
     }

   }
   mysqli_free_result($result);

 } 

 else {
   echo "No Number";
 }
}else{
  echo "Enter Valid Info";
}


}

// $sms_type = $_POST['sms_type'];
// $output .= '<br>
// <div class="form-group">
// <input type="text" class="form-control" id="sms_type"  value="'.$sms_type.'"></input>
// </div><br>
// ';
//echo json_encode($smstext);
//return($smstext);

echo $output;  

?>