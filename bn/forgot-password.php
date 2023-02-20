<?php

include ('database/dbconnect.php');

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
	header("location: index.php");
	exit;
}


$err  = "";
$found = 0;

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$enteredEmail = $_POST['email'];
	$sql = "SELECT * FROM employee WHERE emailAddress = '$enteredEmail'";
	if($result = mysqli_query($conn,$sql)){
		if(mysqli_num_rows($result) == 1){
			$found = 1;
		}else{
			$sql2 = "SELECT * FROM employer WHERE emailAddress = '$enteredEmail'";
			if($result2 = mysqli_query($conn,$sql2)){
				if(mysqli_num_rows($result2) == 1){
					$found = 1;
				}
			}
		}
	}

}

if($found){
	$bytes = random_bytes(20);
    $token = bin2hex($bytes);
    $to = $enteredEmail;
    $subject ="Password Recovery Request";
    $body =   '


<!doctype html>
    <html lang="en-US">

    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
        <title>Reset Password Email Template</title>
        <meta name="description" content="Reset Password Email Template.">
        <style type="text/css">
            a:hover {text-decoration: underline !important;}
        </style>
    </head>

    <body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
        <!--100% body table-->
        <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
        >
        <tr>
            <td>
                <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0"
                align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="height:80px;">&nbsp;</td>
                </tr>

                <tr>
                    <td style="height:20px;">&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                        style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                        <tr>
                            <td style="height:40px;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="text-align:center;">
                              <a href="https://rakeshmandal.com" title="logo" target="_blank">
                                <img src="images/lg/logo_final.png" style="height: 60px;"  alt=""> 
                            </a>
                        </td>
                    </tr>
                     <tr>
                    <td style="height:20px;">&nbsp;</td>
                </tr>
                    <tr>
                        <td style="padding:0 35px;">
                            <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;">Reset Password</h1>
                            <span
                            style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
                            <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                                To reset your password click the below button and enter your new password.
                            </p>
                            <a href="http://localhost/project/reset-password.php?token='.$token.'"
                            style="background:#20e277;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;">Reset
                        Password</a>
                    </td>
                </tr>
                <tr>
                    <td style="height:40px;">&nbsp;</td>
                </tr>
            </table>
        </td>
        <tr>
            <td style="height:20px;">&nbsp;</td>
        </tr>
        <tr>
            <td style="text-align:center;">
                <p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">&copy; <strong>Work For All</strong></p>
            </td>
        </tr>
        <tr>
            <td style="height:80px;">&nbsp;</td>
        </tr>
    </table>
</td>
</tr>
</table>
<!--/100% body table-->
</body>

</html>


    ';
    include("email/mail.php");
    mysqli_query($conn, "INSERT INTO `tokens` (tokenNo, email, status) VALUES ('$token','$enteredEmail', 1)");
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
	<title>Recover Password | <?php echo $siteName ?></title>

	<link rel="icon" type="image/png" href="images/fav.png">

	<?php include('includes/stylesheet.php')  ?>
	
</head>
<body>

	


	<?php include('includes/header.php')  ?>

	
	<main class="browse-section">
		<div class="container">
			<div class="row justify-content-md-center">
				<div class="col-md-5">
					<div class="lg_form">
						<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
							<div class="main-heading">
								<div style="text-align: center;">
									
									<span style="vertical-align:middle; font-size: 30px; color: #000000; font-weight: 500;"> Recover Password</span>
								</div>
								
								<div class="line-shape1">
									<img src="images/line.svg" alt="">
								</div>
								<!-- <?php echo $error;  ?> -->
							</div>

							<div class="form-group">
								<label class="label15">Email Address </label>
								<input type="email" class="job-input" name="email" placeholder="Enter Email Address">
							</div>
							
							<button class="lr_btn" type="submit" >Recover</button>
						</form>
						
					</div>
				</div>
			</div>
		</div>
	</main>


	<?php include('includes/footer.php')  ?>


	<button onclick="topFunction()" id="pageup" title="Go to top"><i class="fas fa-arrow-up"></i></button>


	<?php include('includes/js.php')  ?>
</body>










</html>