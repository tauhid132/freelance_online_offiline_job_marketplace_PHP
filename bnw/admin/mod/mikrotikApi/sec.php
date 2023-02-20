<?php
// Initialize the session
session_start();
include('../../db/conn.php');



include('includes/routeros_api.class.php');			
include('includes/connapi.php');

//$moniServer = $moniServer->comm("/ppp/active/print");
$testServer = $testServer->comm("/ppp/secret/print");
//$ARRAY = array_merge($moniServer,$testServer,);
//array_push($ARRAY, $moniServer->comm("/ppp/active/print"));
           // $ARRAY2 = $API2->comm("/ppp/active/print");				

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
	header("location: login.php");
	exit;
}

?>
<!DOCTYPE html>
<html lang="en">


<head>
	<title>Online Users | <?php echo $siteName; ?></title>

	<?php include('../../includes/stylesheet.php'); ?>
</head>
<body>

	<div class="loader-bg">
		<div class="loader-bar"></div>
	</div>

	<div id="pcoded" class="pcoded">
		<div class="pcoded-overlay-box"></div>
		<div class="pcoded-container navbar-wrapper">

			<?php include('../../includes/navbar.php'); ?>

			
		</div>

		<div class="pcoded-main-container">
			

			<?php include ("../../includes/sidebar.php"); ?>
			

			<div class="pcoded-content">

				<div class="page-header card">
					<div class="row align-items-end">
						<div class="col-lg-8">
							<div class="page-header-title">
								<i class="feather icon-inbox bg-c-blue"></i>
								<div class="d-inline">
									<h5>Active Users List</h5>
									
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="page-header-breadcrumb">
								<ul class=" breadcrumb breadcrumb-title">
									<li class="breadcrumb-item">
										<a href="index.html"><i class="feather icon-home"></i></a>
									</li>
									<li class="breadcrumb-item"><a href="#!">Users</a>
									</li>
									<li class="breadcrumb-item"><a href="#!">Active Users</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>

				<div class="pcoded-inner-content">

					<div class="main-body">
						<div class="page-wrapper">

							<div class="page-body">

								<div class="card">
									
									<div class="card-block">
										<div class="table-responsive dt-responsive">
											<table id="online-users-table" class="table table-striped table-bordered nowrap">
												<thead class="text-white bg-c-blue">
													<tr>
														
														<th>Uptime</th>
														<th>IP</th>
														<th>Status</th>
														<th>A/C</th>
														<!-- <th>Action</th> -->
													</tr>
												</thead>
												<tbody>
													<?php

// Attempt select query execution					
													
													$num =count($testServer);													
													for($i=0; $i<$num; $i++){
													$no=$i+1;
													
                                                   // $bytes =  $ARRAY[$i]['bytes-out']/1048576;
													echo "<tr>";
														echo "<td>".$no."</td>";
														echo "<td>".$testServer[$i]['name']."</td>";
                                                        echo "<td>".$testServer[$i]['service']."</td>";
														//echo "<td>".$testServer[$i]['address']."</td>";
														echo "<td>".$testServer[$i]['caller-id']."</td>";
														//echo "<td>".$testServer[$i]['uptime']."</td>";
														//echo "<td><a href='../process/pppoe_online_kick.php?user=".$i."'><center><img src='../img/kick.png' width=20px title=Kick></a></td>";
													echo "</tr>";
													
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
		</div>
		
	</div>

	

</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#online-users-table').DataTable();
	});
</script>



<?php include('../../includes/js.php'); ?>
</body>

</html>
