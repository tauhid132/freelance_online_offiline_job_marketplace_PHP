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
					

					<div class="card jobs_manage" style="margin-top:30px">
						<div class="card-body">
							<div class="card-header"><h2>Payments</h2></div>
							<h1>Hello World</h1>
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