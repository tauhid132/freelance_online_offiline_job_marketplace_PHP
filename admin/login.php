<?php
// Initialize the session
//session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: index.php");
  exit;
}

// Include config file
require_once "../database/dbconnect.php";

// Define variables and initialize with empty values
$username = $password = "";
$err  = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
  if(empty(trim($_POST["username"]))){
    $err = '<div class="alert alert-danger alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    Please Enter Your Username!
    </div>';
  } else{
    $username = trim($_POST["username"]);
  }

    // Check if password is empty
  if(empty(trim($_POST["password"]))){
    $err = '<div class="alert alert-danger alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    Please Enter Your Password!
    </div>';
  } else{
    $password = trim($_POST["password"]);
  }

    // Validate credentials
  if(empty($err)){
        // Prepare a select statement
    $sql = "SELECT id, username, password, role, image, full_name, email, status FROM admin WHERE username = ?";

    if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
      $param_username = $username;

            // Attempt to execute the prepared statement
      if(mysqli_stmt_execute($stmt)){
                // Store result
        mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
        if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
          mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $role, $image, $full_name, $email, $status);
          if(mysqli_stmt_fetch($stmt)){
            if(password_verify($password, $hashed_password)){
              if($status == 1){
                session_start();

                            // Store data in session variables
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $id;
                $_SESSION["username"] = $username; 
                $_SESSION["role"] = $role;  
                $_SESSION["image"] = $image; 
                $_SESSION["full_name"] = $full_name; 
                $_SESSION["email"] = $email; 


                            // Redirect user to welcome page
                header("location: dashboard.php");
              //update log
                function getRealUserIp(){
                  switch(true){
                    case (!empty($_SERVER['HTTP_X_REAL_IP'])) : return $_SERVER['HTTP_X_REAL_IP'];
                    case (!empty($_SERVER['HTTP_CLIENT_IP'])) : return $_SERVER['HTTP_CLIENT_IP'];
                    case (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) : return $_SERVER['HTTP_X_FORWARDED_FOR'];
                    default : return $_SERVER['REMOTE_ADDR'];
                  }
                }




                $ip = getRealUserIp();
                mysqli_query($conn,"insert into `log` (action,module,action_by) values ('User $username logged-in from $ip.','System Info','')");

              }else{
                $err = '<div class="alert alert-danger alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              Login Failed!
              </div>';
              }
                            
              
            } else{
                            // Display an error message if password is not valid
              $err = '<div class="alert alert-danger alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              Login Failed!
              </div>';
            }
          }
        } else{
                    // Display an error message if username doesn't exist
          $err = '<div class="alert alert-danger alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          Login Failed!!
          </div>';
        }
      } else{
        echo "Oops! Something went wrong. Please try again later.";
      }

            // Close statement
      mysqli_stmt_close($stmt);
    }
  }

    // Close connection
  mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log In | Softrix</title>
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
     <div class="mb-3">
      <img style="display:block; margin-left: auto; margin-right: auto; height: 100px" src="../images/lg/logo_final.png">
    </div>

    <h3 class="login-box-msg">Log In</h3>
    <form class="md-float-material form-material" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
      <div class="form-group has-feedback">
        <input type="text" class="form-control sty1" name="username" placeholder="Username">
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control sty1" name="password" placeholder="Password">
      </div>
      <div>
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox">
            Remember Me </label>
            <a href="recover-password.php" class="pull-right"><i class="fa fa-lock"></i> Forgot Password?</a> </div>
          </div>
          <!-- /.col -->
          <div class="col-xs-4 m-t-1">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
          </div>
          <!-- /.col --> 
        </div>
      </form>
    <!-- <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
      Facebook</a> <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
      Google+</a> </div> -->
      <!-- /.social-auth-links -->

      <div class="m-t-2"><center>Copyright &copy; 2022 | <a href="#" class="text-center">Work For All</center></a></div>
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