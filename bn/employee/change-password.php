<?php
include ('../database/dbconnect.php');
session_start();

$email = $_SESSION['email'];
$query=mysqli_query($conn,"SELECT * FROM employee WHERE employee.emailAddress = '$email';");
$result=mysqli_fetch_array($query);

?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from gambolthemes.net/html-items/jobby/jobby-medical/hospital_dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 16 Mar 2022 15:41:32 GMT -->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, shrink-to-fit=9">
	<meta name="description" content="Gambolthemes">
	<meta name="author" content="Gambolthemes">
	<title>My Personal Info </title>

	<link rel="icon" type="image/png" href="images/fav.png">

	<?php include('../includes/stylesheet.php')  ?>
</head>
<body>

	<?php include('../includes/header-employee.php')  ?>

	

	<main class="browse-section">
		<div class="container">
			<div class="row">
				<?php include('includes/sidebar.php')  ?>
				<div class="col-lg-8 col-md-12 mainpage">
					<div class="account_heading">
						<div class="account_hd_left">
							<h1><i class="fas fa-user"></i> My Personal Information</h1>
						</div>
						
					</div>
					<?php include('includes/topbar.php')  ?>
					<div class="jobs_manage">
						<div class="row">
							<div class="col-lg-12">
								<div class="view_chart">
									
									<div class="post_job_body">
										<form method="post" action="action/change-password-action.php">
											<input type="hidden" name="email" value="<?php echo $result['emailAddress']?>">
											<div class="row">
												<div class="col-lg-6">
													<div class="form-group">
														<label class="label15">New Password</label>
														<input type="password" id="pass1" class="form-control" name="password" >
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<label class="label15">New Password</label>
														<input type="password"  id="confirm_password" class="form-control" name="password2" >
													</div>
												</div>
												
												<div class="col-lg-12">
													<button class="btn btn-primary mt-5" type="submit">Change Password</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>


	<?php include('../includes/footer.php')  ?>


	<button onclick="topFunction()" id="pageup" title="Go to top"><i class="fas fa-arrow-up"></i></button>


	<?php include('../includes/js.php')  ?>
	


	<script type="text/javascript">
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



	<div class="modal fade" id="modal-add-ticket">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">

				<div class="modal-body">


					<div class="card">
						<div class="card-header">
							<h5>File Upload</h5>
						</div>
						<div class="card-block">
							<form id="uploadForm" action="action/upload-image.php" method="post">
								<div class="fallback">
									<input name="userImage" type="file" />
								</div>
								<input type="hidden" name="email" value="<?php echo $result['emailAddress'];?>">
								<div class="text-center m-t-20">
									<button type="submit" value="Submit" class="btn btn-primary">Upload Now</button>
								</div>
							</div>
						</div>


					</form>
				</div>
				<!-- /.row -->
			</div>

			<!-- /.card -->
		</div>
		<!-- /.col -->
	</div>

	<!-- Mirrored from gambolthemes.net/html-items/jobby/jobby-medical/hospital_dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 16 Mar 2022 15:41:37 GMT -->
	</html>