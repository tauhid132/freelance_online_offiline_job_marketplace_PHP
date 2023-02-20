<?php
include ('database/dbconnect.php');

session_start();
$job_id = $_GET['id'];
$query2=mysqli_query($conn,"SELECT *, job_posts.id as jid FROM job_posts JOIN employer ON job_posts.email = employer.emailAddress WHERE job_posts.id = '$job_id'");
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
	<title>View Job | <?php echo $siteName ?></title>

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

	<div class="apply_job_form">
		<div class="modal fade" id="applyjobModal" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-jb" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Job Application</h5>
						
					</div>
					<form method="POST" action="action/apply-job-action.php">
						<input type="hidden" name="email" value="<?php echo $_SESSION['email'] ?>">
						<input type="hidden" name="jobPostId" value="<?php echo $job_id ?>">
						<div class="modal-body">
							<div class="jb_frm">
								<!--  <h3>Attach File With CV C Apply by Jobby Profile</h3> -->
								<div class="form_inputs">

                                    <div class="form-group">
                                       <label class="label15">Short Job Proposal</label>
                                       <textarea class="textarea_input" name="proposal"> </textarea>
                                   </div>
                                   <div class="form-group">
                                    <label class="label15">Service Portfolio (*)</label>
                                    <select class="custom-select form-control" data-placeholder="Type to search cities" name="serviceId" >

                                      <?php
                                      $email = $_SESSION['email'];
                                      $sql6 = "SELECT * FROM service_portfolio WHERE employee_email ='$email'";
                                      if($result6 = mysqli_query($conn, $sql6)){
                                        if(mysqli_num_rows($result6) > 0){
                                          while($row = mysqli_fetch_array($result6)){
                                            echo '<option value="'. $row['id'] .'">' . $row['service_name'] . '</option>';
                                        }
                                    }
                                } 
                                ?>
                            </select>
                        </div>
                        <div class="file-form">
                           <input type="file" id="file">
                           <label for="file">Upload File</label>
                           <p>Attach Your CV or Proposal (PDF)</p>
                       </div>
                                <!-- <div class="ui checkbox apply_check">
                                    <input type="checkbox">
                                    <label style="color:#242424 !important;">Apply by Jobby Profile.</label>
                                </div> -->
                                <div class="apply_btn150">
                                	<button class="apply_job50" type="submit">APPLY NOW</button>
                                	<button class="apply_job_close" type="button" data-dismiss="modal">CANCEL</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<main class="browse-section">
	<div class="container">
		<div class="row">
			<div class="col-lg-9 col-md-8">
                    <!-- <div class="view_details">
                        <ul>
                            <li>
                                <div class="vw_items">
                                    <i class="fas fa-eye"></i>
                                    <div class="vw_item_text">
                                        <h6>Views</h6>
                                        <span>135</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="vw_items">
                                    <i class="fas fa-users"></i>
                                    <div class="vw_item_text">
                                        <h6>Applicants</h6>
                                        <span>4</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="vw_items">
                                    <i class="fas fa-briefcase"></i>
                                    <div class="vw_item_text">
                                        <h6>Job Type</h6>
                                        <span>Doctors</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="vw_items">
                                    <i class="far fa-money-bill-alt"></i>
                                    <div class="vw_item_text">
                                        <h6>Salary</h6>
                                        <span>$2599</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="vw_items">
                                    <i class="far fa-clock"></i>
                                    <div class="vw_item_text">
                                        <h6>Post Date</h6>
                                        <span>4 days ago</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div> -->
                    <div class="job-item ptrl_2">
                    	<div class="job-top-dt">
                    		<div class="job-left-dt">
                    			<img src="<?php echo $url ?>/<?php echo $result2['imageLink'] ?>" alt="">
                    			<div class="job-ut-dts">
                    				<a href="#"><h4><?php echo $result2['fullName'] ?></h4></a>
                    				<span><i class="fas fa-map-marker-alt"></i> <?php echo $result2['district'] ?>,<?php echo $result2['country'] ?></span>
                    			</div>
                    		</div>
                    		<div class="job-right-dt">
                    			<div class="job-price"><?php echo $result2['jobSalary'] ?> / <?php echo $result2['jobSalaryMethod'] ?></div>
                    		</div>
                    	</div>
                    	<div class="job-des-dt">
                    		<h4><?php echo $result2['jobTitle'] ?></h4>
                    		<p><?php echo $result2['jobDescription'] ?></p>
                    	</div>
                    	<div class="job_dts">
                    		<h4>Requirements</h4>
                    		<ul>
                    			<li>
                    				<div class="job_dt_1">
                    					<h6>Job Working Type :</h6>
                    					<span><?php echo $result2['jobWorkingType'] ?></span>
                    				</div>
                    			</li>
                    			<li>
                    				<div class="job_dt_1">
                    					<h6>Experience Level :</h6>
                    					<span><?php echo $result2['jobExperience'] ?></span>
                    				</div>
                    			</li>
                    			<li>
                    				<div class="job_dt_1">
                    					<h6>Application Deadline :</h6>
                    					<span><?php echo $result2['jobDeadline'] ?></span>
                    				</div>
                    			</li>

                    		</ul>
                    	</div>
                    	<button class="apply_job" type="button" data-toggle="modal" data-target="#applyjobModal">APPLY NOW</button>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 mainpage">
                	<button class="apply_job_rt mtp_30" type="button" data-toggle="modal" data-target="#applyjobModal">APPLY NOW</button>
                	<div class="bookmark_rt"><button class="bookmark1 mr-3" title="bookmark"><i class="fas fa-heart"></i></button>BOOKMARK</div>
                	<ul class="social-links">
                		<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                		<li><a href="#"><i class="fab fa-twitter"></i></a></li>
                		<li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                		<li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                	</ul>
                </div>
                <!-- <div class="col-12">
                    <div class="find-lts-jobs10 ">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="main-heading">
                                        <h2>Similar Jobs</h2>
                                        <div class="line-shape1">
                                            <img src="images/line.svg" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="lts-jobs-slider">
                                        <div class="owl-carousel jobs-owl owl-theme">
                                            <div class="item">
                                                <div class="job-item">
                                                    <div class="job-top-dt">
                                                        <div class="job-left-dt">
                                                            <img src="images/homepage/latest-jobs/img-1.jpg" alt="">
                                                            <div class="job-ut-dts">
                                                                <a href="#"><h4>John Doe</h4></a>
                                                                <span><i class="fas fa-map-marker-alt"></i> New York City</span>
                                                            </div>
                                                        </div>
                                                        <div class="job-right-dt">
                                                            <div class="job-price">$599</div>
                                                        </div>
                                                    </div>
                                                    <div class="job-des-dt">
                                                        <h4>Nurse</h4>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam cursus pulvinar dolor nec...</p>
                                                        <div class="exp145">
                                                            Experience Level : <span>Intermediate (3 year - 5 year)</span>
                                                        </div>
                                                    </div>
                                                    <div class="job-buttons">
                                                        <ul class="link-btn">
                                                            <li><a href="#" class="link-j1" title="Apply Now">APPLY NOW</a></li>
                                                            <li><a href="job_single_view.html" class="link-j1" title="View Job">View Job</a></li>
                                                            <li class="bkd-pm"><button class="bookmark1" title="bookmark"><i class="fas fa-heart"></i></button></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="job-item">
                                                    <div class="job-top-dt">
                                                        <div class="job-left-dt">
                                                            <img src="images/homepage/latest-jobs/img-2.jpg" alt="">
                                                            <div class="job-ut-dts">
                                                                <a href="#"><h4>Johnson Smith</h4></a>
                                                                <span><i class="fas fa-map-marker-alt"></i> India</span>
                                                            </div>
                                                        </div>
                                                        <div class="job-right-dt">
                                                            <div class="job-price">$458</div>
                                                        </div>
                                                    </div>
                                                    <div class="job-des-dt">
                                                        <h4>Technician</h4>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam cursus pulvinar dolor nec...</p>
                                                        <div class="exp145">
                                                            Experience Level : <span>Intermediate (3 year - 5 year)</span>
                                                        </div>
                                                    </div>
                                                    <div class="job-buttons">
                                                        <ul class="link-btn">
                                                            <li><a href="#" class="link-j1" title="Apply Now">APPLY NOW</a></li>
                                                            <li><a href="job_single_view.html" class="link-j1" title="View Job">View Job</a></li>
                                                            <li class="bkd-pm"><button class="bookmark1" title="bookmark"><i class="fas fa-heart"></i></button></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="job-item">
                                                    <div class="job-top-dt">
                                                        <div class="job-left-dt">
                                                            <img src="images/homepage/latest-jobs/img-3.jpg" alt="">
                                                            <div class="job-ut-dts">
                                                                <a href="#"><h4>Apollo Hospital</h4></a>
                                                                <span><i class="fas fa-map-marker-alt"></i> Australia</span>
                                                            </div>
                                                        </div>
                                                        <div class="job-right-dt">
                                                            <div class="job-price">$2599</div>
                                                        </div>
                                                    </div>
                                                    <div class="job-des-dt">
                                                        <h4>Senior Doctor</h4>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam cursus pulvinar dolor nec...</p>
                                                        <div class="exp145">
                                                            Experience Level : <span>Intermediate (3 year - 5 year)</span>
                                                        </div>
                                                    </div>
                                                    <div class="job-buttons">
                                                        <ul class="link-btn">
                                                            <li><a href="#" class="link-j1" title="Apply Now">APPLY NOW</a></li>
                                                            <li><a href="job_single_view.html" class="link-j1" title="View Job">View Job</a></li>
                                                            <li class="bkd-pm"><button class="bookmark1" title="bookmark"><i class="fas fa-heart"></i></button></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="job-item">
                                                    <div class="job-top-dt">
                                                        <div class="job-left-dt">
                                                            <img src="images/homepage/latest-jobs/img-4.jpg" alt="">
                                                            <div class="job-ut-dts">
                                                                <a href="#"><h4>Joy Smith</h4></a>
                                                                <span><i class="fas fa-map-marker-alt"></i> India</span>
                                                            </div>
                                                        </div>
                                                        <div class="job-right-dt">
                                                            <div class="job-price">$599</div>
                                                        </div>
                                                    </div>
                                                    <div class="job-des-dt">
                                                        <h4>Nurse</h4>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam cursus pulvinar dolor nec...</p>
                                                        <div class="exp145">
                                                            Experience Level : <span>Intermediate (3 year - 5 year)</span>
                                                        </div>
                                                    </div>
                                                    <div class="job-buttons">
                                                        <ul class="link-btn">
                                                            <li><a href="#" class="link-j1" title="Apply Now">APPLY NOW</a></li>
                                                            <li><a href="job_single_view.html" class="link-j1" title="View Job">View Job</a></li>
                                                            <li class="bkd-pm"><button class="bookmark1" title="bookmark"><i class="fas fa-heart"></i></button></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="job-item">
                                                    <div class="job-top-dt">
                                                        <div class="job-left-dt">
                                                            <img src="images/homepage/latest-jobs/img-5.jpg" alt="">
                                                            <div class="job-ut-dts">
                                                                <a href="#"><h4>Jassica William</h4></a>
                                                                <span><i class="fas fa-map-marker-alt"></i> Australia</span>
                                                            </div>
                                                        </div>
                                                        <div class="job-right-dt">
                                                            <div class="job-price">$300</div>
                                                        </div>
                                                    </div>
                                                    <div class="job-des-dt">
                                                        <h4>Optician Specilist</h4>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam cursus pulvinar dolor nec...</p>
                                                        <div class="exp145">
                                                            Experience Level : <span>Intermediate (3 year - 5 year)</span>
                                                        </div>
                                                    </div>
                                                    <div class="job-buttons">
                                                        <ul class="link-btn">
                                                            <li><a href="#" class="link-j1" title="Apply Now">APPLY NOW</a></li>
                                                            <li><a href="job_single_view.html" class="link-j1" title="View Job">View Job</a></li>
                                                            <li class="bkd-pm"><button class="bookmark1" title="bookmark"><i class="fas fa-heart"></i></button></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="job-item">
                                                    <div class="job-top-dt">
                                                        <div class="job-left-dt">
                                                            <img src="images/homepage/latest-jobs/img-6.jpg" alt="">
                                                            <div class="job-ut-dts">
                                                                <a href="#"><h4>Gambolthemes</h4></a>
                                                                <span><i class="fas fa-map-marker-alt"></i> India</span>
                                                            </div>
                                                        </div>
                                                        <div class="job-right-dt">
                                                            <div class="job-price">$600</div>
                                                        </div>
                                                    </div>
                                                    <div class="job-des-dt">
                                                        <h4>Medical Officer</h4>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam cursus pulvinar dolor nec...</p>
                                                        <div class="exp145">
                                                            Experience Level : <span>Intermediate (3 year - 5 year)</span>
                                                        </div>
                                                    </div>
                                                    <div class="job-buttons">
                                                        <ul class="link-btn">
                                                            <li><a href="#" class="link-j1" title="Apply Now">APPLY NOW</a></li>
                                                            <li><a href="job_single_view.html" class="link-j1" title="View Job">View Job</a></li>
                                                            <li class="bkd-pm"><button class="bookmark1" title="bookmark"><i class="fas fa-heart"></i></button></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </main>

    <?php include('includes/footer.php')  ?>


    <button onclick="topFunction()" id="pageup" title="Go to top"><i class="fas fa-arrow-up"></i></button>


    <?php include('includes/js.php')  ?>
</body>







<script>
	$(document).ready(function(){
		$('#hire-form').on("submit", function(event){   
			val = '<?php echo $logged_in; ?>';
			if(val == 0){
				event.preventDefault();
				swal("Please Log in to hire!")
			}


		});
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