<?php
// Initialize the session
session_start();
include('../../db/conn.php');

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
	header("location: login.php");
	exit;
}
$username = $_GET['username'];
$query=mysqli_query($conn,"select * from `admin` where username='$username'");
$result=mysqli_fetch_array($query);

?>
<!DOCTYPE html>
<html lang="en">


<head>
	<title>View Profile | ATS Technology</title>




	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="Admindek Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
	<meta name="keywords" content="flat ui, admin Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
	<meta name="author" content="colorlib" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<?php include('../../includes/stylesheet.php'); ?>
</head>
<body>

	<style>
		#over img {
			margin-left: auto;
			margin-right: auto;
			display: block;
		}
	</style>

	<div class="loader-bg">
		<div class="loader-bar"></div>
	</div>

	<div id="pcoded" class="pcoded">
		<div class="pcoded-overlay-box"></div>
		<div class="pcoded-container navbar-wrapper">

			<?php include('../../includes/navbar.php'); ?>

			
		</div>

		<div class="pcoded-main-container">
			

			<?php include ("../../includes/sidebar.php"); ?>
			

			<div class="pcoded-content">

				<div class="page-header card">
					<div class="row align-items-end">
						<div class="col-lg-8">
							<div class="page-header-title">
								<i class="feather icon-inbox bg-c-blue"></i>
								<div class="d-inline">
									<h5>User Profile</h5>
									
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="page-header-breadcrumb">
								
							</div>
						</div>
					</div>
				</div>

				<div class="pcoded-inner-content">

					<div class="main-body">
						<div class="page-wrapper">
							<div class="page-body">
								<div class="row">
									<div class="col-lg-4 col-xl-3">
										<div id="navigation">
											<div class="row">
												<div class="col-lg-12">
													<div class="card version ">
														<div id="over">
															<img class="img-100" src="<?php echo $url;?>/<?php echo $result['image'];?>" alt="Image">
														</div>
														<div class="card-block">
															<div class="support-btn">
																<a href="#!" class="btn waves-effect waves-light btn-primary btn-block btn-sm" data-toggle="modal" data-target="#modal-add-ticket"><i class="icofont icofont-life-buoy"></i> Change Picture</a>
															</div>
															<ul class="nav navigation">
																<li class="navigation-header"><i class="icon-history pull-right"></i> </li>
																<li class="waves-effect waves-light">
																	<a href="#v_1_2">Full Name<span class="text-muted text-regular pull-right"><?php echo $result['full_name'];?></span></a>
																</li>
																<li class="waves-effect waves-light">
																	<a href="#v_1_0"><b>Email</b><span class="text-muted text-regular pull-right"><?php echo $result['email'];?></span></a>
																</li>
																<li class="waves-effect waves-light">
																	<a href="#v_1_0">Role<span class="text-muted text-regular pull-right"><?php echo $result['role'];?></span></a>
																</li>
																<li class="navigation-divider"></li>
																<li class="navigation-header"><i class="icon-gear pull-right"></i> 
																</ul>
																<?php
																if($_SESSION['role']=='admin'){
																	echo '
																	<div class="card-footer text-center">
																	<button class="btn btn-primary btn-sm ">Edit Profile</button>
																	</div>';
																}
																?>
															</div>
															
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-8 col-xl-9">
											<div class="col-sm-12">
												<div class="card" id="v_1_2">
													<div class="card-header">
														<h5>Notice Board</h5>
														
														
													</div>
													<div class="card-block">


													</div>
												</div>
											</div>


										</div>
									</div>
								</div>
							</div>


						</div>
					</div>


				</div>
			</div>

		</div>



	</div>
</div>
</div>
</div>


<div class="modal fade" id="modal-add-ticket">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<div class="modal-body">


				<div class="card">
					<div class="card-header">
						<h5>File Upload</h5>
					</div>
					<div class="card-block">
						<form id="uploadForm" action="upload.php" method="post">
							<div class="fallback">
								<input name="userImage" type="file" multiple />
							</div>
							<input type="hidden" name="username" value="<?php echo $result['username'];?>">
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
<!-- /.row -->
</section>
<!-- /.content -->
</div>
</div>
<script type="text/javascript">
	$(document).ready(function (e) {
		$("#uploadForm").on('submit',(function(e) {
			e.preventDefault();
			$.ajax({
				url: "upload.php",
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

<?php include('../../includes/js.php'); ?>
</body>

<!-- Mirrored from colorlib.com/polygon/admindek/default/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 12 Dec 2019 16:08:25 GMT -->
</html>
