<?php
include ('../database/dbconnect.php');
session_start();

$email = $_SESSION['email'];
$query=mysqli_query($conn,"SELECT * FROM employer  WHERE emailAddress = '$email';");
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
	<title>My Portfolio</title>

	<link rel="icon" type="image/png" href="images/fav.png">

	<?php include('../includes/stylesheet.php')  ?>
</head>
<body>


	
	<?php include('../includes/header-employer.php')  ?>

	<main class="browse-section">
		<div class="container">
			<div class="row">
				<?php include('includes/sidebar.php')  ?>
				<div class="col-lg-8 col-md-8 mainpage">
					<div class="account_heading">
						<div class="account_hd_left">
							<h1>My Job Posts</h1>
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
														if($row['jobStatus']== 2)
															echo '<td><span class="label label-success">Completed</span></td>'; 
														else if($row['jobStatus']==1)
															echo '<td><span class="label label-warning">Hired</span></td>';
														else if($row['jobStatus']==0)
															echo '<td><span class="label label-danger">Pending</span></td>';

														
														echo "<td>" . $row['jobSalary'] . "</td>";
														echo '<td>
														<a href="view-user.php?id=' . $row['id'] . '">
														<i class="fa fa-eye text-info " style="font-size:20px"></i>
														</a>
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