<?php
include ('../database/dbconnect.php');
session_start();

$email = $_SESSION['email'];
$query=mysqli_query($conn,"SELECT * FROM employer  WHERE emailAddress = '$email';");
$result=mysqli_fetch_array($query);

$job_id = $_GET['job-id'];
$query2=mysqli_query($conn,"SELECT * FROM hire_employee join employee on hire_employee.employeeEmail = employee.emailAddress join service_portfolio on hire_employee.servicePortfolioId = service_portfolio.id left join job_payments on job_payments.jobId = $job_id where hire_employee.id = '$job_id'");
$result2=mysqli_fetch_array($query2);



?>
<!DOCTYPE html>
<html lang="en">


<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, shrink-to-fit=9">
	<meta name="description" content="Gambolthemes">
	<meta name="author" content="Gambolthemes">
	<title>Track Job</title>

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
							<h1>Job Tracker</h1>
						</div>

					</div>
					<?php include('includes/topbar.php')  ?>
					
					
					<div class="dsh150">
						<div class="row" style="margin-top:30px">
							<div class="col-lg-8">
								<div class="card">
									<div class="card-body">
										
										<div class="form-body">
											<div class="form-group row">
												<label class="control-label text-right col-md-3">Worker Name</label>
												<div class="col-md-9">
													<input placeholder="First Name" class="form-control" type="text" value="<?php echo $result2['fullName'] ?>" readonly>
												</div>
											</div>
											<div class="form-group row">
												<label class="control-label text-right col-md-3">Service Name</label>
												<div class="col-md-9">
													<input placeholder="Last Name" class="form-control" value="<?php echo $result2['service_name'] ?>" type="text" readonly>
												</div>
											</div>
											<div class="form-group row">
												<label class="control-label text-right col-md-3">Service Type</label>
												<div class="col-md-9">
													<input placeholder="Last Name" class="form-control" value="<?php echo $result2['service_working_type'] ?>" type="text" readonly>
												</div>
											</div>

											<div class="form-group row">
												<label class="control-label text-right col-md-3">Salary</label>
												<div class="col-md-9">
													<input class="form-control" value="<?php echo $result2['service_salary'] ?> / <?php echo $result2['service_salary_method'] ?>" type="text" readonly>
												</div>
											</div> 
											<div class="form-group row">
												<label class="control-label text-right col-md-3">Total Payment</label>
												<div class="col-md-9">
													<input class="form-control" value="<?php echo $result2['service_salary'] ?>" type="text" readonly>
												</div>
											</div> 
										</div>


									</div>
								</div>
							</div>
							<div class=" card col-lg-4 mt-20">

								<div class="timeline p-4 block mb-4 mt-20">

									<div class="tl-item active">
										<div class="tl-dot b-primary"></div>
										<div class="tl-content">
											<div class="">Hired Employee</div>
											<div class="tl-date text-muted mt-1"><?php echo $result2['hireTime'] ?></div>
										</div>
									</div>
									<?php 
									if($result2['jobStartTime'] == NULL){
										echo '<div class="tl-item ">
										<div class="tl-dot b-danger"></div>
										<div class="tl-content">
										<div class="">Started Working</div>
										<div class="tl-date text-muted mt-1">Not Started</div>
										</div>
										</div>';
									}else{
										echo '<div class="tl-item active">
										<div class="tl-dot b-primary"></div>
										<div class="tl-content">
										<div class="">Started Working</div>
										<div class="tl-date text-muted mt-1">'. $result2['jobStartTime'].'.</div>
										</div>
										</div>';
									}
									?>

									<?php 
									if($result2['jobFinishTime'] == NULL){
										echo '<div class="tl-item ">
										<div class="tl-dot b-danger"></div>
										<div class="tl-content">
										<div class="">Finished Working</div>
										<div class="tl-date text-muted mt-1">Not Finished</div>
										</div>
										</div>';
									}else{
										echo '<div class="tl-item active">
										<div class="tl-dot b-primary"></div>
										<div class="tl-content">
										<div class="">Finished Working</div>
										<div class="tl-date text-muted mt-1">'. $result2['jobFinishTime'].'</div>
										</div>
										</div>';
									}
									?>

									<?php 
									if($result2['payAmount'] == NULL){
										echo '<div class="tl-item ">
										<div class="tl-dot b-danger"></div>
										<div class="tl-content">
										<div class="">Payment Status</div>
										<div class="tl-date text-muted mt-1">Payment Pending</div>
										</div>
										</div>';
									}else{
										echo '<div class="tl-item active">
										<div class="tl-dot b-primary"></div>
										<div class="tl-content">
										<div class="">Payment Status</div>
										<div class="tl-date text-muted mt-1">'. $result2['payTimestamp'].'</div>
										</div>
										</div>';
									}
									?>


									

								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="card">
								<div class="card-body">
									<center>
										<!-- <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#choose_payment"><i class="fa f fa-share-square-o"></i> Make Payment</button> -->
										<button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#rating"><i class="fa f fa-share-square-o"></i> Give Rating</button>
										<!-- <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-send-sms"><i class="fa f fa-times"></i> Abort Job</button> -->
									</center>
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="card">
								<div class="card-body">
									<div class="applied_candidates_item">
										<div class="row">
											<div class="col-xl-7">
												<div class="applied_candidates_dt">
													<div class="candi_img">
														<img src="<?php echo $url ?>/<?php echo $result2['imageLink'] ?>" alt="">
													</div>
													<div class="candi_dt">
														<a href="#"><?php echo $result2['fullName'] ?></a>
														<!-- <div class="candi_cate">Car Painter</div> -->
														<div class="rating_candi">Rating
															<div class="star">
																<?php
																for($i=0; $i<$result2['jobRating']; $i++){
																	echo '<i class="fas fa-star"></i>';
																}  
																?>
																
																<span><?php echo $result2['jobRating'] ?></span>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="btn_link24 review_user">
											<p>"<?php echo $result2['jobComment'] ?>"</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="card">
							<div class="card-body">
								<div class="row" >
									<div class="col-md-4" style="display: flex;">
										<img id="bkash_pay" src="bkash.gif" style="height:100px; width:200px; ">
									</div>
									<div class="col-md-4" style="display: flex;">
										<a href="nagad-pay.php?job-id=<?php echo $job_id ?>"><img src="nogod.png" style="height:100px; width:200px;  "></a>
									</div>
									<div class="col-md-4" style="display: flex;">
										<img id="card_payment" src="master-card.png" style="height:100px; width:200px; ">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>



