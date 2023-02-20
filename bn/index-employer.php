<?php
include ('database/dbconnect.php');

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
	$logged_in = 0;
}else{
	$logged_in = 1;
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
	<link href="https://fonts.maateen.me/adorsho-lipi/font.css" rel="stylesheet">

	<?php include('includes/stylesheet.php')  ?>
	
</head>
<body>

	<style type="text/css">
		#particles-js{
			position: relative;

			background-color: #b3d9ff;
			
		}
	</style>


	<?php
	if($logged_in == 0){
		include('includes/header.php');
	}else{
		include('includes/header-employer.php');
	}
	?>
	

	<main class="body-section">
		<div class="banner_single version_4">
			<div class="wrapper">
				<div class="container">
					<div class="row justify-content-md-center">
						<div class="col-md-10"  >
							<form method="get" action="services.php">
								<div class="banner_text">
									<!-- <h2>Labour JOB Marketplace in Bangladesh </h2> -->
								</div>
								<div class="banner_form" >
									<div class="row">
										<div class="col-xl-5 col-lg-4">
											<div class="form-group">
												
												<div class="ui fluid search selection dropdown skills-search">
													<div class="loc_icon"><i class="fas fa-map-marker-alt"></i></div>
													<input name="area" type="hidden" value="">
													<!-- <i class="dropdown icon"></i> -->
													<input class="search" autocomplete="off" tabindex="0">
													<span class="sizer" style=""></span>
													<div class="default text">আপনার লোকেশান নির্বাচন করুন</div>
													<div class="menu transition hidden" tabindex="-1">
														<?php
														$sql = "SELECT * FROM operation_area";
														if($result = mysqli_query($conn, $sql)){
															if(mysqli_num_rows($result) > 0){
																while($row = mysqli_fetch_array($result)){
																	echo '<div class="item" data-value="'.$row['policeStation'].'">'.$row['policeStation'].'</div>';
																}
															}
														}
														?>

														
													</div>
												</div>
											</div>
										</div>
										<div class="col-xl-5 col-lg-5">
											<div class="form-group">
												<div class="ui fluid search selection dropdown skills-search">

													<input name="category" type="hidden" value="">
													<div class="loc_icon"><i class="fas fa-user"></i></div>
													<!-- <i class="dropdown icon"></i> -->
													<input class="search" autocomplete="off" tabindex="0">
													<span class="sizer" style=""></span>
													<div class="default text"> সার্ভিস
													 নির্বাচন করুন</div>
													<div class="menu transition hidden" tabindex="-1">
														<?php
														$sql = "SELECT * FROM service_categories";
														if($result = mysqli_query($conn, $sql)){
															if(mysqli_num_rows($result) > 0){
																while($row = mysqli_fetch_array($result)){
																	echo '<div class="item" data-value="'.$row['catName'].'">'.$row['catName'].'</div>';
																}
															}
														}
														?>

														
													</div>
												</div>
											</div>
										</div>
										<div class="col-xl-2 col-lg-3">
											<button class="srch-btn" type="submit"><i class="fas fa-search"></i> খুজুন</button>
										</div>
									</div>
								</form>
							</div>
							<div class="most_searchs">
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		
		<div class="find-lts-jobs">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-12">
						<div class="main-heading">
							<div style="text-align: center;">
								<img style="vertical-align:middle; height: 60px; width: 60px;" src="images/popular.png" alt="">
								<span style="vertical-align:middle; font-size: 30px; color: #000000; font-weight: 500;">জনপ্রিয় সার্ভিস-সমুহ
								</span>
							</div>
							<div class="line-shape1">
								<img src="images/line.svg" alt="">
							</div>
						</div>
					</div>
					<div class="col-md-12 col-12">
						<div class="lts-jobs-slider">
							<div class="owl-carousel jobs-owl owl-theme">
								
								<?php
								if($logged_in == 0){
									$sql = "SELECT *, service_portfolio.id as sid, NULL as bid FROM service_portfolio JOIN employee ON employee.emailAddress = service_portfolio.employee_email ";
								}else{
									$email = $_SESSION['email'];
									$sql = "SELECT *, service_portfolio.id as sid, bookmark_service_portfolio.id as bid FROM service_portfolio JOIN employee ON employee.emailAddress = service_portfolio.employee_email left join bookmark_service_portfolio on (service_portfolio.id = bookmark_service_portfolio.service_portfolio) and (bookmark_service_portfolio.email = '$email') ";
								}
								
								if($result = mysqli_query($conn, $sql)){
									if(mysqli_num_rows($result) > 0){
										while($row = mysqli_fetch_array($result)){
											?>
											<div class="item">
												<div class="job-item">
													<div class="job-top-dt">
														<div class="job-left-dt">
															<img src="<?php echo $url ?>/<?php echo $row['imageLink'] ?>" alt="">
															<div class="job-ut-dts">
																<a href="#"><h4><?php echo $row['fullName'] ?></h4></a>
																<span><i class="fas fa-map-marker-alt"></i> <?php echo $row['district'] ?>,<?php echo $row['country'] ?></span>
															</div>
														</div>
														<div class="job-right-dt">
															<div class="job-price">৳ <?php echo $row['service_salary'] ?>/<h5><?php echo $row['service_salary_method'] ?></h5></div>
														</div>
													</div>
													<div class="job-des-dt">
														<h4><?php echo $row['service_name'] ?></h4>
														<p><?php echo $row['service_description'] ?></p>
														<div class="left-rating">
															<div class="rtitle"> Rating </div>
															<div class="star">
																<i class="fas fa-star"></i>
																<i class="fas fa-star"></i>
																<i class="fas fa-star"></i>
																<i class="fas fa-star"></i>
																<i class="fas fa-star"></i>
																<span>5.0</span>
															</div>
														</div>
														<div class="right-location">
															<div class="text-left">
																<div class="verified-text"><i class="fas fa-check-circle"></i> Verified</div>

															</div>
														</div>
													</div>
													<div class="job-buttons">
														<ul class="link-btn">
															<li><a href="view-job-details.php?id=<?php echo $row['sid'] ?>" class="link-j1 success"  title="Apply Now">Job Details</a></li>
															<li><a href="view-job-details.php?id=<?php echo $row['sid'] ?>" class="link-j1" title="View Job">Hire Now!</a></li>
															<li class="bkd-pm">
															<?php 
															if($row['bid'] != NULL){
																?>
																<button class="bookbtn bookmarked" id="<?php echo $row['sid'] ?>" title="bookmark"><i class="fa fa-bookmark"></i></button>

																<?php

															}else{
																?>
																<button class="bookbtn bookmark1" id="<?php echo $row['sid'] ?>" title="bookmark"><i class="fa fa-bookmark"></i></button>
																<?php
															} 
															
															?>
															</li>
														</ul>
													</div>
												</div>
											</div>
											

											<?php
										}
									}
								}
								?>


								
							</div>

						</div>
						<div class="text-center">
							<a href="services.php"><button class="view-links" onclick="window.location.href = '#';"><i class="fa fa-eye"></i>
							আরও সার্ভিস দেখুন</button></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="all-categories">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-12">
					<div class="main-heading">
						<div style="text-align: center;">
							<img style="vertical-align:middle; height: 40px; width: 40px;" src="images/promotion.png" alt="">
							<span style="vertical-align:middle; font-size: 30px; color: #000000; font-weight: 500;"> চাকরির বিভাগ</span>
						</div>
						<div class="line-shape1">
							<img src="images/line.svg" alt="">
						</div>
					</div>
				</div>
				<div class="col-md-12 col-12">
					<div class="lts-jobs-slider">
						<div class="owl-carousel jobs-owl2 owl-theme">
							<?php
							$sql5 = "SELECT * FROM service_categories";
							if($result5 = mysqli_query($conn, $sql5)){
								if(mysqli_num_rows($result5) > 0){
									while($row = mysqli_fetch_array($result5)){
										$catName = $row['catName'];
										$countCat = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM service_portfolio WHERE service_category = '$catName' "));
										?>
										<div class="p-category shadow" style="width:200px">
											<a href="services.php?area=&category=<?php echo $row['catName']; ?>" title="">
												<img src="<?php echo $url ?>/<?php echo $row['imageLink']; ?>" style="height:50px; width:50px;margin-left: 75px;" class="" alt="">
												<span><?php echo $row['catName']; ?></span>
												<p><?php echo $countCat[0]; ?>+ Workers</p>
											</a>
										</div>

										<?php
									}
								}
							}
							?>
							
							
							
						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="featured-candidates mt-5">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-12">
						<div class="main-heading">
							<div style="text-align: center;">
								<img style="vertical-align:middle; height: 60px; width: 60px;" src="images/top-rated.png" alt="">
								<span style="vertical-align:middle; font-size: 30px; color: #000000; font-weight: 500;">শীর্ষ  কর্মচারী সমুহ</span>
							</div>
							<!-- <img src="images/top-rated.png" style="height: 60px; width: 60px; float:relative"></i><h2>Top Rated Employees</h2> -->
							<!-- <span>Discover, Intelligent, Experienced, Professional, Trustworthy, Profiles &amp; Hospitals</span> -->
							<div class="line-shape1">
								<img src="images/line.svg" alt="">
							</div>
						</div>
					</div>
					<div class="col-md-12 col-12">
						<div class="lts-jobs-slider">
							<div class="owl-carousel jobs-owl owl-theme">
								<?php
								$sql = "SELECT * FROM employee";
								if($result = mysqli_query($conn, $sql)){
									if(mysqli_num_rows($result) > 0){
										while($row = mysqli_fetch_array($result)){

											?>
											<div class="item">
												<div class="job-item">
													<div class="job-top-dt1 text-center">
														<div class="job-center-dt">
															<img src="<?php echo $url ?>/<?php echo $row['imageLink'] ?>" alt="">
															<div class="job-urs-dts">
																<a href="#"><h4><?php echo $row['fullName'] ?></h4></a>
																<span><?php echo $row['profession'] ?></span>
																<div class="exp145 top-rated text-center mt-2">
																	<span class=""><i class="fa fa-star"></i> Top Rated</span>
																</div>
															</div>
														</div>
													</div>
													<div class="rating-location">
														<div class="left-rating">
															<div class="rtitle">Rating</div>
															<div class="star">
																<i class="fas fa-star"></i>
																<i class="fas fa-star"></i>
																<i class="fas fa-star"></i>
																<i class="fas fa-star"></i>
																<i class="fas fa-star"></i>
																<span>4.9</span>
															</div>
														</div>
														<div class="right-location">
															<div class="text-left">
																<div class="rtitle">Location</div>
																<span><i class="fas fa-map-marker-alt"></i> New York City</span>
															</div>
														</div>
													</div>
													<div class="job-buttons">
														<ul class="link-btn">
															<li><a href="other_doctor_profile.html" class="link-j1" title="View Profile">View Profile</a></li>
															<li><a href="#" class="link-j1" title="Hire Me">Message</a></li>
															<li class="bkd-pm"><button class="bookmark1" title="bookmark"><i class="fas fa-heart"></i></button></li>
														</ul>
													</div>
												</div>
											</div>
											<?php
										}
									}
								}
								?>




							</div>
							<div class="text-center">
								<button class="view-links" onclick="window.location.href = '#';"><i class="fa fa-eye"></i> View More</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="we-offers">
			<div class="container">
				<div class="row">
					<?php
					$countEmployer = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM employer")); 
					$countEmployee = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM employee"));
					$countJob = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM service_portfolio")); 
					$countHire = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM hire_employee"));
					?>
					<div class="col-lg-3 col-md-6 col-12">
						<div class="offer-step">
							<div class="offer-text-dt">
								<h1><span class="stat-count"><?php echo $countEmployer[0]?></span>+</h1>
								<h2><i class="fa fa fa-user-o"></i> Employer</h2>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-12">
						<div class="offer-step">
							<div class="offer-text-dt">
								<h1><span class="stat-count"><?php echo $countEmployee[0]?></span>+</h1>
								<h2><i class="fa fa fa-user-o"></i> Employee</h2>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-12">
						<div class="offer-step">
							<div class="offer-text-dt">
								<h1><span class="stat-count"><?php echo $countJob[0]?></span>+</h1>
								<h2><i class="fa fa fa-briefcase"></i> Jobs</h2>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-12">
						<div class="offer-step">
							<div class="offer-text-dt">
								<h1><span class="stat-count"><?php echo $countHire[0]?></span>+</h1>
								<h2><i class="fa fa fa-check"></i> Hired</h2>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>




		<!-- <div class="all-categories">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-12">
						<div class="rsgfree125">
							<h4>Looking &amp; Post Your Jobs!</h4>
							<p>Free Sign Up, Job Posting &amp Resume Posting is Absolutely Free!</p>
							<button class="rsbtn14" onclick="window.location.href = 'sign_up.html';">Register Now</button>
						</div>
					</div>
				</div>
			</div>
		</div> -->
		<!-- <div class="blog_sec21">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-12">
						<div class="main-heading">
							<h2>Our Blog</h2>
							<span>Latest News and Resources</span>
							<div class="line-shape1">
								<img src="images/line.svg" alt="">
							</div>
						</div>
					</div>
					<div class="col-xl-4 col-lg-6 col-md-6">
						<div class="blog_item">
							<div class="blog_img1">
								<img src="images/homepage/blog/img-1.jpg" alt="">
							</div>
							<div class="blog_dt1">
								<div class="blog_body">
									<div class="blog_left">
										<p>By <a href="#">John Doe</a></p>
									</div>
									<div class="blog_right">
										<span>2 October 2018</span>
									</div>
									<h4>Quisque non ipsum at lacus luctus volutpat id ac odio.</h4>
									<p>Mauris sit amet lacus vel purus facilisis cursus sed dignissim dolor. Proin at accumsan augue...</p>
									<a href="blog_single_view.html" class="read_btn">Read More</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-4 col-lg-6 col-md-6">
						<div class="blog_item">
							<div class="blog_img1">
								<img src="images/homepage/blog/img-2.jpg" alt="">
							</div>
							<div class="blog_dt1">
								<div class="blog_body">
									<div class="blog_left">
										<p>By <a href="#">John Doe</a></p>
									</div>
									<div class="blog_right">
										<span>2 October 2018</span>
									</div>
									<h4>Quisque non ipsum at lacus luctus volutpat id ac odio.</h4>
									<p>Mauris sit amet lacus vel purus facilisis cursus sed dignissim dolor. Proin at accumsan augue...</p>
									<a href="blog_single_view.html" class="read_btn">Read More</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-4 col-lg-6 col-md-6">
						<div class="blog_item">
							<div class="blog_img1">
								<img src="images/homepage/blog/img-3.jpg" alt="">
							</div>
							<div class="blog_dt1">
								<div class="blog_body">
									<div class="blog_left">
										<p>By <a href="#">John Doe</a></p>
									</div>
									<div class="blog_right">
										<span>2 October 2018</span>
									</div>
									<h4>Quisque non ipsum at lacus luctus volutpat id ac odio.</h4>
									<p>Mauris sit amet lacus vel purus facilisis cursus sed dignissim dolor. Proin at accumsan augue...</p>
									<a href="blog_single_view.html" class="read_btn">Read More</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> -->
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
		$(".login_btn_test").click(function(){
			$("#dataModal").modal('show');
		});
	});

	$('#insert_form').on("submit", function(event){  
		event.preventDefault(); 
     //alert("HEE"); 

     if($('#pay_method').val() == '')  
     {  
     	alert("Please Select payment method!");  
     }


     else  
     {  
     	$.ajax({  
     		url:"action/update-bill.php",  
     		method:"POST",  
     		data:$('#insert_form2').serialize(),  
     		beforeSend:function(){  
     			$('#insert2').val("Updating");
     			alert("hhh");  
     		},  
     		success:function(data){  
     			$('#insert_form2')[0].reset();  
     			$('#edit_bill_Modal').modal('hide');  
     			$('#insert2').val("Update");

        //dataTable.ajax.reload();  
    }  
}); 
     }  
 });
