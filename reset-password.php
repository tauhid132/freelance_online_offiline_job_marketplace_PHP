<?php

include ('database/dbconnect.php');

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
	header("location: index.php");
	exit;
}
$err  = "";
$true_token = 0;

if(isset($_GET['token'])){
	$token = $_GET['token'];
	$sql = "SELECT * FROM tokens WHERE tokenNo = '$token' and status = 1";
	if($result = mysqli_query($conn,$sql)){
		if(mysqli_num_rows($result) == 1){
			$true_token = 1;
		}else{
			$err = '<div class="alert alert-danger alert-dismissible">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			Token Expired!!
			</div>';
		}
	}
}





// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(true){
		$newPassword = $_POST['password'];
		$newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
		$token = $_POST['token'];
		$query=mysqli_query($conn,"SELECT * FROM tokens WHERE tokenNo = '$token'");
		$result2=mysqli_fetch_array($query);
		$email = $result2['email'];
		$search_in_employee = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM employee WHERE emailAddress = '$email'"));
		if($search_in_employee[0]==1){
			mysqli_query($conn, "UPDATE `employee` SET password = '$newPassword' WHERE emailAddress = '$email' ");
		}else{
			$search_in_employer = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM employer WHERE emailAddress = '$email'"));
			if($search_in_employer[0]==1){
				mysqli_query($conn, "UPDATE `employer` SET password = '$newPassword' WHERE emailAddress = '$email' ");
			}
		}
		mysqli_query($conn, "UPDATE `tokens` SET status = 0 WHERE tokenNo = '$token' ");
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
	<title>Recover Password | <?php echo $siteName ?></title>

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
									
									<span style="vertical-align:middle; font-size: 30px; color: #000000; font-weight: 500;"> Recover Password</span>
								</div>
								
								<div class="line-shape1">
									<img src="images/line.svg" alt="">
								</div>
								<?php echo $err;  ?> 
							</div>
							<?php
							if($true_token){
								echo '
								<input type="hidden" name="token" value="'.$token.'">
								<div class="form-group">
								<label class="label15">Password</label>
								<input type="password" class="job-input" id="pass1" name="password" placeholder="Enter Password">
								</div>
								<div class="form-group">
								<label class="label15">Confirm Password</label>
								<input type="password" class="job-input" id="confirm_password" placeholder="Enter Confirm Password">
								<div class="error-message" id="password_error"> Password do not match!.</div>
								</div>

								<button class="lr_btn" type="submit" >Recover</button>';
							}
							?>
							
						</form>
						
					</div>
				</div>
			</div>
		</div>
	</main>


	<?php include('includes/footer.php')  ?>


	<button onclick="topFunction()" id="pageup" title="Go to top"><i class="fas fa-arrow-up"></i></button>


	<?php include('includes/js.php')  ?>
</body>

<script type="text/javascript">
	$('#password_error').hide();
	$("#confirm_password").keyup(function(){
		var pass1 = $('#pass1').val();
		var pass2 = $(this).val();
		if(pass1 != pass2){
			$('#confirm_password').css('border','3px solid #ff3300');
			$('#password_error').show();
		}else{
			$('#confirm_password').css('border','3px solid #33cc33');
			$('#password_error').hide();
		}
		
	});
</script>








</html>