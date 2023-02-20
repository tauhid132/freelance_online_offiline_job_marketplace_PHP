<?php
// Initialize the session
session_start();
include('../../db/conn.php');
include('../../includes/functions.php');
$month= date('F-Y');




// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
	header("location: login.php");
	exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from colorlib.com/polygon/admindek/default/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 12 Dec 2019 16:07:52 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
	<title>Analytics | ATS Technology</title>


<!--[if lt IE 10]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

	<meta charset="utf-8">
	
	<?php include('../../includes/stylesheet.php'); ?>
</head>
<body>

	<div class="loader-bg">
		<div class="loader-bar"></div>
	</div>

	<div id="pcoded" class="pcoded">
		<div class="pcoded-overlay-box"></div>
		<div class="pcoded-container navbar-wrapper" header-theme="theme1">

			<?php include('../../includes/navbar.php'); ?>

			
		</div>

		<div class="pcoded-main-container">
			

			<?php include ("../../includes/sidebar.php"); ?>
			

			<div class="pcoded-content">

				<div class="page-header card">
					<div class="row align-items-end">
						<div class="col-lg-8">
							<div class="page-header-title">
								<i class="fa fa-area-chart bg-c-blue"></i>
								<div class="d-inline">
									<h5>Analytics</h5>
									
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="page-header-breadcrumb">
								<ul class=" breadcrumb breadcrumb-title">
									<li class="breadcrumb-item">
										<a href="index.html"><i class="feather icon-home"></i></a>
									</li>
									<li class="breadcrumb-item"><a href="#!">Report</a>
									</li>
									<li class="breadcrumb-item"><a href="#!">All-users</a>
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
										<div class="col-md-12 col-lg-12">
											<div class="card">
												<div class="card-header">
													<center>	<h5>Bill Collection Chart</h5></center>

												</div>
												<div>
													<canvas id="layanan_subbagian3"></canvas>
												</div>
											</div>
										</div>
										<div class="col-md-12 col-lg-12">
											<div class="card">
												<div class="card-header">
													<center>	<h5>New Connection Chart</h5></center>

												</div>
												<div>
													<canvas id="layanan_subbagian4"></canvas>
												</div>
											</div>
										</div>
										<div class="col-md-12 col-lg-12">
											<div class="card">
												<div class="card-header">
													<center>	<h5>Monthly Bill Chart</h5></center>

												</div>
												<div style="height:240px;">
													<canvas id="layanan_subbagian5"></canvas>
												</div>
											</div>
										</div>
										<div class="col-md-12 col-lg-12">
											<div class="card">
												<div class="card-header">
													<center>	<h5>AreaWise Users</h5></center>

												</div>
												<div style="height:240px;">
													<canvas id="areawiseuserschart"></canvas>
												</div>
											</div>
										</div>

										<div class="col-md-12 col-lg-12">
											<div class="card">
												<div class="card-header">
													<center>	<h5>Monthly Profit Chart</h5></center>

												</div>
												<div style="height:240px;">
													<canvas id="summonthlyprofit"></canvas>
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
		
	</div>

	

</div>
</div>
</div>
</div>


<!--[if lt IE 10]>
    <div class="ie-warning">
        <h1>Warning!!</h1>
        <p>You are using an outdated version of Internet Explorer, please upgrade
            <br/>to any of the following web browsers to access this website.
        </p>
        <div class="iew-container">
            <ul class="iew-download">
                <li>
                    <a href="http://www.google.com/chrome/">
                        <img src="../files/assets/images/browser/chrome.png" alt="Chrome">
                        <div>Chrome</div>
                    </a>
                </li>
                <li>
                    <a href="https://www.mozilla.org/en-US/firefox/new/">
                        <img src="../files/assets/images/browser/firefox.png" alt="Firefox">
                        <div>Firefox</div>
                    </a>
                </li>
                <li>
                    <a href="http://www.opera.com">
                        <img src="../files/assets/images/browser/opera.png" alt="Opera">
                        <div>Opera</div>
                    </a>
                </li>
                <li>
                    <a href="https://www.apple.com/safari/">
                        <img src="../files/assets/images/browser/safari.png" alt="Safari">
                        <div>Safari</div>
                    </a>
                </li>
                <li>
                    <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                        <img src="../files/assets/images/browser/ie.png" alt="">
                        <div>IE (9 & above)</div>
                    </a>
                </li>
            </ul>
        </div>
        <p>Sorry for the inconvenience!</p>
    </div>
