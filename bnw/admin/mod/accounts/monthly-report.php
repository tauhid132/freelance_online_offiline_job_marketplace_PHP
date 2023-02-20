<?php
session_start();
include('../../db/conn.php');
include('../../includes/functions.php');


// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
	header("location: login.php");
	exit;
}
$month=$_GET['month'];
//SUM Monthly bill
$add1=mysqli_query($conn,"SELECT SUM(monthly_bill) from `billing` WHERE billing_month = '$month'");
while($row1=mysqli_fetch_array($add1))
{
	$sum_monthly_bill=$row1['SUM(monthly_bill)'];
}
//SUM DUE bill
$add2=mysqli_query($conn,"SELECT SUM(pre_due) from `billing` WHERE billing_month = '$month'");
while($row2=mysqli_fetch_array($add2))
{
	$sum_due_bill=$row2['SUM(pre_due)'];
}
//SUM Collected Monthly bill
$add3=mysqli_query($conn,"SELECT SUM(paid_bill) from `billing` WHERE billing_month = '$month'");
while($row3=mysqli_fetch_array($add3))
{
	$sum_col_monthly_bill=$row3['SUM(paid_bill)'];
}
//Monthly colected bill percentige
$collected_percent=round(($sum_col_monthly_bill / $sum_monthly_bill)*100,2);
//SUM Collected DUE bill
$add4=mysqli_query($conn,"SELECT SUM(paid_due) from `billing` WHERE billing_month = '$month'");
while($row4=mysqli_fetch_array($add4))
{
	$sum_col_due_bill=$row4['SUM(paid_due)'];
}
//Sum Total Collected bill
$total_col_bill=$sum_col_monthly_bill + $sum_col_due_bill;
//Sum Remaining Monthly bill
$rem_monthly_bill=$sum_monthly_bill - $sum_col_monthly_bill;
//Sum Remaining Due bill
$rem_due_bill=$sum_due_bill - $sum_col_due_bill;
//Sum Remaining TOTAL bill
$rem_total_bill=$rem_monthly_bill + $rem_due_bill;


//Sum Salary Expense
$add5=mysqli_query($conn,"SELECT SUM(paid) from `salary` WHERE month = '$month'");
while($row5=mysqli_fetch_array($add5))
{
	$exp_salary=$row5['SUM(paid)'];
}
//Sum upstream Expense
$add16=mysqli_query($conn,"SELECT SUM(paid) from `upstream_bill` WHERE month = '$month' ");
while($row16=mysqli_fetch_array($add16))
{
	$monthly_upstream_bill=$row16['SUM(paid)'];
}
//Total Expense
$add11=mysqli_query($conn,"SELECT SUM(amount) from `expences` WHERE month = '$month'");
while($row11=mysqli_fetch_array($add11))
{
	$exp_total=$row11['SUM(amount)'];
}
//total Expense Final
$total_exp_final=$exp_total+ $exp_salary+$monthly_upstream_bill;









function collectedBillMethod($method,$month,$conn){
	$add100=mysqli_query($conn,"SELECT SUM(paid_bill) from `billing` WHERE pay_method = '$method' && billing_month = '$month'");
	while($row100=mysqli_fetch_array($add100))
	{
		$collectedMonthly=$row100['SUM(paid_bill)'];
	}
	$add101=mysqli_query($conn,"SELECT SUM(paid_due) from `billing` WHERE pay_method = '$method' && billing_month = '$month'");
	while($row101=mysqli_fetch_array($add101))
	{
		$collectedDue=$row101['SUM(paid_due)'];
	}
	$add102=mysqli_query($conn,"SELECT SUM(paid) from `otc_others` WHERE pay_method = '$method' && month = '$month'");
	while($row102=mysqli_fetch_array($add102))
	{
		$collectedOtc=$row102['SUM(paid)'];
	}
	return $collectedMonthly+$collectedDue+$collectedOtc;
}
$totalCollectedOnlinePayment = collectedBillMethod("Bkash",$month,$conn)+collectedBillMethod("Nogod",$month,$conn)+collectedBillMethod("Bank",$month,$conn);


//Genereted OTC
$add103=mysqli_query($conn,"SELECT SUM(amount) from `otc_others` WHERE month = '$month'");
while($row103=mysqli_fetch_array($add103))
{
	$otcAmount=$row103['SUM(amount)'];
}
//Collected OTC
$add104=mysqli_query($conn,"SELECT SUM(paid) from `otc_others` WHERE month = '$month'");
while($row104=mysqli_fetch_array($add104))
{
	$otcCollected=$row104['SUM(paid)'];
}

$query=mysqli_query($conn,"select * from `onlinepayment` where month='$month'");
$result=mysqli_fetch_array($query);
$bkashCashedOut = $result['bkashCashedOut'];
$nogodCashedOut = $result['nogodCashedOut'];
$bankCashedOut = $result['bankCashedOut'];

