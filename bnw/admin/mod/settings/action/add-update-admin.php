 <?php  
 include('../../../db/conn.php');
 session_start();
 $admin=$_SESSION['username'];

 $full_name = mysqli_real_escape_string($conn, $_POST["full_name"]);  
 $username = mysqli_real_escape_string($conn, $_POST["username"]);  
 $email = mysqli_real_escape_string($conn, $_POST["email"]);  
 $password = mysqli_real_escape_string($conn, $_POST["password"]);
 $password = password_hash($password, PASSWORD_DEFAULT);
 $role = mysqli_real_escape_string($conn, $_POST["role"]);  
 $id = mysqli_real_escape_string($conn, $_POST["id"]);  



 if($_POST['id']!=""){
  $id=$_POST['id'];
  mysqli_query($conn,"update `admin` set full_name='$full_name',username='$username',password='$password',role='$role',email='$email' where id='$id'");
  mysqli_query($conn,"insert into `log` (action,module,action_by) values ('Admin Updated. Username: $username.','Settings','$admin')");
}else{
  mysqli_query($conn,"insert into `admin` (full_name,username,password,role,email) values ('$full_name','$username','$password','$role','$email')");
  mysqli_query($conn,"insert into `log` (action,module,action_by) values ('New admin Created. Username: $username.','Settings','$admin')");
}





?>