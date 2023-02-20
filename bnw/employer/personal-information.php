<?php
include ('../database/dbconnect.php');
session_start();

$email = $_SESSION['email'];
$query=mysqli_query($conn,"SELECT * FROM employer WHERE emailAddress = '$email';");
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

	<?php include('../includes/header-employer.php')  ?>

	

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
										<form method="post" action="action/update-info-action.php">
											<input type="hidden" name="email" value="<?php echo $result['emailAddress']?>">
											<div class="row">
												<div class="col-lg-6">
													<div class="form-group">
														<label class="label15">Full Name</label>
														<input type="text" class="form-control" name="fullName" value="<?php echo $result['fullName']?>">
													</div>
												</div>
												
												<div class="col-lg-6">
													<div class="form-group">
														<label class="label15">Birthday</label>
														<div class="smm_input">
															<input class="form-control" id="date1" name="dob" type="date" value="<?php echo $result['dob']; ?>">
														</div>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<label class="label15">Gender</label>
														<div class="ui fluid search selection dropdown skills-search">
															<input name="gender" type="hidden" value="<?php echo $result['gender']?>">
															<i class="dropdown icon"></i>
															<input class="search" autocomplete="off" tabindex="0">
															<span class="sizer" style=""></span>
															<div class="default text">Select Gender</div>
															<div class="menu transition hidden" tabindex="-1">
																<div class="item" data-value="Male">Male</div>
																<div class="item" data-value="Female">Female</div>
																<div class="item" data-value="Other">Other</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-lg-4">
													<div class="form-group">
														<label class="label15">Street/Road</label>
														<input type="text" class="job-input" name="streetNo" value="<?php echo $result['streetNo']?>">
													</div>
												</div>
												<div class="col-lg-4">
													<div class="form-group">
														<label class="label15">Thana / Police Station</label>
														<input type="text" class="job-input" name="policeStation" value="<?php echo $result['policeStation']?>">
													</div>
												</div>
												<div class="col-lg-4">
													<div class="form-group">
														<label class="label15">District / City</label>
														<input type="text" class="job-input" name="district" value="<?php echo $result['district']?>">
													</div>
												</div>
												<div class="col-lg-4">
													<div class="form-group">
														<label class="label15">Country</label>
														<input type="text" class="job-input" name="country" value="<?php echo $result['country']?>">
													</div>
												</div>
												<div class="col-lg-8">
													<div class="form-group">
														<label class="label15">Mobile No</label>
														<div class="smm_input">
															<input type="text" class="job-input" name="mobileNo" value="<?php echo $result['mobileNo']?>">
															<!-- <button class="btn-primary btn">Verify</button> -->
															<!-- <div class="loc_icon"><i class="fas fa-search">Verify</i></div> -->
														</div>
													</div>
												</div>
												<!-- <div class="col-lg-12">
													<div class="form-group">
														<label class="label15">Type Message*</label>
														<textarea class="note-input" placeholder="Write a text..."></textarea>
													</div>
												</div> -->
												<div class="col-lg-12">
													<button class="btn btn-primary mt-5" type="submit"><i class="fas fa-save"></i> Update Profile</button>
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
		$(document).ready(function (e) {
			$("#uploadForm").on('submit',(function(e) {
				e.preventDefault();
				$.ajax({
					url: "action/upload-image.php",
					type: "POST",
					data:  new FormData(this),
					contentType: false,
					cache: false,
					processData:false,
					success: function(data)
					{
      //$("#targetLayer").html(data);
      //alert('Image uploaded successfully!');
      $('#modal-add-ticket').modal('hide');
      $(location.reload());  
  },
  error: function() 
  {
  }           
});
			}));
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