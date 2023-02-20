<?php  
include ('../../../db/conn.php');
$attendance_date2 = $_POST['attendance_date'];
$output = ''; 
$query = '
SELECT attendance_date FROM attendance 
WHERE attendance_date = "'.$attendance_date2.'"
';
$statement = $connect->prepare($query);
$statement->execute();
if($statement->rowCount() <= 0)
{
  $output .='<center>No Data Found!</center>';
}else{
  $output .='<div class="table-responsive justify-center">
  <center>
  <input type="hidden" name="attendance_date" value="'.$attendance_date2.'" />
  <input type="hidden" name="attendance_action" value="update" />
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
      $username = $row['username'];
      $query=mysqli_query($conn,"select * from `attendance` where username='$username' && attendance_date='$attendance_date2'");
      $result2=mysqli_fetch_array($query);
      $status = $result2['attendance_status'];


      $output .= '<tr>
      <th scope="row">'.$row['id'].'</th>
      <td>'.$row['fullName'].'</td>
      <td>'.$row['username'].'</td><input type="hidden" name="username[]" value="'. $row['username'] . '" />';
      if($status == 'Present'){
        $output .= ' <td><input type="radio" name="attendance_status'. $row['username'] . '" checked value="Present" /></td>
        <td><input type="radio" name="attendance_status'. $row['username'] . '" value="Absent" /></td>
        <td><input type="radio" name="attendance_status'. $row['username'] . '" value="Leave" /></td>';
      }else if($status == 'Absent'){
        $output .= ' <td><input type="radio" name="attendance_status'. $row['username'] . '"  value="Present" /></td>
        <td><input type="radio" name="attendance_status'. $row['username'] . '" checked value="Absent" /></td>
        <td><input type="radio" name="attendance_status'. $row['username'] . '" value="Leave" /></td>';
      }else if($status == 'Leave'){
        $output .= ' <td><input type="radio" name="attendance_status'. $row['username'] . '" value="Present" /></td>
        <td><input type="radio" name="attendance_status'. $row['username'] . '" value="Absent" /></td>
        <td><input type="radio" name="attendance_status'. $row['username'] . '" checked value="Leave" /></td>';
      }


      $output .='</tr>';


    }
    $output .='</tbody>
    </table>
    </div></center>';
    mysqli_free_result($result);

  } 


} 

}





echo $output;  

?>