<?php include('../includes/footer.php')  ?>


<button onclick="topFunction()" id="pageup" title="Go to top"><i class="fas fa-arrow-up"></i></button>
<button onclick="topFunction()" id="pageup2" title="Go to top"><i class="fas fa-arrow-up"></i></button>



<?php include('../includes/js.php')  ?>





</html>

<div class="modal fade" id="rating">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Rating And Review</h4>

			</div>
			<div class="modal-body">
				<form method="post" action="action/review-rating-action.php">
					<div class="card-body">
						<div class="row">
							<div class="col-md-6">
								<input type="hidden" name="job_id" value="<?php echo $job_id ?>">
								<div class="form-group">
									<label for="exampleInputEmail1">Rating</label>
									<select class="custom-select form-control" data-placeholder="Type to search cities" name="rating" >
										<option value="1">1 (Very Poor)</option>
										<option value="2">2 (Poor)</option>
										<option value="3">3 (Average)</option>
										<option value="4">4 (Good)</option>
										<option value="5">5 (Very Good)</option>

									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleInputEmail1">Review or Comment</label>
									<textarea class="textarea_input" name="comment"></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<input type="submit" name="insert" id="insert" value="Save" class="btn btn-success" /> 
				</div>
			</div>
		</form>
		<!-- /.modal-content -->
	</div>
