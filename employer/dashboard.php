<?php
include ('../database/dbconnect.php');
session_start();

$email = $_SESSION['email'];
$query=mysqli_query($conn,"SELECT * FROM employer WHERE emailAddress = '$email'");
$result=mysqli_fetch_array($query);



$job_post = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM job_posts WHERE email = '$email'"));
$job_offers = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM job_offers WHERE offeredBy = '$email'"));
$total_hired = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM hire_employee WHERE employerEmail = '$email'"));
$total_com = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM hire_employee WHERE employerEmail = '$email' and jobStatus = 2"));


?>
<!DOCTYPE html>
<html lang="en">


<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, shrink-to-fit=9">
	<meta name="description" content="Gambolthemes">
	<meta name="author" content="Gambolthemes">
	<title>My Dashboard</title>

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
							<h1><i class="fa fa-tachometer"></i> My Dashboard</h1>
						</div>
						
					</div>
					<?php include('includes/topbar.php')  ?>
					<div class="total_1254">
						<div class="row">
							<div class="col-lg-3 col-12">
								<div class="collection_item">
									<div class="coll_icon">
										<i class="fas fa-suitcase col_icon1"></i>
									</div>
									<h4>Total Job Posts</h4>
									<span><?php echo $job_post[0] ?></span>
								</div>
							</div>
							<div class="col-lg-3 col-12">
								<div class="collection_item">
									<div class="coll_icon">
										<i class="fas fa-bullseye col_icon2"></i>
									</div>
									<h4>Total Offered Jobs</h4>
									<span><?php echo $job_offers[0] ?></span>
								</div>
							</div>
							<div class="col-lg-3 col-12">
								<div class="collection_item">
									<div class="coll_icon">
										<i class="fa fa-handshake-o" style="color: yello;"></i>
									</div>
									<h4>Total Hired Workers</h4>
									<span><?php echo $total_hired[0] ?></span>
								</div>
							</div>
							<div class="col-lg-3 col-12">
								<div class="collection_item">
									<div class="coll_icon">
										<i class="fa fa-check-circle" style="color: green;"></i>
									</div>
									<h4>Completed Jobs</h4>
									<span><?php echo $total_com[0] ?></span>
								</div>
							</div>
						</div>
					</div>
					<div class="view_chart">
						<div class="view_chart_header">
							<h4 class="mt-2">Recent Jobs Progress</h4>
						</div>
						<div class="card" style="margin-top:20px">
							<div class="card-body">
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead class="bg-info text-white font-weight-bold">
											<tr>
												<th>#No</th>
												<th>#Job No</th>
												<!-- <th>#Image</th> -->
												<th>#Worker</th>
												<th>#Service</th>
												<th>#Status</th>
												
												<th>#Action</th>
												

											</tr>
										</thead>
										<tbody>
											<?php


											$email = $_SESSION['email'];
											$sql = "SELECT * , hire_employee.id as hid FROM (hire_employee JOIN service_portfolio ON hire_employee.servicePortfolioId = service_portfolio.id) JOIN employee ON hire_employee.employeeEmail = employee.emailAddress WHERE hire_employee.employerEmail = '$email' and jobStatus = 1 order by hireTime desc limit 3 ";
											if($result = mysqli_query($conn, $sql)){
												if(mysqli_num_rows($result) > 0){
													$i = 1;
													while($row = mysqli_fetch_array($result)){

														echo "<tr>";
														echo "<td>" . $i . "</td>";
														echo "<td>JOB-" . $row['hid'] . "</td>";
														echo '<td><img class="datatable_image" src="../'.$row['imageLink'].'" alt="">'. $row['fullName'] .'</td>';
														// echo "<td>" . $row['fullName'] . "</td>";
														echo "<td>" . $row['service_name'] . "</td>";
														if($row['jobStatus']== 0)
															echo '<td><span class="label label-info">Hired</span></td>'; 
														else if($row['jobStatus']==1)
															echo '<td><span class="label label-warning">On Progress</span></td>';
														else if($row['jobStatus']==2)
															echo '<td><span class="label label-success">Completed</span></td>';

														
														
														echo '<td><a href="track-job.php?job-id='.$row['hid'].'">
														<button class="btn btn-sm btn-primary"> Track Job</button>
														</a>
														</td>';

														$i++;
														
														echo "</tr>";

													}

													mysqli_free_result($result);
												} 
											} 


											?>

										</tbody>
										<tfoot>

										</tfoot>
									</table>
								</div>
							</div>
						</div>
						
					</div>




					
					<div class="dsh150">
						<div class="row">
							<div class="col-lg-12">
								<div class="view_chart">
									<div class="view_chart_header">
										<h4 class="mt-2">Recent Jobs Posts</h4>
									</div>
									<div class="card" style="margin-top:20px">
										<div class="card-body">
											<div class="table-responsive">
												<table id="example2" class="table table-bordered table-striped">
													<thead class="bg-info text-white font-weight-bold">
														<tr>
															<th>No</th>
															<th>Job Title</th>
															<th>Application</th>
															<th>Status</th>
															<th>Salary</th>
															<th>Action</th>


														</tr>
													</thead>
													<tbody>
														<?php


														$email = $_SESSION['email'];
														$sql = "SELECT * FROM job_posts WHERE email = '$email'";
														if($result = mysqli_query($conn, $sql)){
															if(mysqli_num_rows($result) > 0){
																$i = 1;
																while($row = mysqli_fetch_array($result)){

																	echo "<tr>";
																	echo "<td>" . $i . "</td>";
																	echo "<td>" . $row['jobTitle'] . "</td>";
																	$job_id = $row['id'];
																	$countApplication = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM apply_job WHERE jobPostId = '$job_id'"));
																	echo '<td><a href="view-application.php?JOB-ID='.$row['id'].'"><button class="btn btn-primary btn-sm">View Applications ('.$countApplication[0].')</button></a></td>';
																	if($row['jobStatus']== 1){
																		echo '<td><span class="label label-success">Hired</span></td>'; 
																	}
																	else if($row['jobStatus']==0){
																		echo '<td><span class="label label-warning">Pending</span></td>';
																	}
																	else if($row['jobStatus']==2){
																		echo '<td><span class="label label-danger">Declined</span></td>';
																	}



																	echo "<td>" . $row['jobSalary'] . "</td>";
																	echo '<td>
																	
																	<a href="edit-job-post.php?id=' . $row['id'] . '">
																	<i class="fa fa-edit " style="font-size:20px"></i>
																	</a>
																	<a href="action/delete-post-job-action.php?id='.$row['id'].'">
																	<i class="fa fa-trash text-danger delete_user" id=' . $row['id'] . ' style="font-size:20px"></i>
																	</a>

																	</td>';

																	$i++;

																	echo "</tr>";

																}

																mysqli_free_result($result);
															} 
														} 


														?>

													</tbody>
													<tfoot>

													</tfoot>
												</table>
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

			<script>
				$(function () {

					$('#example1').DataTable({
						'paging'      : false,
						'lengthChange': false,
						'searching'   : false,
						'ordering'    : false,
						'info'        : false,
						'autoWidth'   : false
					})
				})
				$(function () {

					$('#example2').DataTable({
						'paging'      : false,
						'lengthChange': false,
						'searching'   : false,
						'ordering'    : false,
						'info'        : false,
						'autoWidth'   : false
					})
				})
			</script>

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
										<input type="hidden" name="email" value="<?php echo $email?>">
											<input name="userImage" type="file" />
										
										
										<button type="submit" value="Submit" class="btn btn-primary">Upload Now</button>
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
		</div>
	</div>


			</html>