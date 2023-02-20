<header>
	<div class="top-header">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="top-header-full">
						<div class="top-left-hd">
							<ul>
								<li><div class="wlcm-text">Language</div></li>
								<li>
									<div class="lang-icon dropdown">
										<i class="fas fa-globe ln-glb"></i>
										<a href="#" class="icon15 dropdown-toggle-no-caret" role="button" data-toggle="dropdown">
											EN <i class="fas fa-caret-down p-crt"></i>
										</a>
										<div class="dropdown-menu lanuage-dropdown dropdown-menu-left">
											<a class="link-item" href="<?php echo $url ?>/bn"><img src="<?php echo $url ?>/images/flagbd.svg" style="height: 20px; width: 20px; float: left; margin-right: 5px;">   বাংলা</a>
											<a class="link-item" href="<?php echo $url ?>"><img src="<?php echo $url ?>/images/usflag.svg" style="height: 20px; width: 20px; float: left; margin-right: 5px;">   English</a>
											
										</div>
									</div>
								</li>
							</ul>
						</div>
						<div class="top-right-hd">
							<ul>
								<li class="dropdown">
									<a href="#" class="icon14 dropdown-toggle-no-caret" role="button" data-toggle="dropdown">
										<i class="fas fa-envelope"></i><div class="circle-alrt"></div>
									</a>
									<div class="dropdown-menu message-dropdown dropdown-menu-right">
										<?php
										$email = $_SESSION['email'];
										$output = ''; 
										$sql7 = "SELECT * FROM employer WHERE emailAddress IN ((SELECT senderEmail FROM messages WHERE receiverEmail = '$email') UNION (SELECT receiverEmail FROM messages WHERE senderEmail = '$email'))";
										if($result7 = mysqli_query($conn, $sql7)){
											if(mysqli_num_rows($result7) > 0){
												while($row = mysqli_fetch_array($result7)){
													$sender = $row['emailAddress'];
													$query2=mysqli_query($conn,"SELECT * FROM messages WHERE receiverEmail = '$email'  and senderEmail = '$sender' ORDER by timestamp desc  LIMIT 1;");
													$result3=mysqli_fetch_array($query2); 

													$output .='
													<div class="user-request-list">
													<div class="request-users">
													<div class="user-request-dt">
													<a href="#"><img src="'.$url.'/'.$row['imageLink'].'" alt="">
													<div class="user-title1">'.$row['fullName'].'</div>
													<span>'.$result3['text'].'</span>
													</a>
													</div>
													<div class="time5">'.$result3['timestamp'].'</div>
													</div>
													</div>';

												}
											}
										} 
										echo $output;
										?>
										
										<div class="user-request-list">
											<a href="<?php echo $url ?>/employee/view-messages.php" class="view-all">View All Messages</a>
										</div>
									</div>
								</li>
								<li class="dropdown">
									<a href="#" class="icon14 dropdown-toggle-no-caret" role="button" data-toggle="dropdown">
										<i class="fas fa-bell"></i><div class="circle-alrt"></div>
									</a>
									<div class="dropdown-menu message-dropdown dropdown-menu-right">

										<?php
										$sql8 = "SELECT * FROM notifications WHERE email = '$email' order by timestamp desc LIMIT 8";
										if($result8 = mysqli_query($conn, $sql8)){
											if(mysqli_num_rows($result8) > 0){
												while($row = mysqli_fetch_array($result8)){  
													?>
													<div class="user-request-list">
														<div class="request-users">
															<div class="user-request-dt">
																<a href="#">
																	<div class="noti-icon"><i class="fas fa-users"></i></div>
																	<div class="user-title1"><?php echo $row['notification'] ?></div>
																	<span><?php echo $row['timestamp'] ?></span>
																</a>
															</div>
														</div>
													</div>
													<?php
												}
											}
										}  
										?>


										<div class="user-request-list">
											<a href="<?php echo $url ?>/employee/notifications.php" class="view-all">View All Notifications</a>
										</div>
									</div>
								</li>

								<li>
									<div class="account order-1 dropdown">
										<a href="#" class="account-link dropdown-toggle-no-caret" role="button" data-toggle="dropdown">
											<?php
											if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
												echo '<a href="login.php" class="account-link >';
												echo '<span class="">SIGNUP / LOGIN</span>';
											}else{
												echo '
												<div class="user-dp"><img src="'.$url.'/'.$_SESSION['imageLink'].'" alt=""></div>
												<span>'.$_SESSION['fullName'].'</span>
												<i class="fas fa-sort-down"></i>
												<div class="dropdown-menu account-dropdown dropdown-menu-right">
												<a class="link-item" href="'.$url.'/employee/dashboard.php"><i class="fa fa-tachometer"></i> Dashboard</a>
												
												<a class="link-item" href="'.$url.'/employee/view-messages.php"><i class="fa fa-envelope-o"></i> Messages</a>
												<a class="link-item" href="'.$url.'/logout.php"><i class="fa fa-sign-out"></i> Logout</a>
												</div>
												';
												

											}	
											?>
											
											
											<!-- <button class="login_btn"><span class="">SIGNUP / LOGIN</span></button> -->
												<!-- <div class="user-dp"><img src="images/dp.jpg" alt=""></div>
													<span>Hi! Apollo</span> -->
												<!-- <span>SIGNUP / LOGIN</span>
												<i class="fas fa-sort-down"></i>
											</a>
											<div class="dropdown-menu account-dropdown dropdown-menu-right">
												<a class="link-item" href="hospital_dashboard.html">Dashboard</a>
												<a class="link-item" href="hospital_setting.html">Setting</a>
												<a class="link-item" href="hospital_messages.html">My Messages</a>
												<a class="link-item" href="hospital_jobs.html">My Jobs</a>
												<a class="link-item" href="hospital_appointments.html">My Appointments</a>
												<a class="link-item" href="hospital_bookmarks.html">My Bookmarks</a>
												<a class="link-item" href="hospital_payments.html">Payments</a>
												<a class="link-item" href="sign_in.html">Logout</a>
											</div> -->
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="sub-header">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<nav class="navbar navbar-expand-lg navbar-light bg-dark1 justify-content-sm-start">
							<a class="order-1 order-lg-0 ml-lg-0 ml-3 mr-auto" href="<?php echo $url ?>/index.php"><img src="<?php echo $url ?>/images/lg/logo_final.png" style="height: 60px;"  alt=""></a>
							<button class="navbar-toggler align-self-start" type="button">
								<i class="fas fa-bars"></i>
							</button>
							<div class="collapse navbar-collapse d-flex flex-column flex-lg-row flex-xl-row justify-content-lg-end bg-dark1 p-3 p-lg-0 mt1-5 mt-lg-0 mobileMenu" id="navbarSupportedContent">
								<ul class="navbar-nav align-self-stretch">
									<li class="nav-item active">
										<a class="nav-link" href="<?php echo $url ?>/index.php">Home <span class="sr-only">(current)</span></a>
									</li>
									<!-- <li class="nav-item dropdown">
										<a href="#" class="nav-link dropdown-toggle-no-caret" role="button" data-toggle="dropdown">Find Jobs</a>
										<div class="dropdown-menu pages-dropdown">
											<a class="link-item" href="browse_jobs.html">Browse Jobs</a>
											<a class="link-item" href="job_single_view.html">Single Job View</a>
											<a class="link-item" href="post_a_job.html">Post a Job</a>
										</div>
									</li> -->
									<!-- <li class="nav-item dropdown">
										<a href="#" class="nav-link dropdown-toggle-no-caret" role="button" data-toggle="dropdown">Find Profiles</a>
										<div class="dropdown-menu pages-dropdown">
											<a class="link-item" href="browse_profiles.html">Browse Profiles</a>
											<a class="link-item" href="other_doctor_profile.html">Doctor Profile</a>
											<a class="link-item" href="other_patient_profile.html">Patient Profile</a>
										</div>
									</li> -->
									<!-- <li class="nav-item dropdown">
										<a href="#" class="nav-link dropdown-toggle-no-caret" role="button" data-toggle="dropdown">Find Hospitals</a>
										<div class="dropdown-menu pages-dropdown">
											<a class="link-item" href="browse_hospitals.html">Browse Hospitals</a>
											<a class="link-item" href="other_hospital_profile.html">Hospital Profile</a>
										</div>
									</li> -->
									<!-- <li class="nav-item dropdown pages152">
										<a href="#" class="nav-link dropdown-toggle-no-caret" role="button" data-toggle="dropdown">
											Pages <i class="fas fa-caret-down p-crt"></i>
										</a>
										<div class="dropdown-menu pages-dropdown">
											<a class="link-item" href="about.html">About</a>
											<a class="link-item" href="our_blog.html">Our Blog</a>
											<a class="link-item" href="blog_single_view.html">Signle Blog View</a>
											<a class="link-item" href="pricing_plans.html">Pricing Plans</a>
											<a class="link-item" href="checkout.html">Checkout</a>
											<a class="link-item" href="plan_invoice.html">Invoice Slip</a>
											<a class="link-item" href="transaction_invoice.html">Invoice Transaction</a>
											<a class="link-item" href="sign_in.html">Sign in</a>
											<a class="link-item" href="sign_up.html">Sign up</a>
											<a class="link-item" href="sign_up_select_profile.html">Sign up Select Profiles</a>
											<a class="link-item" href="sign_up_doctor_profile.html">Create Doctor Profile</a>
											<a class="link-item" href="sign_up_hospital_profile.html">Create Hospital Profile</a>
											<a class="link-item" href="sign_up_user_profile.html">Create User Profile</a>
											<a class="link-item" href="contact_us.html">Contact</a>
											<a class="link-item" href="help_center.html">Help Center</a> 
										</div>
									</li> -->
									<li class="nav-item dropdown">
										<a href="find-jobs.php" class="nav-link dropdown-toggle-no-caret" r>Find Jobs</a>
										
									</li>
									<li class="nav-item dropdown">
										<a href="faq.php" class="nav-link dropdown-toggle-no-caret" r>FAQ</a>
										
									</li>
								</ul>
								
								
							</div>
							<form action="#" method="get" class="search-form">
								<div class="input-group">
									<input name="search" class="form-control" placeholder="Search..." type="text">
									<span class="input-group-btn">
										<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i> </button>
									</span></div>
								</form>
								<!-- <a href="post_a_job.html" class="add-post">Post a Job</a> -->
							</nav>
							<div class="overlay"></div>
						</div>
					</div>
				</div>
			</div>
		</header>