</div>
</div>







<script type="text/javascript">



	$("#bkash_pay").bind("click", function(){
		$('#choose_payment').modal('hide');
		$('#bkash_payment').modal('show');
	});  
	$("#card_payment").bind("click", function(){
		$('#card_pay').modal('show');
	});  

	$(document).ready(function(){
		$('#pay_form').on("submit", function(event){  
			event.preventDefault();  
			 // $('#bkash_payment2').modal('show');
			$.ajax({  
				url:"action/bkash-otp-action.php",  
				method:"POST",  
				data:$('#pay_form').serialize(),  
				beforeSend:function(){  
					
				},  
				success:function(data){  
						//$('#start_job')[0].reset();  
						
						$('#bkash_payment2').modal('show');
						$('#cus_name').val(data.cusName);  
						// Swal.fire({
						// 	position: 'center',
						// 	icon: 'success',
						// 	title: 'Payment is successful!',
						// 	showConfirmButton: false,
						// 	timer: 1500
						// })

					}  
				});  

		});
	});
	$(document).ready(function(){
		$('#pay_form2').on("submit", function(event){  
			event.preventDefault();  
			
			$.ajax({  
				url:"action/bkash-payment-action.php",  
				method:"POST",  
				data:$('#pay_form2').serialize(),  
				beforeSend:function(){  
					
				},  
				success:function(data){  
						
						 
						 if(data == 1){
						 	$('#bkash_payment_pass').modal('show');
						 }else{
						 	Swal.fire({
							position: 'center',
							icon: 'error',
							title: 'Payment Failed',
							showConfirmButton: false,
							timer: 1500
						})
						 }
						

					}  
				});  

		});


	});

	$(document).ready(function(){
		$('#pay_form3').on("submit", function(event){  
			event.preventDefault();  
			$.ajax({  
				url:"action/bkash-final-pay.php",  
				method:"POST",  
				data:$('#pay_form3').serialize(),  
				beforeSend:function(){  
					
				},  
				success:function(data){  
						//$('#start_job')[0].reset();  
						// $('#bkash_payment2').modal('show');
						
						Swal.fire({
							position: 'center',
							icon: 'success',
							title: 'Payment is successful',
							showConfirmButton: false,
							timer: 1500
						})
						

					}  
				});  

		});
		});
</script>


<div class="modal" id="card_pay" >
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Rating And Review</h4>

			</div>
			<div class="modal-body">
				<form method="post" action="action/review-rating-action.php">
					<div class="card-body">
						<div class="row">
							<div class="col-md-6">
								<input type="hidden" name="job_id" value="<?php echo $job_id ?>">
								<div class="form-group">
									<label for="exampleInputEmail1">Rating</label>
									<select class="custom-select form-control" data-placeholder="Type to search cities" name="rating" >
										<option value="1">1 (Very Poor)</option>
										<option value="2">2 (Poor)</option>
										<option value="3">3 (Average)</option>
										<option value="4">4 (Good)</option>
										<option value="5">5 (Very Good)</option>

									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleInputEmail1">Review or Comment</label>
									<textarea class="textarea_input" name="comment"></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<input type="submit" name="insert" id="insert" value="Save" class="btn btn-success" /> 
				</div>
			</div>
		</form>
		<!-- /.modal-content -->
	</div>
</div>
</div>


