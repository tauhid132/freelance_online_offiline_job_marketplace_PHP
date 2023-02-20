<?php

include ('database/dbconnect.php');

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
	header("location: index.php");
	exit;
}



$email = $password = "";
$error = ""; 


if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(!empty($_POST['email'])){
		$email = trim($_POST['email']);
	}else{
		$error = "Please enter email address";
	}
	if(!empty($_POST['password'])){
		$password = trim($_POST['password']);
	}else{
		$error = "Please enter password";
	}

	if(empty($error)){ 
		$sql = "SELECT * FROM employer WHERE emailAddress = '$email' ";
		if($result = mysqli_query($conn, $sql)){
			if(mysqli_num_rows($result) == 1){
				$row = mysqli_fetch_array($result);
				if($row['acStatus']==1){
					if(password_verify($password, $row['password'])){
						session_start();
						$_SESSION["loggedin"] = true;
						$_SESSION["fullName"] = $row['fullName'];
						$_SESSION["email"] = $row['emailAddress'];
						$_SESSION["imageLink"] = $row['imageLink'];
						$_SESSION["userType"] = 0;
						header("location: index.php");
					}else{
						$error = '<div class="alert alert-danger alert-dismissible">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						Incorrect Username or Password!!
						</div>';
					}
				}else{
					$error = "Profile Disabled!"; 
				}
			}else{
				$sql2 = "SELECT * FROM employee WHERE emailAddress = '$email' ";
				if($result = mysqli_query($conn, $sql2)){
					if(mysqli_num_rows($result) == 1){
						$row = mysqli_fetch_array($result);
						if($row['acStatus']==1){
							if(password_verify($password, $row['password'])){
								session_start();
								$_SESSION["loggedin"] = true;
								$_SESSION["fullName"] = $row['fullName'];
								$_SESSION["email"] = $row['emailAddress'];
								$_SESSION["imageLink"] = $row['imageLink'];
								$_SESSION["userType"] = 1;
								header("location: index.php");
							}else{
								$error = '<div class="alert alert-danger alert-dismissible">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								Incorrect Username or Password!!
								</div>';
							}
						}else{
							$error = "Profile Disabled!"; 
						}
					}else{
						$error = '<div class="alert alert-danger alert-dismissible">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						Incorrect Username or Password!!
						</div>';
					}
				}
				// $error = "Invalid email or password";
			}
		}else{
			$error = '<div class="alert alert-danger alert-dismissible">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			Incorrect Username or Password!!
			</div>';
		}
	}

}



?>


<!DOCTYPE html>
<html lang="en">


<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, shrink-to-fit=9">
	<meta name="description" content="HireNowBD">
	<meta name="author" content="HireNowBD">
	<title>Login | <?php echo $siteName ?></title>

	<link rel="icon" type="image/png" href="images/fav.png">

	<?php include('includes/stylesheet.php')  ?>
	
</head>
<body>

	


	<?php include('includes/header.php')  ?>

	
	<main class="browse-section">
		<div class="container">
			<div class="row justify-content-md-center">
				<div class="col-md-5">
					<div class="lg_form">
						<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
							<div class="main-heading">
								<div style="text-align: center;">
									<!-- <img style="vertical-align:middle; height: 40px; width: 40px;" src="images/login.png" alt=""> -->
									<span style="vertical-align:middle; font-size: 30px; color: #000000; font-weight: 500;"> LOGIN</span>
								</div>
								
								<div class="line-shape1">
									<img src="images/line.svg" alt="">
								</div>
								<?php echo $error;  ?>
							</div>

							<div class="form-group">
								<label class="label15">Email Address </label>
								<input type="email" class="job-input" name="email" placeholder="Enter Email Address">
							</div>
							<div class="form-group">
								<label class="label15">Password</label>
								<input type="password" class="job-input" name="password" placeholder="Enter Password">
							</div>
							<button class="lr_btn" type="submit" >LOGIN</button>
						</form>
						<div class="done145">
							<div class="done146">
								Don't Have an Account?<a href="sign-up.php">Create Now!</a>
							</div>
							<div class="done147">
								<a href="forgot-password.php">Forgot Password?</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>


	<?php include('includes/footer.php')  ?>


	<button onclick="topFunction()" id="pageup" title="Go to top"><i class="fas fa-arrow-up"></i></button>


	<?php include('includes/js.php')  ?>
</body>










</html>