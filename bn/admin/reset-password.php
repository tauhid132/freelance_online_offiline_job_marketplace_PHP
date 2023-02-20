<?php
// Initialize the session
//session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: index.php");
  exit;
}

// Include config file
require_once "db/conn.php";

$token = $_GET['token'];

$err  = "";

$sql = "SELECT * FROM tokens WHERE token_id = '$token'";
  if($result = mysqli_query($conn,$sql)){
    if(mysqli_num_rows($result) == 0){
      $true_token = 1;
      $err = '<div class="alert alert-danger alert-dismissible">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      Token Expired!!
      </div>';
    }

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
   if($true_token==1){
      $newPassword = $_POST['new_pass'];
      $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);

      $query = mysqli_query($conn, $sql);
      $result = mysqli_fetch_assoc($query);
      $username = $result['username'];
      mysqli_query($conn, "UPDATE `admin` SET password = '$newPassword' WHERE username = '$username' ");
    }
  
  }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log In | ATS Technology</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1" />

  <!-- v4.0.0-alpha.6 -->
  <link rel="stylesheet" href="dist/bootstrap/css/bootstrap.min.css">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/style.css">
  <link rel="stylesheet" href="dist/css/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="dist/css/et-line-font/et-line-font.css">
  <link rel="stylesheet" href="dist/css/themify-icons/themify-icons.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-box-body">
     <?php echo $err; ?>
     <h3 class="login-box-msg m-b-1">Reset Password</h3>
     <form action="reset-password.php" method="post">

      <div class="form-group has-feedback">
        <input type="password" class="form-control sty1" name="new_pass" placeholder="Enter New Password">
      </div>
       <div class="form-group has-feedback">
        <input type="password" class="form-control sty1"  placeholder="Enter confirm Password">
      </div>
      <input type="hidden" name="token" value="<?php echo $token ?>">
      <div>
        <div class="col-xs-4 m-t-1">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Reset</button>
        </div>
        <!-- /.col --> 
      </div>
    </form>
  </div>
  <!-- /.login-box-body --> 
</div>
<!-- /.login-box --> 

<!-- jQuery 3 --> 
<script src="dist/js/jquery.min.js"></script> 

<!-- v4.0.0-alpha.6 --> 
<script src="dist/bootstrap/js/bootstrap.min.js"></script> 

<!-- template --> 
<script src="dist/js/niche.js"></script>
</body>
</html>