<div id="bkash_payment" class="modal" >
	<div class="modal-dialog " style="width:380px;" >
		<div class="modal-content">

			<div class="form-signin">
				<span id="header"><div>
					<div>
						<div class="bkash_image">
							<img src="bkash.gif">
						</div>

						<hr id="itemDiv" class="itemDivider">

						<div id="trxInfo">
							<div id="merchantLogo" style="background-image: url(&quot;https://s3-ap-southeast-1.amazonaws.com/merchantlogo.pay.bka.sh/merchant-default-logo.png&quot;);"></div>
							<div class="infoNameInvoice">
								<span id="merchantName">Work For All</span>
								<div class="infoInvoice">
									<span class="invoiceText">Invoice:</span>
									<span id="merchantInvoice1">INV1651934076378</span>
								</div>
								<span id="merchantInvoice2"></span>

							</div>
							<div class="trxMerchantAmount">
								<span class="merchantAmount">৳ </span><span id="merchantAmountVal"><?php echo $result2['service_salary'] ?></span>
							</div>
						</div>
					</div></span>
					<span id="containerb"><form class="formBody" id="pay_form">
						<input type="hidden" value="<?php echo $job_id ?>" name="job-id">
						<input type="hidden" value="<?php echo $result2['service_salary'] ?>" name="pay_amount">
						<div id="inputHolder">
							<span for="wallet" class="infoText">Your bKash Account number</span>
							<input type="text" id="wallet" name="mobile" style=" text-align: center;
							border-radius: 0px;
							width: 80%;" class="form-control" font-size="18px" ;="" placeholder="e.g 01XXXXXXXXX" maxlength="11" autocomplete="off" required="">

							<span class="infoText">By clicking on <b> Confirm,</b> you are agreeing to the <b><a href="https://www.bkash.com/terms-of-use-checkout" target="_blank">terms &amp; conditions</a></b> </span>

							<div id="error"></div>
						</div>

						<div id="loader_div" style="display: none;">
							<div id="loader_image"></div>
						</div>

						<div id="button_div" class="buttonAction">
							<button type="button" class="bkash_btn"  id="close_button">Close</button>
							<button type="submit" class="bkash_btn" id="submit_button">Confirm</button>

						</div>
					</form></span>
					<span id="footer"><div id="footerItem" style="padding:10px">
						<div id="credit">


							<b id="dialText">*This is a dummy Payment. For Project Only.</b>
						</div>
					</div>
				</div>
			</div>
		</div>
	</span>
</div>




<div id="bkash_payment2" class="modal" >
	<div class="modal-dialog " style="width:380px;" >
		<div class="modal-content">

			<div class="form-signin">
				<span id="header"><div>
					<div>
						<div class="bkash_image">
							<img src="bkash.gif">
						</div>

						<hr id="itemDiv" class="itemDivider">

						<div id="trxInfo">
							<div id="merchantLogo" style="background-image: url(&quot;https://s3-ap-southeast-1.amazonaws.com/merchantlogo.pay.bka.sh/merchant-default-logo.png&quot;);"></div>
							<div class="infoNameInvoice">
								<span id="merchantName">Work For All</span>
								<div class="infoInvoice">
									<span class="invoiceText">Invoice:</span>
									<span id="merchantInvoice1">INV1651934076378</span>
								</div>
								<span id="merchantInvoice2"></span>

							</div>
							<div class="trxMerchantAmount">
								<span class="merchantAmount">৳ </span><span id="merchantAmountVal"><?php echo $result2['service_salary'] ?></span>
							</div>
						</div>
					</div></span>
					<span id="containerb"><form class="formBody" id="pay_form2">
						<input type="hidden" value="<?php echo $job_id ?>" name="job-id">
						<input type="hidden" value="<?php echo $result2['service_salary'] ?>" name="pay_amount">
						<div id="inputHolder">
							<span for="wallet" class="infoText">Enter varification code sent to 01********</span>
							<input type="text" id="wallet" name="otp" style=" text-align: center;
							border-radius: 0px;
							width: 80%;" class="form-control" font-size="18px" ;="" placeholder="Enter OTP" maxlength="11" autocomplete="off" required="">

							<span class="infoText">Didn't receive code? <b><a href="https://www.bkash.com/terms-of-use-checkout" target="_blank">Resend Code</a></b> </span>

							<div id="error"></div>
						</div>

						<div id="loader_div" style="display: none;">
							<div id="loader_image"></div>
						</div>

						<div id="button_div" class="buttonAction">
							<button type="button" class="bkash_btn"  id="close_button">Close</button>
							<button type="submit" class="bkash_btn" id="submit_button">Confirm</button>

						</div>
					</form></span>
					<span id="footer"><div id="footerItem" style="padding:10px">
						<div id="credit">


							<b id="dialText">*This is a dummy Payment. For Project Only.</b>
						</div>
					</div>
				</div>
			</div>
		</div>
	</span>
