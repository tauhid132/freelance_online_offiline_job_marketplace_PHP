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
	<title>My Works</title>

	<link rel="icon" type="image/png" href="images/fav.png">

	<?php include('../includes/stylesheet.php')  ?>
</head>
<body>


	
<?php include('../includes/header.php')  ?>

	<main class="browse-section">
		<div class="container">
			<div class="row">
				<?php include('includes/sidebar.php')  ?>
				<div class="col-lg-8 col-md-8 mainpage">
					<div class="account_heading">
						<div class="account_hd_left">
							<h1>My Works</h1>
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
												<th>#Job No</th>
												<th>#Hired By</th>
												<th>#Service</th>
												<th>#Status</th>
												<th>#Action</th>
												

											</tr>
										</thead>
										<tbody>
											<?php


											$email = $_SESSION['email'];
												$sql = "SELECT * , hire_employee.id as hid FROM (hire_employee JOIN service_portfolio ON hire_employee.servicePortfolioId = service_portfolio.id) JOIN employer ON hire_employee.employerEmail = employer.emailAddress WHERE hire_employee.employeeEmail = '$email'";
											if($result = mysqli_query($conn, $sql)){
												if(mysqli_num_rows($result) > 0){
													$i = 1;
													while($row = mysqli_fetch_array($result)){

														echo "<tr>";
														echo "<td>" . $i . "</td>";
														echo "<td>JOB-" . $row['hid'] . "</td>";
														echo '<td><img class="datatable_image" src="../'.$row['imageLink'].'" alt="">'. $row['fullName'] .'</td>';
														echo "<td>" . $row['service_name'] . "</td>";
														if($row['jobStatus']== 0)
															echo '<td><span class="label label-info">Hired</span></td>'; 
														else if($row['jobStatus']==1)
															echo '<td><span class="label label-warning">On Progress</span></td>';
														
														else if($row['jobStatus']==2)
															echo '<td><span class="label label-success">Completed</span></td>';
														
														
														echo '<td>
														<a href="track-job.php?job-id='.$row['hid'].'">
														<button class="btn btn-sm btn-primary"> Track Job</button>
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


</html>