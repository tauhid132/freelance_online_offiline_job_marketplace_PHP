<?php  
include ('../../../db/conn.php');

$output = '';  


if($_POST['packType']=='all' && $_POST['area']=='all_area'){
  $sql="SELECT * FROM users WHERE mobile!='' ";
  if ($result = mysqli_query($conn, $sql)) {
   if (mysqli_num_rows($result) > 0) {

     while ($row = mysqli_fetch_assoc($result)) {

       $output .= '<div class="form-check form-check-inline">
       <input class="" type="checkbox" name="selectedUsers"  checked value="' . $row['username'] . '" >
       <label class="" for="inlineRadio1">' . $row['username'] . '</label>
       </div>';

     }
     mysqli_free_result($result);

   } 

   else {
     echo "No Number";
   }
 } 

}else if($_POST['packType']=='all' && $_POST['area']!='all_area'){
  $area=$_POST['area'];
  $sql="SELECT * FROM users WHERE mobile!='' && area='$area' ";
  if ($result = mysqli_query($conn, $sql)) {
   if (mysqli_num_rows($result) > 0) {

     while ($row = mysqli_fetch_assoc($result)) {

       $output .= '<div class="form-check form-check-inline">
       <input class="" type="checkbox" name="selectedUsers"  checked value="' . $row['username'] . '" >
       <label class="" for="inlineRadio1">' . $row['username'] . '</label>
       </div>';

     }
     mysqli_free_result($result);

   } 

   else {
     echo "No Number";
   }
 } 

}else if ($_POST['packType']!='all' && $_POST['area']=='all_area') {
  $area=$_POST['area'];
  $pack_name=$_POST['packType'];
  $sql="SELECT * FROM users WHERE  pack_name = '$pack_name' && mobile!='' ";
  if ($result = mysqli_query($conn, $sql)) {
   if (mysqli_num_rows($result) > 0) {

     while ($row = mysqli_fetch_assoc($result)) {

       $output .= '<div class="form-check form-check-inline">
       <input class="" type="checkbox" name="selectedUsers"  checked value="' . $row['username'] . '" >
       <label class="" for="inlineRadio1">' . $row['username'] . '</label>
       </div>';

     }
     mysqli_free_result($result);

   } 

   else {
     echo "No Number";
   }
 } 


}else if ($_POST['packType']!='all' && $_POST['area']!='all_area') {
  $area=$_POST['area'];
  $pack_name=$_POST['packType'];
  $sql="SELECT * FROM users WHERE area='$area' && pack_name = '$pack_name' && mobile!='' ";
  if ($result = mysqli_query($conn, $sql)) {
   if (mysqli_num_rows($result) > 0) {

     while ($row = mysqli_fetch_assoc($result)) {

       $output .= '<div class="form-check form-check-inline">
       <input class="" type="checkbox" name="selectedUsers"  checked value="' . $row['username'] . '" >
       <label class="" for="inlineRadio1">' . $row['username'] . '</label>
       </div>';

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

if($_POST['sms_type']=='custom'){
  $smstext = $_POST['sms_cus'];
}else{
  $smstext = $_POST['sms_type'];
}


$output .= '<br>
<div class="form-group">
<input type="hidden" class="form-control" id="sms_text"  value="'.$smstext.'"></input>
</div><br>
';
//echo json_encode($smstext);
//return($smstext);

echo $output;  

?>