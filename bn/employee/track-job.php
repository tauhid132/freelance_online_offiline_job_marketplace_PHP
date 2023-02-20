<?php
include ('../database/dbconnect.php');
session_start();

$email = $_SESSION['email'];
$query=mysqli_query($conn,"SELECT * FROM employee  WHERE emailAddress = '$email';");
$result=mysqli_fetch_array($query);

$job_id = $_GET['job-id'];
$query2=mysqli_query($conn,"SELECT * FROM hire_employee join employer on hire_employee.employerEmail = employer.emailAddress join service_portfolio on hire_employee.servicePortfolioId = service_portfolio.id where hire_employee.id = '$job_id'");
$result2=mysqli_fetch_array($query2);



?>
<!DOCTYPE html>
<html lang="en">


<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, shrink-to-fit=9">
	<meta name="description" content="Gambolthemes">
	<meta name="author" content="Gambolthemes">
	<title>Track Job</title>

	<link rel="icon" type="image/png" href="images/fav.png">

	<?php include('../includes/stylesheet.php')  ?>
</head>
<body>


	
	<?php include('../includes/header-employee.php')  ?>

	<main class="browse-section">
		<div class="container">
			<div class="row">
				<?php include('includes/sidebar.php')  ?>
				<div class="col-lg-8 col-md-8 mainpage">
					<div class="account_heading">
						<div class="account_hd_left">
							<h1>Job Tracker</h1>
						</div>

					</div>
					<?php include('includes/topbar.php')  ?>
					
					
					<div class="dsh150">
						<div class="row" style="margin-top:30px">
							<div class="col-lg-8">
								<div class="card">
									<div class="card-body">
										
										<div class="form-body">
											<div class="form-group row">
												<label class="control-label text-right col-md-3">Employer Name</label>
												<div class="col-md-9">
													<input placeholder="First Name" class="form-control" type="text" value="<?php echo $result2['fullName'] ?>" readonly>
												</div>
											</div>
											<div class="form-group row">
												<label class="control-label text-right col-md-3">Service Name</label>
												<div class="col-md-9">
													<input placeholder="Last Name" class="form-control" value="<?php echo $result2['service_name'] ?>" type="text" readonly>
												</div>
											</div>
											<div class="form-group row">
												<label class="control-label text-right col-md-3">Service Type</label>
												<div class="col-md-9">
													<input placeholder="Last Name" class="form-control" value="<?php echo $result2['service_working_type'] ?>" type="text" readonly>
												</div>
											</div>

											<div class="form-group row">
												<label class="control-label text-right col-md-3">Salary</label>
												<div class="col-md-9">
													<input class="form-control" value="<?php echo $result2['service_salary'] ?> / <?php echo $result2['service_salary_method'] ?>" type="text" readonly>
												</div>
											</div> 
											<div class="form-group row">
												<label class="control-label text-right col-md-3">Total Payment</label>
												<div class="col-md-9">
													<input class="form-control" value="0" type="text" readonly>
												</div>
											</div> 
										</div>


									</div>
								</div>
							</div>
							<div class=" card col-lg-4 mt-20">

								<div class="timeline p-4 block mb-4 mt-20">

									<div class="tl-item active">
										<div class="tl-dot b-primary"></div>
										<div class="tl-content">
											<div class="">Got Hired</div>
											<div class="tl-date text-muted mt-1"><?php echo $result2['hireTime'] ?></div>
										</div>
									</div>
									<?php 
									if($result2['jobStartTime'] == NULL){
										echo '<div class="tl-item ">
										<div class="tl-dot b-danger"></div>
										<div class="tl-content">
										<div class="">Started Working</div>
										<div class="tl-date text-muted mt-1">Not Started</div>
										</div>
										</div>';
									}else{
										echo '<div class="tl-item active">
										<div class="tl-dot b-primary"></div>
										<div class="tl-content">
										<div class="">Started Working</div>
										<div class="tl-date text-muted mt-1">'. $result2['jobStartTime'].'.</div>
										</div>
										</div>';
									}
									?>

									<?php 
									if($result2['jobFinishTime'] == NULL){
										echo '<div class="tl-item ">
										<div class="tl-dot b-danger"></div>
										<div class="tl-content">
										<div class="">Finished Working</div>
										<div class="tl-date text-muted mt-1">Not Finished</div>
										</div>
										</div>';
									}else{
										echo '<div class="tl-item active">
										<div class="tl-dot b-primary"></div>
										<div class="tl-content">
										<div class="">Finished Working</div>
										<div class="tl-date text-muted mt-1">'. $result2['jobFinishTime'].'</div>
										</div>
										</div>';
									}
									?>


									<div class="tl-item">
										<div class="tl-dot b-danger"></div>
										<div class="tl-content">
											<div class="">Got Payment</div>
											<div class="tl-date text-muted mt-1">1 Week ago</div>
										</div>
									</div>

								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="card">
								<div class="card-body">
									<center>
										<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-send-sms"><i class="fa f fa-share-square-o"></i> Start Working</button>
										<button class="btn btn-info btn-sm" data-toggle="modal" data-target="#finish_job"><i class="fa f fa-share-square-o"></i> Finish Working</button>
										<!-- <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-send-sms"><i class="fa f fa-times"></i> Abort Job</button> -->
									</center>
								</div>
							</div>
						</div>

						<div class="col-lg-12">
							<div class="card">
								<div class="card-body">
									<div class="applied_candidates_item">
										<div class="row">
											<div class="col-xl-7">
												<div class="applied_candidates_dt">
													<div class="candi_img">
														<img src="<?php echo $url ?>/<?php echo $result2['imageLink'] ?>" alt="">
													</div>
													<div class="candi_dt">
														<a href="#"><?php echo $result2['fullName'] ?></a>
														<!-- <div class="candi_cate">Car Painter</div> -->
														<div class="rating_candi">Rating
															<div class="star">
																<?php
																for($i=0; $i<$result2['jobRating']; $i++){
																	echo '<i class="fas fa-star"></i>';
																}  
																?>
																
																<span><?php echo $result2['jobRating'] ?></span>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="btn_link24 review_user">
											<p>"<?php echo $result2['jobComment'] ?>"</p>
										</div>
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
	<button onclick="topFunction()" id="pageup2" title="Go to top"><i class="fas fa-arrow-up"></i></button>



	<?php include('../includes/js.php')  ?>


	<script type="text/javascript">
		$(document).ready(function(){
			$('#start_job').on("submit", function(event){  
				event.preventDefault();  

				$.ajax({  
					url:"action/start-job-action.php",  
					method:"POST",  
					data:$('#start_job').serialize(),  
					beforeSend:function(){  
						$('#insert').val("Updating");  
					},  
					success:function(data){  
						//$('#start_job')[0].reset();  
						$('#modal-send-sms').hide(); 
						$(location.reload());

					}  
				});  

			});
		});
	</script>


	</html>
	<div class="modal fade" id="modal-send-sms">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Start Job</h4>

				</div>
				<div class="modal-body">
					<form method="post" id="start_job">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<input type="hidden" name="job-id" value="<?php echo $job_id ?>"> 
									<div class="form-group">
										<label for="label16">Starting Timestamp</label>
										<input type="datetime-local" class="form-control" name="timestamp">
									</div>
								</div>

							</div>
							<!-- /.row -->
						</div>
					</div>
					<div class="modal-footer justify-content-between">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<input type="submit" name="insert" id="insert" value="Save" class="btn btn-success" /> 
					</div>
				</div>
			</form>
			<!-- /.modal-content -->
		</div>
	</div>
</div>
<div class="modal fade" id="finish_job">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Finish Job</h4>

			</div>
			<div class="modal-body">
				<form method="post" action="action/finish-job-action.php">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<input type="hidden" name="job-id" value="<?php echo $job_id ?>"> 
								<div class="form-group">
									<label for="label16">Finish Timestamp</label>
									<input type="datetime-local" class="form-control" name="timestamp">
								</div>
							</div>

						</div>
						<!-- /.row -->
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<input type="submit" name="insert" id="insert" value="Save" class="btn btn-success" /> 
				</div>
			</div>
		</form>
		<!-- /.modal-content -->
	</div>
