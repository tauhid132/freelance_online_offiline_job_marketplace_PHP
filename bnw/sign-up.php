<?php

include ('database/dbconnect.php');

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: index.php");
  exit;
}

if(isset($_POST['submit'])){
	$email = $_POST['email'];
	$password = $_POST['password'];
	$fullName = $_POST['fullName'];
	if($_POST['type'] == 1){
		mysqli_query($conn, "INSERT INTO employer (emailAddress,password, fullName) VALUES ('$email','$password','$fullName')");
		header("location: login.php");
	}else if($_POST['type']==0){
		mysqli_query($conn, "INSERT INTO employee (emailAddress,password, fullName) VALUES ('$email','$password','$fullName')");
		header("location: login.php");
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
	<title>Create New Account | <?php echo $siteName ?></title>

	<link rel="icon" type="image/png" href="images/fav.png">

	<?php include('includes/stylesheet.php')  ?>
	
</head>
<body>

	


	<?php include('includes/header.php')  ?>

	
	<main class="browse-section">
		<div class="container">
			<div class="row justify-content-md-center">
				<div class="col-md-6">
					<div class="lg_form">
						<div class="main-heading">
							<h2>SIGN IN</h2>
							<div class="line-shape1">
								<img src="images/line.svg" alt="">
							</div>
						</div>
						<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
						<div class="form-group">
							<label class="label15">Full Name</label>
							<input type="text" class="job-input" name="fullName" placeholder="Enter Full Name" required>
						</div>
						<div class="form-group">
							<label class="label15">Email Address</label>
							<input type="email" class="job-input" id="email_address" name="email" placeholder="Enter Email Address">
							<div class="error-message" id="email_address_error">  Please choose another email.</div>
						</div>
						<div class="form-group">
							<label class="label15">Password</label>
							<input type="password" class="job-input" id="pass1" name="password" placeholder="Enter Password">
						</div>
						<div class="form-group">
							<label class="label15">Confirm Password</label>
							<input type="password" class="job-input" id="confirm_password" placeholder="Enter Confirm Password">
							<div class="error-message" id="password_error"> Password do not match!.</div>
						</div>
						<div class="form-group">
							<div class="row">
							<div class="col-lg-6">
								<input type="checkbox" class="radio" value="1" name="type" >
								<label style="color:#242424 !important;">I Want to hire</label>
							</div>
							<div class="col-lg-6">
								<input type="checkbox" class="radio" value="0" name="type" >
								<label style="color:#242424 !important;">I Want to Work</label>
							</div>
						</div>
							

						</div>
						<button class="lr_btn" type="submit" name="submit" onclick="window.location.href = 'sign-up.php';">Sign in Now</button>
						<div class="done145">
							<div class="done146">
								Already Have an Account?<a href="login.php">Login Now<i class="fas fa-angle-double-right"></i></a>
							</div>
						
						</div>
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


<script>

$(document).ready(function(){
	$('#email_address_error').hide();
	$('#password_error').hide();
	$("#email_address").keyup(function(){
		$.ajax({
		type: "POST",
		url: "email-check.php",
		data: {email:$(this).val()},
		//data:'keyword='+$(this).val(),
		beforeSend: function(){
			//$("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			if(data == 0){
				$('#email_address_error').hide()
				$('#email_address').css('border','3px solid #33cc33');
			}else{
				$('#email_address').css('border','3px solid #ff3300');
				$('#email_address_error').show()
			}
		}
		});
	});
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
});

$("input:checkbox").on('click', function() {
  // in the handler, 'this' refers to the box clicked on
  var $box = $(this);
  if ($box.is(":checked")) {
    // the name of the box is retrieved using the .attr() method
    // as it is assumed and expected to be immutable
    var group = "input:checkbox[name='" + $box.attr("name") + "']";
    // the checked state of the group/box on the other hand will change
    // and the current value is retrieved using .prop() method
    $(group).prop("checked", false);
    $box.prop("checked", true);
  } else {
    $box.prop("checked", false);
  }
});



function selectCountry(val) {
$("#job_search-box").val(val);
$("#suggesstion-box").hide();
}
</script>







</html>