<?php
// Initialize the session
session_start();
include('../../db/conn.php');


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
	<title>Change Password | Selfcare</title>


<!--[if lt IE 10]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="Admindek Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
	<meta name="keywords" content="flat ui, admin Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
	<meta name="author" content="colorlib" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
<link href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
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
								<i class="feather icon-tag bg-c-blue"></i>
								<div class="d-inline">
									<h5>Change Password</h5>
									
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="page-header-breadcrumb">
								<ul class=" breadcrumb breadcrumb-title">
									<li class="breadcrumb-item">
										<a href="index.html"><i class="feather icon-home"></i></a>
									</li>
									<li class="breadcrumb-item"><a href="#!">Dashboard</a>
									</li>
									<li class="breadcrumb-item"><a href="#!">Change Password</a>
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
											<div class="card-header">
												<h5>Change Password</h5>
												
											</div>
											<div class="card-block">
												<form role="form" method="POST" id="cng_pass" action="action/change-pass-action.php">
													<div class="form-group row">
													<input type="hidden" name="username" class="form-control form-control-normal" value="<?php echo $_SESSION['username'];?>">
														
													</div>
													<div class="form-group row">
														<label class="col-sm-2 col-form-label">New Password*</label>
														<div class="col-sm-6">
															<input type="password" id="pass1" name="new_pass" class="form-control form-control-bold" >
														</div>
													</div>
													<div class="form-group row">
														<label class="col-sm-2 col-form-label">Confirm Password*</label>
														<div class="col-sm-6">
															<input type="password" id="pass2" class="form-control form-control-capitalize">
														</div>
													</div>
													<div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
													
												</form>
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
<script>  
 $(document).ready(function(){  
      
      
	  
	  
      $('#cng_pass').on("submit", function(event){  
           event.preventDefault();  
          
           if($('#pass1').val() != $('#pass2').val())  
           {  
                toastr.error('Password do not match');   
           }  
           
           
           else  
           {  
                $.ajax({  
                     url:"action/cng-pass.php",  
                     method:"POST",  
                     data:$('#cng_pass').serialize(),  
                     beforeSend:function(){  
                          
                     },  
                     success:function(data){  
                          $('#cng_pass')[0].reset();  
                          
                          toastr.success('Password Changed Successfully!'); 
                         
                     }  
                });  
           }  
      });  
      
      
 });  
 </script>			
<script type="bc9e5e682d42f376717182ab-text/javascript" src="js/notification.js"></script>
<script type="d28fd8086f5eb18f81d8672a-text/javascript" src="js/modal.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


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


<?php include('../../includes/js.php'); ?>
</body>

<!-- Mirrored from colorlib.com/polygon/admindek/default/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 12 Dec 2019 16:08:25 GMT -->
</html>
