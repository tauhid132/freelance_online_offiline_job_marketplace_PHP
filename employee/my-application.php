<?php
include ('../database/dbconnect.php');
session_start();

$email = $_SESSION['email'];
$query=mysqli_query($conn,"SELECT * FROM employee  WHERE emailAddress = '$email';");
$result=mysqli_fetch_array($query);


?>
<!DOCTYPE html>
<html lang="en">


<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, shrink-to-fit=9">
	<meta name="description" content="Gambolthemes">
	<meta name="author" content="Gambolthemes">
	<title>View Application</title>

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
							<h1>My Job Application</h1>
						</div>

					</div>
					<?php include('includes/topbar.php')  ?>
					
					
					<div class="dsh150">
						
						<div class="card" style="margin-top:20px">
							<div class="card-body">
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead class="bg-info text-white font-weight-bold">
											<tr>
												<th>#No</th>
												<th>#Service</th>
												<th>#Job Posted By</th>
												<th>#Applied Timestamp</th>
												<th>#Status</th>
												<!-- <th>#Action</th> -->
												

											</tr>
										</thead>
										<tbody>
											<?php


											$email = $_SESSION['email'];
											$sql = "SELECT *, apply_job.status as astatus FROM (apply_job join job_posts ON apply_job.jobPostId = job_posts.id) join employer on job_posts.email = employer.emailAddress join service_portfolio on apply_job.serviceId = service_portfolio.id WHERE apply_job.applicantEmail = '$email'";
											if($result = mysqli_query($conn, $sql)){
												if(mysqli_num_rows($result) > 0){
													$i = 1;
													while($row = mysqli_fetch_array($result)){

														echo "<tr>";
														echo "<td>" . $i . "</td>";
														echo "<td>" . $row['service_name'] . "</td>";
														echo '<td><img class="datatable_image" src="../'.$row['imageLink'].'" alt="">'. $row['fullName'] .'</td>';
														echo "<td>" . $row['applicationDate'] . "</td>";
														
														
														if($row['astatus']== 0)
															echo '<td><span class="label label-warning">Pending</span></td>'; 
														else if($row['astatus']==1)
															echo '<td><span class="label label-success">Hired</span></td>';
														else if($row['astatus']==2)
															echo '<td><span class="label label-danger">Declined</span></td>';

														
														// echo "<td>" . $row['jobSalary'] . "</td>";
														// echo '<td>

														// <a href="view-user.php?id=' . $row['id'] . '">
														// <button class="btn btn-sm btn-info">Message</button
														// </a>
														// <a href="../view-job-details.php?id=' . $row['serviceId'] . '">
														// <button class="btn btn-sm btn-primary">View Portfolio</button
														// </a>
														// <a href="action/delete-post-job-action.php?id='.$row['id'].'">
														// <button class="btn btn-sm btn-danger">Reject</button
														// </a>

														// </td>';

														$i++;
														
														echo "</tr>";

													}

													mysqli_free_result($result);
												} else{
													echo "No records matching your query were found.";
												}
											} else{
												echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
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
		</main>


		<?php include('../includes/footer.php')  ?>


		<button onclick="topFunction()" id="pageup" title="Go to top"><i class="fas fa-arrow-up"></i></button>
		<button onclick="topFunction()" id="pageup2" title="Go to top"><i class="fas fa-arrow-up"></i></button>



		<?php include('../includes/js.php')  ?>
		<script>
			$(function () {
				
				$('#example1').DataTable({
					'paging'      : true,
					'lengthChange': true,
					'searching'   : true,
					'ordering'    : false,
					'info'        : true,
					'autoWidth'   : false
				})
			})
		</script>

		<!-- Mirrored from gambolthemes.net/html-items/jobby/jobby-medical/hospital_dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 16 Mar 2022 15:41:37 GMT -->
		</html>