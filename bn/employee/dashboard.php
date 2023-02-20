<?php
include ('../database/dbconnect.php');
session_start();

$email = $_SESSION['email'];
$query=mysqli_query($conn,"SELECT * FROM employee  WHERE emailAddress = '$email';");
$result=mysqli_fetch_array($query);



$count_portfolio = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM service_portfolio WHERE employee_email = '$email'"));
$total_jobs = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM hire_employee WHERE employeeEmail = '$email'"));
$total_com = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM hire_employee WHERE employeeEmail = '$email' and jobStatus = 2"));
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
	<title>My Dashboard</title>

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
									<h4>Service Portfolios</h4>
									<span><?php echo $count_portfolio[0] ?></span>
								</div>
							</div>
							<div class="col-lg-3 col-12">
								<div class="collection_item">
									<div class="coll_icon">
										<i class="fas fa-bullseye col_icon2"></i>
									</div>
									<h4>Total Jobs</h4>
									<span><?php echo $total_jobs[0] ?></span>
								</div>
							</div>
							<div class="col-lg-3 col-12">
								<div class="collection_item">
									<div class="coll_icon">
										<i class="fas fa-check-circle" style="color: green;"></i>
									</div>
									<h4>Job Completed</h4>
									<span><?php echo $total_com[0] ?></span>
								</div>
							</div>
							<div class="col-lg-3 col-12">
								<div class="collection_item">
									<div class="coll_icon">
										<i class="fas fa-money-bill col_icon3"></i>
									</div>
									<h4>Total Earning</h4>
									<span><?php echo $total_ear[0] ?></span>
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
												$sql = "SELECT * , hire_employee.id as hid FROM (hire_employee JOIN service_portfolio ON hire_employee.servicePortfolioId = service_portfolio.id) JOIN employer ON hire_employee.employerEmail = employer.emailAddress WHERE hire_employee.employeeEmail = '$email' and jobStatus = 1 order by hireTime desc limit 3 ";
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
					<!-- <div class="view_chart">
						<div class="view_chart_header">
							<h4 class="mt-2">Total Earning</h4>
							<div class="date_selector">
								<div class="ui selection dropdown skills-search vchrt-dropdown">
									<input name="gender" type="hidden" value="default">
									<i class="dropdown icon d-icon"></i>
									<div class="text">Last 6 Months</div>
									<div class="menu">
										<div class="item" data-value="0">Last 6 Months</div>
										<div class="item" data-value="1">This Year</div>
										<div class="item" data-value="2">This Month</div>
									</div>
								</div>
							</div>
						</div>
						<div class="view_chart_body">
							<canvas id="chart" width="890" height="300" class="chartjs-render-monitor"></canvas>
						</div>
					</div> -->
					<!-- <div class="dsh150">
						<div class="row">
							<div class="col-lg-6">
								<div class="view_chart">
									<div class="view_chart_header">
										<h4>Static Analytics</h4>
									</div>
									<div class="view_chart_body">
										<div class="pie_chart_view">
											<canvas id="pieChart" width="607" height="303" class="chartjs-render-monitor"></canvas>
										</div>
										<ul class="static_list">
											<li>
												<div class="static_items">
													<div class="static_left">
														<div class="color_box" style="background-color: #496e9a;"></div>
														<h6>Members</h6>
													</div>
													<div class="static_right">
														<span>15</span>
													</div>
												</div>
											</li>
											<li>
												<div class="static_items">
													<div class="static_left">
														<div class="color_box" style="background-color: #49d086;"></div>
														<h6>Posted Jobs</h6>
													</div>
													<div class="static_right">
														<span>20</span>
													</div>
												</div>
											</li>
											<li>
												<div class="static_items">
													<div class="static_left">
														<div class="color_box" style="background-color: #54a6d6;"></div>
														<h6>Appointments</h6>
													</div>
													<div class="static_right">
														<span>30</span>
													</div>
												</div>
											</li>
											<li>
												<div class="static_items">
													<div class="static_left">
														<div class="color_box" style="background-color: #efa80f;"></div>
														<h6>Favourite Jobs</h6>
													</div>
													<div class="static_right">
														<span>25</span>
													</div>
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="view_chart">
									<div class="view_chart_header">
										<h4>Notes</h4>
									</div>
									<div class="view_chart_body">
										<ul class="all_notes scrollstyle_4">
											<li>
												<div class="note_item">
													<div class="note_left">
														<div class="priorty">High Priorty</div>
													</div>
													<div class="note_right">
														<button class="note_btn"><i class="far fa-edit"></i></button>
														<button class="note_btn"><i class="far fa-trash-alt"></i></button>
													</div>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quis accumsan mi.</p>
												</div>
											</li>
											<li>
												<div class="note_item">
													<div class="note_left">
														<div class="priorty priorty_low">Low Priorty</div>
													</div>
													<div class="note_right">
														<button class="note_btn"><i class="far fa-edit"></i></button>
														<button class="note_btn"><i class="far fa-trash-alt"></i></button>
													</div>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quis accumsan mi.</p>
												</div>
											</li>
											<li>
												<div class="note_item">
													<div class="note_left">
														<div class="priorty">High Priorty</div>
													</div>
													<div class="note_right">
														<button class="note_btn"><i class="far fa-edit"></i></button>
														<button class="note_btn"><i class="far fa-trash-alt"></i></button>
													</div>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quis accumsan mi.</p>
												</div>
											</li>
											<li>
												<div class="note_item">
													<div class="note_left">
														<div class="priorty priorty_medium">Medium Priorty</div>
													</div>
													<div class="note_right">
														<button class="note_btn"><i class="far fa-edit"></i></button>
														<button class="note_btn"><i class="far fa-trash-alt"></i></button>
													</div>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quis accumsan mi.</p>
												</div>
											</li>
										</ul>
									</div>
									<div class="add_note">
										<button class="add_note_btn" type="button" data-toggle="modal" data-target="#addnoteModal">Add Note</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="dsh150">
						<div class="row">
							<div class="col-lg-7">
								<div class="view_chart">
									<div class="view_chart_header">
										<h4>Applied Jobs</h4>
									</div>
									<div class="view_applied_jobs_body">
										<ul class="all_applied_jobs scrollstyle_4">
											<li>
												<div class="applied_item">
													<a href="#">Ayurvedic Doctor</a>
													<span class="badge_alrt">Pending Approval</span>
													<ul class="view_dt_job">
														<li><div class="vw1254"><i class="far fa-clock"></i>Posted on 3 August 2019</div></li>
														<li><div class="vw1254"><i class="far fa-clock"></i>Expiring on 3 September 2019</div></li>
													</ul>
													<div class="btn_link23">
														<button class="apled_btn60"><span class="badge badge-light">0</span>APPLIED CANDIDATES</button>
														<a href="#" class="edit_icon1"><i class="far fa-edit"></i></a>
														<a href="#" class="delete_icon1"><i class="far fa-trash-alt"></i></a>
													</div>
												</div>
											</li>
											<li>
												<div class="applied_item">
													<a href="#">Radiologist (Radiology) DOCTOR IS</a>
													<span class="badge_alrt">Approved</span>
													<ul class="view_dt_job">
														<li><div class="vw1254"><i class="far fa-clock"></i>Posted on 29 July 2019</div></li>
														<li><div class="vw1254"><i class="far fa-clock"></i>Expiring on 29 August 2019</div></li>
													</ul>
													<div class="btn_link23">
														<button class="apled_btn60"><span class="badge badge-light">3</span>APPLIED CANDIDATES</button>
														<a href="#" class="edit_icon1"><i class="far fa-edit"></i></a>
														<a href="#" class="delete_icon1"><i class="far fa-trash-alt"></i></a>
													</div>
												</div>
											</li>
											<li>
												<div class="applied_item">
													<a href="#">Nurse</a>
													<span class="badge_alrt">Approved</span>
													<ul class="view_dt_job">
														<li><div class="vw1254"><i class="far fa-clock"></i>Posted on 24 July 2019</div></li>
														<li><div class="vw1254"><i class="far fa-clock"></i>Expiring on 24 August 2019</div></li>
													</ul>
													<div class="btn_link23">
														<button class="apled_btn60"><span class="badge badge-light">5</span>APPLIED CANDIDATES</button>
														<a href="#" class="edit_icon1"><i class="far fa-edit"></i></a>
														<a href="#" class="delete_icon1"><i class="far fa-trash-alt"></i></a>
													</div>
												</div>
											</li>
											<li>
												<div class="applied_item">
													<a href="#">Dentist Doctor</a>
													<span class="badge_alrt">Approved</span>
													<ul class="view_dt_job">
														<li><div class="vw1254"><i class="far fa-clock"></i>Posted on 15 June 2019</div></li>
														<li><div class="vw1254"><i class="far fa-clock"></i>Expiring on 15 July 2019</div></li>
													</ul>
													<div class="btn_link23">
														<button class="apled_btn60"><span class="badge badge-light">6</span>APPLIED CANDIDATES</button>
														<a href="#" class="edit_icon1"><i class="far fa-edit"></i></a>
														<a href="#" class="delete_icon1"><i class="far fa-trash-alt"></i></a>
													</div>
												</div>
											</li>
										</ul>
										<a href="#" class="btn-veiw10">View All</a>
									</div>
								</div>
							</div>
							<div class="col-lg-5">
								<div class="view_chart">
									<div class="view_chart_header">
										<h4>Order Plans Summery</h4>
									</div>
									<div class="view_applied_jobs_body">
										<ul class="all_paid_plans scrollstyle_4">
											<li>
												<div class="plan_dts">
													<div class="plan_dt_left">
														<h4>Professional Plans</h4>
														<p>Order No : #12345</p>
														<p>Date : 10 October 2018</p>
													</div>
													<div class="plan_dt_right">
														<button class="paid_btn">Paid</button>
													</div>
												</div>
											</li>
											<li>
												<div class="plan_dts">
													<div class="plan_dt_left">
														<h4>Professional Plans</h4>
														<p>Order No : #12358</p>
														<p>Date : 10 September 2018</p>
													</div>
													<div class="plan_dt_right">
														<button class="paid_btn">Paid</button>
													</div>
												</div>
											</li>
											<li>
												<div class="plan_dts">
													<div class="plan_dt_left">
														<h4>Professional Plans</h4>
														<p>Order No : #12358</p>
														<p>Date : 10 August 2018</p>
													</div>
													<div class="plan_dt_right">
														<button class="paid_btn">Paid</button>
													</div>
												</div>
											</li>
											<li>
												<div class="plan_dts">
													<div class="plan_dt_left">
														<h4>Professional Plans</h4>
														<p>Order No : #12365</p>
														<p>Date : 10 July 2018</p>
													</div>
													<div class="plan_dt_right">
														<button class="paid_btn">Paid</button>
													</div>
												</div>
											</li>
										</ul>
									</div>
								</div> -->
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
                <input type="hidden" name="email" value="<?php echo $email;?>">
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