<![endif]-->
<script>
	$(function () {
		

		var ctx_3 = document.getElementById("layanan_subbagian3").getContext('2d');
		var data_3 = {
			datasets: [{
				data: [
				
				<?php 
				for($i=1; $i<=30; $i++){
					echo sumDailyCollectedBill($i,$conn);
					echo ",";
				}
				?>
				
				],
				backgroundColor: [
				
				
				<?php 
				for($i=1; $i<=30; $i++){
					echo "'#3c8dbc'";
					echo ",";
				}
				?>
				

				],
			}],
			labels: [
			<?php 
			for($i=1; $i<=30; $i++){
				echo "'$i'";
				echo ",";
			}
			?>

			]
		};
		var myDoughnutChart_3 = new Chart(ctx_3, {
			type: 'bar',
			data: data_3,
			options: {
				maintainAspectRatio: false,
				legend: {
					position: 'bottom',
					labels: {
						boxWidth: 12
					}
				}
			}
		});



		var ctx_4 = document.getElementById("layanan_subbagian4").getContext('2d');
		var data_4 = {
			datasets: [{
				data: [
				<?php 
				for($j=11; $j>=0; $j--){
					$fromDate = date('Y-m', strtotime("-$j Months"));
					
					echo countNewUsers($fromDate,$conn);
					echo ",";
				}
				?>
				
				
				],
				backgroundColor: [
				<?php 
				for($i=1; $i<=12; $i++){
					echo "'#3c8dbc'";
					echo ",";
				}
				?>
				],
			}],
			labels: [
			<?php
			for($j=11; $j>=0; $j--){
				echo "'".date('F-Y', strtotime("-$j Months"))."'";
				echo ",";
			}
			?>

			]
		};
		var myDoughnutChart_4 = new Chart(ctx_4, {
			type: 'line',
			data: data_4,
			options: {
				maintainAspectRatio: false,
				legend: {
					position: 'bottom',
					labels: {
						boxWidth: 12
					}
				}
			}
		});


		var ctx_5 = document.getElementById("layanan_subbagian5").getContext('2d');
		var data_5 = {
			datasets: [{
				data: [
				<?php 
				for($j=11; $j>=0; $j--){
					$month_chart = date('F-Y', strtotime("-$j Months"));
					//$toDate = date('Y-m', strtotime("-$j Months"));
					echo countMonthlyBill($month_chart,$conn);
					echo ",";
				}
				?>
				
				
				],
				backgroundColor: [
				<?php 
				for($i=1; $i<=12; $i++){
					echo "'#3c8dbc'";
					echo ",";
				}
				?>
				],
			}],
			labels: [
			<?php
			for($j=11; $j>=0; $j--){
				echo "'".date('F-Y', strtotime("-$j Months"))."'";
				echo ",";
			}
			?>

			]
		};
		var myDoughnutChart_5 = new Chart(ctx_5, {
			type: 'line',
			data: data_5,
			options: {
				maintainAspectRatio: false,
				legend: {
					position: 'bottom',
					labels: {
						boxWidth: 12
					}
				}
			}
		});


		var ctx_6 = document.getElementById("areawiseuserschart").getContext('2d');
		var data_6 = {
			datasets: [{
				data: [
				<?php
				$sql = "SELECT * FROM service_area";
				if($result = mysqli_query($conn,$sql)){
					if(mysqli_num_rows($result) > 0){
						while($row = mysqli_fetch_array($result)){
							echo countAreaWiseUsers($row['area_name'],$conn);
							echo ",";
						}
					}
				};
				?>
				
				
				],
				backgroundColor: [
				<?php 
				for($i=1; $i<=12; $i++){
					echo "'#3c8dbc'";
					echo ",";
				}
				?>
				],
			}],
			labels: [
			<?php
			$sql2 = "SELECT * FROM service_area";
			if($result2 = mysqli_query($conn,$sql2)){
				if(mysqli_num_rows($result) > 0){
					while($row = mysqli_fetch_array($result2)){
						echo "'" .$row['area_name']. "'";
						echo ",";
					}
				}
			};
			?>

			]
		};
		var myDoughnutChart_6 = new Chart(ctx_6, {
			type: 'bar',
			data: data_6,
			options: {
				maintainAspectRatio: false,
				legend: {
					position: 'bottom',
					labels: {
						boxWidth: 12
					}
				}
			}
		});



		var ctx_7 = document.getElementById("summonthlyprofit").getContext('2d');
		var data_7 = {
			datasets: [{
				data: [
				<?php 
				for($j=11; $j>=0; $j--){
					$month_chart = date('F-Y', strtotime("-$j Months"));
					//$toDate = date('Y-m', strtotime("-$j Months"));
					echo sumMonthlyProfit($month_chart,$conn);
					echo ",";
				}
				?>
				
				
				],
				backgroundColor: [
				<?php 
				for($i=1; $i<=12; $i++){
					echo "'#3c8dbc'";
					echo ",";
				}
				?>
				],
			}],
			labels: [
			<?php
			for($j=11; $j>=0; $j--){
				echo "'".date('F-Y', strtotime("-$j Months"))."'";
				echo ",";
			}
			?>

			]
		};
		var myDoughnutChart_7 = new Chart(ctx_7, {
			type: 'line',
			data: data_7,
			options: {
				maintainAspectRatio: false,
				legend: {
					position: 'bottom',
					labels: {
						boxWidth: 12
					}
				}
			}
		});
	});













</script>

<?php include('../../includes/js.php'); ?>
</body>

<!-- Mirrored from colorlib.com/polygon/admindek/default/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 12 Dec 2019 16:08:25 GMT -->
</html>
