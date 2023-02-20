<?php
session_start();
include('../../db/conn.php');

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
	header("location: ../../login.php");
	exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>System Log | <?php echo $siteName; ?></title>
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
				<h1>System Logs</h1>
				<ol class="breadcrumb">
					<li><a href="#">Settings</a></li>
					<li><i class="fa fa-angle-right"></i> syslog</li>
				</ol>
			</div>

			<!-- Main content -->
			<div class="content"> 
				<!-- Small boxes (Stat box) -->
				<div class="info-box">

					<div class="table-responsive">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Timestamp</th>
									<th>Module</th>
									<th>By</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php

// Attempt select query execution
													$i=1;
													$sql = "SELECT * FROM log ORDER BY id DESC";
													if($result = mysqli_query($conn, $sql)){
														if(mysqli_num_rows($result) > 0){

															while($row = mysqli_fetch_array($result)){

																echo "<tr>";
																echo "<td>" . $i . "</td>";
																echo "<td>" . $row['timestamp'] . "</td>";
																echo "<td>" . $row['module'] . "</td>";
																echo "<td>" . $row['action_by'] . "</td>";

																echo "<td>" . $row['action'] . "</td>";
																$i++;


																echo "</tr>";

															}

        // Free result set
															mysqli_free_result($result);
														} 
													} else{
														echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
													}

// Close connection

													?>

							</tbody>
							<tfoot>

							</tfoot>
						</table>
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
			$('#example1').DataTable()
			$('#example2').DataTable({
				'paging'      : true,
				'lengthChange': false,
				'searching'   : false,
				'ordering'    : true,
				'info'        : true,
				'autoWidth'   : false
			})
		})
	</script>


</body>
</html>
