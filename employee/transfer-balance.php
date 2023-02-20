<?php
include ('../database/dbconnect.php');
session_start();

$email = $_SESSION['email'];
$query=mysqli_query($conn,"SELECT * FROM employee  WHERE emailAddress = '$email';");
$result=mysqli_fetch_array($query);

$total_ear = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(job_payments.payAmount) FROM hire_employee JOIN job_payments on hire_employee.id = job_payments.jobId WHERE hire_employee.employeeEmail = '$email'"));
$total_transfer = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(transferAmount) FROM transfer_balance  WHERE email = '$email'"));

$currentBal = $total_ear[0] - $total_transfer[0];
?>
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
							<div class="card-header">
								<h2>Transfer Balance</h2>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="exampleInputEmail1">Current Balance</label>
											<input type="text" class="job-input" value="<?php echo $currentBal ?>" name="amount" disabled>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="exampleInputEmail1">Transfer Amount</label>
											<input type="text" class="job-input" name="amount">
										</div>
									</div>
								</div>
								<div class="mt-20">
									<center>
										<button class="btn btn-info" data-toggle="modal" data-target="#transfer_balance"> Transfer Now!</button>
									</center>
								</div>
							</div>
						</div>
						<div class="card" style="margin-top:20px">
							<div class="card-body">
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead class="bg-info text-white font-weight-bold">
											<tr>
												<th>No</th>
												<th>Transfer ID</th>
												<th>Transfer Amount</th>
												<th>Transfer Method</th>
												<th>Status</th>
												<th>TimeStamp</th>
												
												

											</tr>
										</thead>
										<tbody>
											<?php


											$email = $_SESSION['email'];
											$sql = "SELECT * FROM transfer_balance WHERE email = '$email'";
											if($result = mysqli_query($conn, $sql)){
												if(mysqli_num_rows($result) > 0){
													$i = 1;
													while($row = mysqli_fetch_array($result)){

														echo "<tr>";
														echo "<td>" . $i . "</td>";
														
														
														echo "<td>" . $row['id'] . "</td>";
														
														echo "<td>" . $row['transferAmount'] . "</td>";
														echo "<td>" . $row['transferMethod'] . "</td>";
														if($row['status']== 0)
															echo '<td><span class="label label-warning">Pending</span></td>'; 
														else if($row['status']==1)
															echo '<td><span class="label label-success">Success</span></td>';
														
														else if($row['status']==2)
															echo '<td><span class="label label-success">Completed</span></td>';
														echo "<td>" . $row['timestamp'] . "</td>";
														
														

														
														
														

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