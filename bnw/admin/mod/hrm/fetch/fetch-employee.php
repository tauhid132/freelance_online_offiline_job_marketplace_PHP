<?php  
include ('../../../db/conn.php');
$attendance_date2 = $_POST['attendance_date'];
$output = ''; 
$output .='<div class="table-responsive justify-center">
<center>
<input type="hidden" name="attendance_date" value="'.$attendance_date2.'" />
<input type="hidden" name="attendance_action" value="add" />
<table class="table table-bordered table-striped">
<thead class="bg-primary text-white">
<tr>
<th scope="col">#</th>
<th scope="col">Employee Name</th>
<th scope="col">Username</th>
<th scope="col">Present</th>
<th scope="col">Absent</th>
<th scope="col">Leave</th>
</tr>
</thead>
<tbody>'; 



$sql="SELECT * FROM employee ";
if ($result = mysqli_query($conn, $sql)) {
 if (mysqli_num_rows($result) > 0) {

   while ($row = mysqli_fetch_assoc($result)) {

     $output .= '<tr>
     <th scope="row">'.$row['id'].'</th>
     <td>'.$row['fullName'].'</td>
     <td>'.$row['username'].'</td>
     <td><input type="hidden" name="username[]" value="'. $row['username'] . '" /><input type="radio" name="attendance_status'. $row['username'] . '" checked value="Present" /></td>
     <td><input type="radio" name="attendance_status'. $row['username'] . '" value="Absent" /></td>
     <td><input type="radio" name="attendance_status'. $row['username'] . '" value="Leave" /></td>
     </tr>';

   }
   mysqli_free_result($result);

 } 

 else {
  
 }
} 



$output .='</tbody>
</table>
</div></center>';

echo $output;  

?>