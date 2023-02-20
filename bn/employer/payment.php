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
	<title>My Payments</title>

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
							<h1>My Payments</h1>
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
												<th>Job ID</th>
												<th>Employee Details</th>
												<th>Paid Amount</th>
												<th>Pay Method</th>
												<th>Date</th>
												
												

											</tr>
										</thead>
										<tbody>
											<?php


											$email = $_SESSION['email'];
												$sql = "SELECT *, hire_employee.id as jid from job_payments JOIN hire_employee on job_payments.jobId = hire_employee.id join employee on hire_employee.employeeEmail = employee.emailAddress where employerEmail = '$email'";
											if($result = mysqli_query($conn, $sql)){
												if(mysqli_num_rows($result) > 0){
													$i = 1;
													while($row = mysqli_fetch_array($result)){

														echo "<tr>";
														echo "<td>" . $i . "</td>";
														
														
														echo "<td>" . $row['jid'] . "</td>";
														echo '<td><img class="datatable_image" src="../'.$row['imageLink'].'" alt="">'. $row['fullName'] .'</td>';
														echo "<td>" . $row['payAmount'] . "</td>";
														echo "<td>" . $row['payMethod'] . "</td>";
														echo "<td>" . $row['payTimestamp'] . "</td>";
														
														

														
														
														

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