</script>

<script>
	$(document).ready(function(){
		$("#job-search-box").keyup(function(){
			$.ajax({
				type: "POST",
				url: "category-search.php",
				data: {selectedNas:$(this).val()},
		//data:'keyword='+$(this).val(),
		beforeSend: function(){
			//$("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#search-box").css("background","#FFF");
		}
	});
		});
	});

	$(document).ready(function(){
		$(".bookbtn").click(function(){
			var id = $(this).attr("id");
			val = '<?php echo $logged_in; ?>';
			
			if(val == 0){
				event.preventDefault();
				Swal.fire({
					icon: 'error',
					title: 'Please Login',
					// text: 'Something went wrong!',
					// footer: '<a href="">Why do I have this issue?</a>'
				})
			}else{
				$(this).toggleClass('bookmark1');
				$(this).toggleClass('bookmarked'); 
				$.ajax({
					type: "POST",
					url: "action/bookmark.php",
					data: {sid:id},
					beforeSend: function(){
					},
					success: function(data){

					}
				});
			}
		});
	});
	


	$(function() {
		function count($this){
			var current = parseInt($this.html(), 10);
			current = current + 1; /* Where 50 is increment */

			$this.html(++current);
			if(current > $this.data('count')){
				$this.html($this.data('count'));
			} else {    
				setTimeout(function(){count($this)}, 5);
			}
		}        

		$(".stat-count").each(function() {
			$(this).data('count', parseInt($(this).html(), 10));
			$(this).html('0');
			count($(this));
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

<!-- Mirrored from gambolthemes.net/html-items/jobby/jobby-medical/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 16 Mar 2022 15:40:23 GMT -->
</html>