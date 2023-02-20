<?php
include ('../database/dbconnect.php');
session_start();

$email = $_SESSION['email'];
$query=mysqli_query($conn,"SELECT * FROM employee  WHERE emailAddress = '$email';");
$result=mysqli_fetch_array($query);

$total_ear = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(job_payments.payAmount) FROM hire_employee JOIN job_payments on hire_employee.id = job_payments.jobId WHERE hire_employee.employeeEmail = '$email'"));
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
												<th>Employer Details</th>
												<th>Paid Amount</th>
												<th>Pay Method</th>
												<th>Date</th>
												
												

											</tr>
										</thead>
										<tbody>
											<?php


											$email = $_SESSION['email'];
											$sql = "SELECT *, hire_employee.id as jid from job_payments JOIN hire_employee on job_payments.jobId = hire_employee.id join employer on hire_employee.employerEmail = employer.emailAddress where employeeEmail = '$email'";
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
		<div class="modal fade" id="transfer_balance">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Transfer Balance</h4>

					</div>
					<div class="modal-body">
						<form method="post" action="action/transfer-balance-action.php">
							<div class="card-body">
								<div class="row">
									<div class="col-md-6">
										<input type="hidden" name="email"  value="<?php echo $email ?>">
										<div class="form-group">
											<label for="exampleInputEmail1">Choose Transfer Method</label>
											<select class="custom-select form-control" data-placeholder="Type to search cities" name="method" >
												<option value="bkash">bKash</option>
												<option value="Nagad">Nagad</option>
												<option value="Card">Credit Card</option>

											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="exampleInputEmail1">Amount</label>
											<input type="text" class="job-input" name="amount">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer justify-content-between">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<input type="submit" name="insert" id="insert" value="Request Transfer" class="btn btn-success" /> 
						</div>
					</div>
				</form>
				<!-- /.modal-content -->
			</div>
		</div>