</div>
</span>

<div id="bkash_payment_pass" class="modal" >
	<div class="modal-dialog " style="width:380px;" >
		<div class="modal-content">

			<div class="form-signin">
				<span id="header"><div>
					<div>
						<div class="bkash_image">
							<img src="bkash.gif">
						</div>

						<hr id="itemDiv" class="itemDivider">

						<div id="trxInfo">
							<div id="merchantLogo" style="background-image: url(&quot;https://s3-ap-southeast-1.amazonaws.com/merchantlogo.pay.bka.sh/merchant-default-logo.png&quot;);"></div>
							<div class="infoNameInvoice">
								<span id="merchantName">Work For All</span>
								<div class="infoInvoice">
									<span class="invoiceText">Invoice:</span>
									<span id="merchantInvoice1">INV1651934076378</span>
								</div>
								<span id="merchantInvoice2"></span>

							</div>
							<div class="trxMerchantAmount">
								<span class="merchantAmount">৳ </span><span id="merchantAmountVal"><?php echo $result2['service_salary'] ?></span>
							</div>
						</div>
					</div></span>
					<span id="containerb"><form class="formBody" id="pay_form3">
						<input type="hidden" value="<?php echo $job_id ?>" name="job-id">
						<input type="hidden" value="<?php echo $result2['service_salary'] ?>" name="pay_amount">
						<div id="inputHolder">
							<span for="wallet" class="infoText">Enter PIN of your bKash Account number (01*** *** ***)</span>
							<input type="password" id="wallet" name="otp" style=" text-align: center;
							border-radius: 0px;
							width: 80%;" class="form-control" font-size="18px" ;="" placeholder="Enter PIN" maxlength="11" autocomplete="off" required="">

							

							<div id="error"></div>
						</div>

						<div id="loader_div" style="display: none;">
							<div id="loader_image"></div>
						</div>

						<div id="button_div" class="buttonAction">
							<button type="button" class="bkash_btn"  id="close_button">Close</button>
							<button type="submit" class="bkash_btn" id="submit_button">Confirm</button>

						</div>
					</form></span>
					<span id="footer"><div id="footerItem" style="padding:10px">
						<div id="credit">


							<b id="dialText">*This is a dummy Payment. For Project Only.</b>
						</div>
					</div>
				</div>
			</div>
		</div>
	</span>
</div>
</span>




<div class="modal fade" id="card_pay" >
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Rating And Review</h4>

			</div>
			<div class="modal-body">
				<form method="post" action="action/review-rating-action.php">
					<div class="card-body">
						<div class="row">
							<div class="col-md-6">
								<input type="hidden" name="job_id" value="<?php echo $job_id ?>">
								<div class="form-group">
									<label for="exampleInputEmail1">Rating</label>
									<select class="custom-select form-control" data-placeholder="Type to search cities" name="rating" >
										<option value="1">1 (Very Poor)</option>
										<option value="2">2 (Poor)</option>
										<option value="3">3 (Average)</option>
										<option value="4">4 (Good)</option>
										<option value="5">5 (Very Good)</option>

									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleInputEmail1">Review or Comment</label>
									<textarea class="textarea_input" name="comment"></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<input type="submit" name="insert" id="insert" value="Save" class="btn btn-success" /> 
				</div>
			</div>
		</form>
		<!-- /.modal-content -->
	</div>
</div>
</div>