$balanceBkash = collectedBillMethod("Bkash",$month,$conn) - $bkashCashedOut;
$balanceNogod = collectedBillMethod("Nogod",$month,$conn) - $nogodCashedOut;
$balanceBank = collectedBillMethod("Bank",$month,$conn) - $bankCashedOut;
$totalOnlineBalance = $balanceBkash + $balanceNogod + $balanceBank;



$totalBill = $sum_due_bill+$sum_monthly_bill+$otcAmount;
$totalCollectedBill = $sum_col_monthly_bill + $sum_col_due_bill + $otcCollected;

$totalProfit = $totalCollectedBill - $total_exp_final;
$cashBalance = $totalProfit -$totalOnlineBalance;


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Monthly Report | <?php echo $siteName; ?></title>
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
				<h1><i class="fa fa-money"></i> Monthly Report of <?php echo $month ?> </h1>
				<ol class="breadcrumb">
					<li><a href="#">Accounts</a></li>
					<li><i class="fa fa-angle-right"></i> Monthly Report</li>
				</ol>
			</div>
			<div class="col-md-12">
				<form role="form" method="get" action="monthly-report.php">
					<div class="input-group">
						<select class="custom-select form-control" data-placeholder="Type to search cities" name="month" >

							<?php
							for($j=0; $j<=11; $j++){
            //echo "'".date('F-Y', strtotime("-$j Months"))."'";
								echo '<option value="'.date('F-Y', strtotime("-$j Months")).'">'.date('F-Y', strtotime("-$j Months")).'</option>';
							}
							?>
						</select>
						<div class="input-group-append">
							<button class="btn btn-outline-secondary" type="submit">Search</button>
						</div>
					</div>
				</form>
			</div>

			<!-- Main content -->
			<div class="content"> 
				<!-- Small boxes (Stat box) -->
				<div class="info-box">
					<div class="col-xl-12">
						<div class="card proj-progress-card">
							<div class="box-header bg-info">
								<center><h6 class="text-black bg-info font-weight-bold"><i class="fa fa-credit-card"></i> Monthly Billing Report</h6></center>
							</div>
							<div class="card-block">
								<div class="row">
									<div class="col-xl-3 col-md-6">
										<h6 class="text-black font-weight-bold">Monthly Bill</h6>
										<h5 class="m-b-30 f-w-700 text-info font-weight-bold"><?php echo $sum_monthly_bill ?></h5>

									</div>
									<div class="col-xl-3 col-md-6">
										<h6 class="text-black font-weight-bold">Due Bill</h6>
										<h5 class="m-b-30 f-w-700  text-info font-weight-bold"><?php echo $sum_due_bill ?></h5>

									</div>
									<div class="col-xl-3 col-md-6">
										<h6 class="text-black font-weight-bold">OTC & Others</h6>
										<h5 class="m-b-30 f-w-700  text-info font-weight-bold"><?php echo $otcAmount ?></h5>

									</div>
									<div class="col-xl-3 col-md-6">
										<h6 class="text-black font-weight-bold">Total Bill</h6>
										<h5 class="m-b-30 f-w-700 text-info font-weight-bold"><?php echo $totalBill ?></h5>

									</div>
								</div>
								<div class="row">
									<div class="col-xl-3 col-md-6">
										<h6 class="text-black font-weight-bold">Collected Monthly Bill</h6>
										<h5 class="m-b-30 f-w-700 text-info font-weight-bold"><?php echo $sum_col_monthly_bill ?></h5>

									</div>
									<div class="col-xl-3 col-md-6">
										<h6 class="text-black font-weight-bold">Collected Due Bill</h6>
										<h5 class="m-b-30 f-w-700 text-info font-weight-bold"><?php echo $sum_col_due_bill ?></h5>

									</div>
									<div class="col-xl-3 col-md-6">
										<h6 class="text-black font-weight-bold">Collected OTC</h6>
										<h5 class="m-b-30 f-w-700 text-info font-weight-bold"><?php echo $otcCollected ?></h5>

									</div>
									<div class="col-xl-3 col-md-6">
										<h6 class="text-black font-weight-bold">Total Collected Bill</h6>
										<h5 class="m-b-30 f-w-700 text-info font-weight-bold"><?php echo $totalCollectedBill ?></h5>

									</div>
									
									
									
								</div>
								<div class="row">
									<div class="col-xl-6 col-md-6">
										<h6 class="text-black font-weight-bold">Collected Percentige</h6>
										<h5 class="m-b-30 f-w-700 text-info font-weight-bold"><?php echo $collected_percent ?>%</h5>

									</div>
									<div class="col-xl-6 col-md-6">
										<h6 class="text-black font-weight-bold">Remaining Monthly Bill</h6>
										<h5 class="m-b-30 f-w-700 text-info font-weight-bold"><?php echo $rem_monthly_bill ?></h5>

									</div>
									
								</div>

							</div>

						</div>
					</div>
				</div>
				<div class="info-box">
					<div class="col-xl-12">
						<div class="card proj-progress-card">
							<div class="box-header bg-danger">
								<center><h6 class="text-black bg-danger font-weight-bold"><i class="fa fa-credit-card"></i> Monthly Expense Report</h6></center>
							</div>
							<div class="card-block">
								<div class="row">
									<div class="col-xl-3 col-md-6">
										<h6 class="text-black font-weight-bold">Salary</h6>
										<h5 class="m-b-30 f-w-700 text-danger font-weight-bold"><?php echo $exp_salary ?></h5>

									</div>
									<div class="col-xl-3 col-md-6">
										<h6 class="text-black font-weight-bold">Upstream</h6>
										<h5 class="m-b-30 f-w-700 text-danger font-weight-bold"><?php echo $monthly_upstream_bill ?></h5>

									</div>
									<div class="col-xl-3 col-md-6">
										<h6 class="text-black font-weight-bold">Networking</h6>
										<h5 class="m-b-30 f-w-700 text-danger font-weight-bold"><?php echo sumExpType("Networking",$month,$conn); ?></h5>

									</div>
									<div class="col-xl-3 col-md-6">
										<h6 class="text-black font-weight-bold">Meal</h6>
										<h5 class="m-b-30 f-w-700 text-danger font-weight-bold"><?php echo sumExpType("Meal",$month,$conn); ?></h5>

									</div>
								</div>
								<div class="row">
									<div class="col-xl-3 col-md-6">
										<h6 class="text-black font-weight-bold">Utilities</h6>
										<h5 class="m-b-30 f-w-700 text-danger font-weight-bold"><?php echo sumExpType("Utilities",$month,$conn); ?></h5>

									</div>
									<div class="col-xl-3 col-md-6">
										<h6 class="text-black font-weight-bold">Convence</h6>
										<h5 class="m-b-30 f-w-700 text-danger font-weight-bold"><?php echo sumExpType("Convence",$month,$conn) ?></h5>

									</div>
									<div class="col-xl-3 col-md-6">
										<h6 class="text-black font-weight-bold">Others</h6>
										<h5 class="m-b-30 f-w-700 text-danger font-weight-bold"><?php echo sumExpType("Others",$month,$conn) ?></h5>

									</div>
									<div class="col-xl-3 col-md-6">
										<h6 class="text-black font-weight-bold">Total Expense</h6>
										<h5 class="m-b-30 f-w-700 text-danger font-weight-bold"><?php echo $total_exp_final ?></h5>

									</div>
								</div>

							</div>

						</div>
					</div>
				</div>
				<div id="payment_div">
				<div class="info-box">
					<div class="col-xl-12">
						<div class="card proj-progress-card">
							<div class="box-header bg-warning">
								<center><h6 class="text-black bg-warning font-weight-bold"><i class="fa fa-credit-card"></i> Online Payment Report</h6></center>
							</div>
							<div class="card-block">
								<div class="row">
									<div class="col-xl-4 col-md-6">
										<h6 class="text-black font-weight-bold">bKash Collected</h6>
										<h5 class="m-b-30 f-w-700 text-black"><?php echo collectedBillMethod("Bkash",$month,$conn); ?></h5>

									</div>
									<div class="col-xl-4 col-md-6">
										<h6 class="text-black font-weight-bold">Nogod Collected</h6>
										<h5 class="m-b-30 f-w-700 text-black"><?php echo collectedBillMethod("Nogod",$month,$conn); ?></h5>

									</div>
									<div class="col-xl-4 col-md-6">
										<h6 class="text-black font-weight-bold">Bank Collected</h6>
										<h5 class="m-b-30 f-w-700 text-black"><?php echo collectedBillMethod("Bank",$month,$conn); ?></h5>

									</div>
									
								</div>
								<div class="row">
									<div class="col-xl-4 col-md-6">
										<h6 class="text-black font-weight-bold">bKash Cashed Out </h6>
										<h5 class="m-b-30 f-w-700 text-black "><?php echo $bkashCashedOut ?><i class="fa fa-edit ml-2 text-success update_bkashcashout"></i></h5>

									</div>
									<div class="col-xl-4 col-md-6">
										<h6 class="text-black font-weight-bold">Nogod Cashed Out</h6>
										<h5 class="m-b-30 f-w-700 text-black"><?php echo $nogodCashedOut ?><i class="fa fa-edit ml-2 text-success update_nogodcashout"></i></h5>

									</div>
									<div class="col-xl-4 col-md-6">
										<h6 class="text-black font-weight-bold">Bank Cashed Out</h6>
										<h5 class="m-b-30 f-w-700 text-black"><?php echo $bankCashedOut ?><i class="fa fa-edit ml-2 text-success update_bankcashout"></i></h5>

									</div>
									
								</div>
								<div class="row">
									<div class="col-xl-4 col-md-6">
										<h6 class="text-black font-weight-bold">Balance in bKash</h6>
										<h5 class="m-b-30 f-w-700 text-black "><?php echo $balanceBkash; ?></h5>

									</div>
									<div class="col-xl-4 col-md-6">
										<h6 class="text-black font-weight-bold">Balance in Nogod</h6>
										<h5 class="m-b-30 f-w-700 text-black"><?php echo $balanceNogod ?></h5>

									</div>
									<div class="col-xl-4 col-md-6">
										<h6 class="text-black font-weight-bold">Balance in Bank</h6>
										<h5 class="m-b-30 f-w-700 text-black"><?php echo $balanceBank ?></h5>

									</div>
									
								</div>
								
								<center>
									<div class="col-md-4 ">
										<h6 class="text-black bg-secondary font-weight-bold">Total Collected Online Payment</h6>
										<h5 class="m-b-30 f-w-700 text-black"><?php echo $totalCollectedOnlinePayment; ?></h5>

									</div>
									
								</center>	

							</div>

						</div>
					</div>
				</div>
				</div>
				<div id="balance_div">
				<div class="info-box">
					<div class="col-xl-12">
						<div class="card proj-progress-card">
							<div class="box-header bg-success">
								<center><h6 class="text-black bg-success font-weight-bold"><i class="fa fa-credit-card"></i> Monthly Balance Report</h6></center>
							</div>
							<div class="card-block">
								<div class="row">
									<div class="col-xl-4 col-md-6">
										<h6 class="text-black font-weight-bold">Total Profit</h6>
										<h5 class="m-b-30 f-w-700 text-success font-weight-bold"><?php echo $totalProfit ?></h5>

									</div>
									
									<div class="col-xl-4 col-md-6">
										<h6 class="text-black font-weight-bold">Online Balance</h6>
										<h5 class="m-b-30 f-w-700 text-success font-weight-bold"><?php echo $totalOnlineBalance ?></h5>

									</div>
									
									<div class="col-xl-4 col-md-6">
										<h6 class="text-black font-weight-bold">Balance In Cash</h6>
										<h5 class="m-b-30 f-w-700 text-success font-weight-bold"><?php echo $cashBalance ?></h5>

									</div>


								</div>

							</div>

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
	<script type="text/javascript">
		$(document).on('click', '.update_bkashcashout', function(){  
			swal("Enter New bKash Cashout Amount", {
				content: "input",
			})
			.then((value) => {
				var bkashCashedOut = value;
				if(bkashCashedOut == "" || bkashCashedOut == null){
					swal("Amount can't be empty!", {
						icon: "warning",
					});
				}else{
					$.ajax({
						url:"action/update-bkashcashout.php",
						method:"POST",
						data:{bkashCashedOut:bkashCashedOut},
						success:function(data){
							swal("Updated Successfully!", {
								icon: "success",
							});   
							$("#payment_div").load(location.href + " #payment_div");
							$("#balance_div").load(location.href + " #balance_div");  
						}
					});
				} 
			});
		});
		$(document).on('click', '.update_nogodcashout', function(){  
			swal("Enter New Nogod Cashout Amount", {
				content: "input",
			})
			.then((value) => {
				var nogodCashedOut = value;
				if(nogodCashedOut == "" || nogodCashedOut == null){
					swal("Amount can't be empty!", {
						icon: "warning",
					});
				}else{
					$.ajax({
						url:"action/update-nogodcashout.php",
						method:"POST",
						data:{nogodCashedOut:nogodCashedOut},
						success:function(data){
							swal("Updated Successfully!", {
								icon: "success",
							});   
							$("#payment_div").load(location.href + " #payment_div"); 
							$("#balance_div").load(location.href + " #balance_div");   
						}
					});
				} 
			});
		});
		$(document).on('click', '.update_bankcashout', function(){  
			swal("Enter New Bank Cashout Amount", {
				content: "input",
			})
			.then((value) => {
				var bankCashedOut = value;
				if(bankCashedOut == "" || bankCashedOut == null){
					swal("Amount can't be empty!", {
						icon: "warning",
					});
				}else{
					$.ajax({
						url:"action/update-bankcashout.php",
						method:"POST",
						data:{bankCashedOut:bankCashedOut},
						success:function(data){
							swal("Updated Successfully!", {
								icon: "success",
							});   
							$("#payment_div").load(location.href + " #payment_div");
							$("#balance_div").load(location.href + " #balance_div");    
						}
					});
				} 
			});
		});
	</script>

	<!-- jQuery 3 --> 

</body>
</html>
