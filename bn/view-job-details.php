<?php
include ('database/dbconnect.php');

session_start();
$portfolio_id = $_GET['id'];
$query2=mysqli_query($conn,"SELECT *, service_portfolio.id as sid FROM service_portfolio Join employee on service_portfolio.employee_email = employee.emailAddress WHERE service_portfolio.id = '$portfolio_id'");
$result2=mysqli_fetch_array($query2);

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
	$logged_in = 0;
}
?>
<!DOCTYPE html>
<html lang="en">



<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, shrink-to-fit=9">
	<meta name="description" content="HireNowBD">
	<meta name="author" content="HireNowBD">
	<title>Home | <?php echo $siteName ?></title>

	<link rel="icon" type="image/png" href="images/fav.png">

	<?php include('includes/stylesheet.php')  ?>
	
</head>
<body>

	<style type="text/css">
		#particles-js{
			position: relative;

			background-color: #b3d9ff;

		}
	</style>


	<?php include('includes/header.php')  ?>

	<main class="browse-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 col-md-8">

					<div class="job-item ptrl_2 mt-10" style="padding-bottom: 30px; ">
						<div class="job-top-dt">
							<div class="job-left-dt">
								<img src="<?php echo $url; ?>/<?php echo $result2['imageLink']; ?>" alt="">
								<div class="job-ut-dts">
									<a href="#"><h4><?php echo $result2['fullName']; ?></h4></a>
									<span><i class="fas fa-map-marker-alt"></i> New York City</span>
								</div>
							</div>
							<div class="job-right-dt">
								<div class="job-price"><?php echo $result2['service_salary']; ?>/<?php echo $result2['service_salary_method']; ?></div>
							</div>
						</div>
						<div class="job-des-dt" style="border-bottom: 1px solid #e5e5e5; padding-bottom: 30px;">
							<h4><?php echo $result2['service_name']; ?></h4>
							<p><?php echo $result2['service_description']; ?></p>
						</div>
						<div class="job_dts" style="border-bottom: 1px solid #e5e5e5; padding-bottom: 30px;">
							<h4>Service Details</h4>
							<ul>
								<li>
									<div class="job_dt_1">
										<h6>Service Type</h6>
										<span><?php echo $result2['service_working_type']; ?></span>
									</div>
								</li>
								<li>
									<div class="job_dt_1">
										<h6>Service Available Areas</h6>
										<span><?php echo $result2['service_area']; ?></span>
									</div>
								</li>
								
							</ul>
						</div>
						<br>
						<div class="job_dtss" style="border-bottom: 1px solid #e5e5e5; padding-bottom: 30px;">
							<h4>Skills or Certifications or Demo Works</h4>
							<!-- <ul>
								<li>
									<span>HTML</span>
								</li>
								<li>
									<span>CSS</span>
								</li>
								
							</ul> -->


						</div>
						<br>
						<div class="job_demo " style="border-bottom: 1px solid #e5e5e5; padding-bottom: 30px;">
							
							<ul>
								<?php
								$sql3 = "SELECT * FROM portfolio_image WHERE portfolioId = $portfolio_id";
								if($result3 = mysqli_query($conn, $sql3)){
									if(mysqli_num_rows($result3) > 0){
										while($row = mysqli_fetch_array($result3)){
											echo '<li>
											<img src="'.$url.'/upload/'.$row['imageLink'].'">
											</li>';
										}
									}
								}
								?>
								

								
							</ul>
						</div>

						
						
					</div>
				</div>
				<div class="col-lg-3 col-md-4 mainpage">
					<form id="hire-form" method="post" action="action/offer-a-job-action.php">
						<input type="hidden" name="employer_email" value="<?php echo $_SESSION['email'] ?>">
						<input type="hidden" name="employee_email" value="<?php echo $result2['emailAddress'] ?>">
						<input type="hidden" name="portfolio_id" value="<?php echo $portfolio_id ?>">
						<button class="apply_job_rt3" type="submit" data-toggle="modal" data-target="#applyjobModal"><i class="fa fa-check"></i> Send Job Proposal</button>
					</form>

					<a href="employer/view-messages.php?email=<?php echo $result2['emailAddress'] ?>"><button class="apply_job_rt login_err" type="submit" data-toggle="modal" data-target="#applyjobModal"><i class="fa fa-envelope-o"></i> Message</button></a>
					
				</div>

			</div>

			<div class="row">
				<div class="col-lg-9 col-md-8 mt-20">
					<?php
					$countRating = mysqli_fetch_array(mysqli_query($conn, "SELECT AVG(jobRating) FROM hire_employee where servicePortfolioId = '$portfolio_id' and jobStatus=2"));   
					?>
					<div class="job-item ptrl_2 mt-20 ">
						<div class="view_chart_header">
							<h4 class="mt-1">All Reviews</h4>
							<h4 class="rating_header" style="float:right; font-size: 25px;"><i class="fas fa-star"></i> <?php echo round($countRating[0]) ?> / 5</h4>
						</div>
						
						<ul class="all_applied_jobs jobs_bookmarks">
							<?php
							$sql = "SELECT * FROM hire_employee Join employer on hire_employee.employerEmail = employer.emailAddress WHERE servicePortfolioId = '$portfolio_id' and jobStatus = 2";
							if($result = mysqli_query($conn, $sql)){
								if(mysqli_num_rows($result) > 0){
									while($row = mysqli_fetch_array($result)){
										

										?>

										<li>
											<div class="applied_candidates_item">
												<div class="row">
													<div class="col-xl-7">
														<div class="applied_candidates_dt">
															<div class="candi_img">
																<img src="<?php echo $url ?>/<?php echo $row['imageLink'] ?>" alt="">
															</div>
															<div class="candi_dt">
																<a href="#"><?php echo $row['fullName'] ?></a>

																<div class="rating_candi">Rating
																	<div class="star">
																		<?php 
																		for($i=0; $i<$row['jobRating']; $i++){
																			echo '<i class="fas fa-star"></i>';
																		}
																		?>
																		
																		<span><?php echo $row['jobRating'] ?></span>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="btn_link24 review_user">
													<p><?php echo $row['jobComment'] ?></p>
												</div>
											</div>
										</li>
										<?php
									}
								}
							}
							?>
							
						</ul>

					</div>






				</div>
			</div>
		</main>


		<?php include('includes/footer.php')  ?>


		<button onclick="topFunction()" id="pageup" title="Go to top"><i class="fas fa-arrow-up"></i></button>


		<?php include('includes/js.php')  ?>
	</body>

	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form method="post" id="insert_form">  
					<div class="lg_form">
						<div class="main-heading">
							<h2>SIGN IN</h2>
							<div class="line-shape1">
								<img src="images/line.svg" alt="">
							</div>
						</div>
						<div class="form-group">
							<label class="label15">Email Address*</label>
							<input type="email" class="job-input" placeholder="Enter Email Address">
						</div>
						<div class="form-group">
							<label class="label15">Password*</label>
							<input type="password" class="job-input" placeholder="Enter Password">
						</div>
						<button class="lr_btn" type="submit">Sign in Now</button>
						<div class="done145">
							<div class="done146">
								Need an account?<a href="sign_up.html">Join us Now<i class="fas fa-angle-double-right"></i></a>
							</div>
							<div class="done147">
								<a href="forgot_password.html">Forgot Password?</a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>


	<script>
		$(document).ready(function(){
			$('#hire-form').on("submit", function(event){   
				val = '<?php echo $logged_in; ?>';
				if(val == 0){
					event.preventDefault();
					Swal.fire({
					icon: 'error',
					title: 'Please Login',
					// text: 'Something went wrong!',
					// footer: '<a href="">Why do I have this issue?</a>'
				})
				}


			});
		});
		$(".login_err").click(function(){
			val = '<?php echo $logged_in; ?>';
			if(val == 0){
				event.preventDefault();
				Swal.fire({
					icon: 'error',
					title: 'Please Login',
					// text: 'Something went wrong!',
					// footer: '<a href="">Why do I have this issue?</a>'
				})
			} 
			
		});

		$(document).ready(function(){
			$(".bookmark1").click(function(){
				var id = $(this).attr("id"); 
				$.ajax({
					type: "POST",
					url: "employee/action/bookmark.php",
					data: {sid:id},
					beforeSend: function(){
					},
					success: function(data){

					}
				});
			});
		});





		function selectCountry(val) {
			$("#job_search-box").val(val);
			$("#suggesstion-box").hide();
		}
	</script>



	<div id="dataModal" class="modal fade">  
		<div class="modal-dialog modal-lg">
			<div class="modal-content">  
				<div class="modal-header">
					<h4 class="modal-title">Billing History</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div> 

			</div>  
			<div class="modal-footer">  
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
			</div>  
		</div>  
	</div>  
</div>  

<script src="particles.js"></script>
<script src="app.js"></script>


</html>