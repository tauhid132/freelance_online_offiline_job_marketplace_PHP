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
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Analytics | <?php echo $siteName; ?></title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1" />

	<?php include('../../includes/stylesheet.php') ?>

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper boxed-wrapper">
		<?php include('../../includes/header.php') ?>
		<!-- Left side column. contains the logo and sidebar -->
		<aside class="main-sidebar"> 
			<!-- sidebar: style can be found in sidebar.less -->
			<?php include('../../includes/sidebar.php') ?>
			<!-- /.sidebar --> 
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper"> 
			<!-- Content Header (Page header) -->
			<div class="content-header sty-one">
				 <h1><i class="fa fa-bar-chart-o"></i> Analytics </h1>
				<ol class="breadcrumb">
					<li><a href="#">Report</a></li>
					<li><i class="fa fa-angle-right"></i> Analytics</li>
				</ol>
			</div>

			<!-- Main content -->
			<div class="content"> 
				<!-- Small boxes (Stat box) -->
				<div class="info-box">
					<div class="col-md-12 col-lg-12">
						<div class="card">
							<div class="card-header">
								<center>	<h5>Bill Collection Chart</h5></center>

							</div>
							<div class="card-body">
								<canvas id="layanan_subbagian3"></canvas>
							</div>
						</div>
					</div>
					<div class="col-md-12 col-lg-12 mt-2">
						<div class="card">
							<div class="card-header">
								<center>	<h5>New Connection Chart (Number)</h5></center>

							</div>
							<div class="card-body">
								<canvas id="layanan_subbagian4"></canvas>
							</div>
						</div>
					</div>
					<div class="col-md-12 col-lg-12 mt-2">
						<div class="card">
							<div class="card-header">
								<center>	<h5>New Connection Chart (Bill)</h5></center>

							</div>
							<div class="card-body">
								<canvas id="newUsersByBill"></canvas>
							</div>
						</div>
					</div>
					<div class="col-md-12 col-lg-12 mt-2">
						<div class="card">
							<div class="card-header">
								<center>	<h5>Monthly Bill Chart</h5></center>

							</div>
							<div class="card-header" style="height:240px;">
								<canvas id="layanan_subbagian5"></canvas>
							</div>
						</div>
					</div>
					<div class="col-md-12 col-lg-12 mt-2">
						<div class="card">
							<div class="card-header">
								<center>	<h5>AreaWise Users</h5></center>

							</div>
							<div class="card-body" style="height:240px;">
								<canvas id="areawiseuserschart"></canvas>
							</div>
						</div>
					</div>
					<div class="col-md-12 col-lg-12 mt-2">
						<div class="card">
							<div class="card-header">
								<center>	<h5>AreaWise Bill</h5></center>

							</div>
							<div class="card-body" style="height:240px;">
								<canvas id="areawisebill"></canvas>
							</div>
						</div>
					</div>

					<div class="col-md-12 col-lg-12 mt-2">
						<div class="card">
							<div class="card-header">
								<center>	<h5>Monthly Profit Chart</h5></center>

							</div>
							<div class="card-body" style="height:240px;">
								<canvas id="summonthlyprofit"></canvas>
							</div>
						</div>
					</div>


				</div>
			</div>
			<!-- /.content --> 
		</div>
		<!-- /.content-wrapper -->
		<?php include('../../includes/footer.php') ?>
	</div>
	<!-- ./wrapper --> 
	<?php include('../../includes/js.php') ?>





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
				type: 'bar',
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

			var ctx_8 = document.getElementById("areawisebill").getContext('2d');
			var data_8 = {
				datasets: [{
					data: [
					<?php
					$sql = "SELECT * FROM service_area";
					if($result = mysqli_query($conn,$sql)){
						if(mysqli_num_rows($result) > 0){
							while($row = mysqli_fetch_array($result)){
								echo sumAreaWiseBill($row['area_name'],$conn);
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
			var myDoughnutChart_8 = new Chart(ctx_8, {
				type: 'bar',
				data: data_8,
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


			var ctx_9 = document.getElementById("newUsersByBill").getContext('2d');
			var data_9 = {
				datasets: [{
					data: [
					<?php 
					for($j=11; $j>=0; $j--){
						$fromDate = date('Y-m', strtotime("-$j Months"));

						echo newUsersBill($fromDate,$conn);
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
			var myDoughnutChart_9 = new Chart(ctx_9, {
				type: 'bar',
				data: data_9,
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

</body>
</html>
