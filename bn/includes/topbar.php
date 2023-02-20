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
											<a class="link-item" href="#"><img src="images/flagbd.svg" style="height: 20px; width: 20px; float: left; margin-right: 5px;">   বাংলা</a>
											<a class="link-item" href="#"><img src="images/usflag.svg" style="height: 20px; width: 20px; float: left; margin-right: 5px;">   English</a>
											
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
										<!-- <div class="user-request-list">
											<div class="request-users">
												<div class="user-request-dt">
													<a href="#"><img src="images/user-dp-1.jpg" alt="">
														<div class="user-title1">Jassica William </div>
														<span>Hey How are you John Doe...</span>
													</a>
												</div>
												<div class="time5">2 min ago</div>
											</div>
										</div>
										<div class="user-request-list">
											<div class="request-users">
												<div class="user-request-dt">
													<a href="#"><img src="images/banner1.jpg" alt="">
														<div class="user-title1">Rock Smith </div>
														<span>Interesting Job! I will join this...</span>
													</a>
												</div>
												<div class="time5">5 min ago</div>
											</div>
										</div>
										<div class="user-request-list">
											<div class="request-users">
												<div class="user-request-dt">
													<a href="#"><img src="images/user-dp-1.jpg" alt="">
														<div class="user-title1">Joy Doe </div>
														<span>Hey Sir! What about you...</span>
													</a>
												</div>
												<div class="time5">10 min ago</div>
											</div>
										</div>
										<div class="user-request-list">
											<a href="hospital_messages.html" class="view-all">View All Messages</a>
										</div>
									</div> -->
								</li>
								<li class="dropdown">
									<a href="#" class="icon14 dropdown-toggle-no-caret" role="button" data-toggle="dropdown">
										<i class="fas fa-bell"></i><div class="circle-alrt"></div>
									</a>
									<div class="dropdown-menu message-dropdown dropdown-menu-right">
										<!-- <div class="user-request-list">
											<div class="request-users">
												<div class="user-request-dt">
													<a href="#">
														<div class="noti-icon"><i class="fas fa-users"></i></div>
														<div class="user-title1">Rock William </div>
														<span>applied for a <ins class="noti-p-link">Job Name</ins>.</span>
													</a>
												</div>
											</div>
										</div>
										<div class="user-request-list">
											<div class="request-users">
												<div class="user-request-dt">
													<a href="#">
														<div class="noti-icon"><i class="fas fa-bullseye"></i></div>
														<div class="user-title1">Johnson Smith</div>
														<span>Booked a Appointment <ins class="noti-p-link">ID 122254</ins></span>
													</a>
												</div>
											</div>
										</div>
										<div class="user-request-list">
											<div class="request-users">
												<div class="user-request-dt">
													<a href="#">
														<div class="noti-icon"><i class="fas fa-exclamation"></i></div>
														<span class="pt-2">Your job listing <ins class="noti-p-link">Dentist Doctor</ins> is expiring.</span>
													</a>
												</div>
											</div>
										</div>
										<div class="user-request-list">
											<a href="hospital_notifications.html" class="view-all">View All Notifications</a>
										</div>
									</div> -->
								</li>

								<li>
									<div class="account order-1 dropdown">
										<a href="#" class="account-link dropdown-toggle-no-caret" role="button" data-toggle="dropdown">
											<?php
											if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
												echo '<a href="login.php" class="account-link >';
												echo '<span class=""><i class="fa fa-sign-in"> LOGIN</i> </span>';
											}else{
												echo '
												<div class="user-dp"><img src="'.$url.'/'.$_SESSION['imageLink'].'" alt=""></div>
												<span>'.$_SESSION['fullName'].'</span>
												
												';

												if($_SESSION['userType'] == 1){
												echo '<i class="fas fa-sort-down"></i>
												<div class="dropdown-menu account-dropdown dropdown-menu-right">
												<a class="link-item" href="'.$url.'/employee/dashboard.php"><i class="fa fa-tachometer"></i> Dashboard</a>
												
												<a class="link-item" href="'.$url.'/logout.php"><i class="fa fa-sign-out"></i> Logout</a>
												</div>';
											}else{
												echo '<i class="fas fa-sort-down"></i>
												<div class="dropdown-menu account-dropdown dropdown-menu-right">
												<a class="link-item" href="'.$url.'/employer/dashboard.php"><i class="fa fa-tachometer"></i> Dashboard</a>
												
												<a class="link-item" href="'.$url.'/logout.php"><i class="fa fa-sign-out"></i> Logout</a>
												</div>';
											}
												

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