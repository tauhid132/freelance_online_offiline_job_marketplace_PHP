<?php
include ('database/dbconnect.php');
session_start();
$id = $_GET['id'];
$query=mysqli_query($conn,"SELECT * FROM employee  WHERE id = '$id';");
$result=mysqli_fetch_array($query);
$logged_in = 0;
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
	<title>View Profile | Work for All</title>

	<link rel="icon" type="image/png" href="images/fav.png">

	<?php include('includes/stylesheet.php')  ?>
	
</head>
<body>

	


	<?php include('includes/header-employee.php')  ?>

	


 <main class="browse-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4">
                <div class="account_dt_left">
                    <div class="job-center-dt">
                        <img src="<?php echo $url?>/<?php echo $result['imageLink']?>" alt="">
                        <div class="job-urs-dts">
                          <?php
                          if ($result['profileStatus'] == 1){
                            echo ' <h4>'.$result['fullName'].' <i class="fas fa-check-circle verified_sign"></i></h4>';
                        }else{
                            echo ' <h4>'.$result['fullName'].' <i class="fas fa-times-circle unverified_sign"></i></h4>';

                        }
                        ?>
                        <span><?php echo $result['profession']?></span>
                        <div class="exp145 text-center mt-2">
                            Joined : <span><?php echo $result['joinDate']?></span>
                        </div>
                    </div>
                    <ul class="user_btns">
                        <li><a href="employer/view-messages.php?email=<?php echo $result['emailAddress'] ?>"><button class="hire_btn msg_btn" type="button"><i class="fa fa-envelope-o"></i> Message</button></a></li>
                    </ul>
                </div>
                <!-- <div class="my_websites">
                    <ul>
                        <li><a href="#" class="web_link"><i class="fas fa-globe"></i>www.companysite.com</a></li>
                        <li><a href="#" class="web_link"><i class="far fa-edit"></i>www.blogsite.com</a></li>
                    </ul>
                </div> -->
                
                <div class="rlt_section">
                    <div class="rtl_left">
                        <h6>Rating</h6>
                    </div>
                    <div class="rtl_right">
                        <div class="star">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span>4.9</span>
                        </div>
                    </div>
                </div>
                <div class="rlt_section">
                    <div class="rtl_left">
                        <h6>Location</h6>
                    </div>
                    <div class="rtl_right">
                        <span><i class="fas fa-map-marker-alt lc_icon"></i> <?php echo $result['district']?>, <?php echo $result['country']?></span>
                    </div>
                    <div class="my_location">
                        <div id="map"></div>
                    </div>

                </div>
                
            </div>
        </div>
        <div class="col-lg-9 col-md-8 mainpage">

            <div class="view_chart">
                <div class="view_chart_header">
                    <h4>About</h4>
                </div>
                <div class="view_chart_body">
                    <p class="user_about_des"><?php echo $result['intro']?></p>
                </div>
            </div>
            <div class="view_chart">
                <div class="view_chart_header">
                    <h4>Services</h4>
                </div>
                <div class="view_chart_body">
                    <table class="table">
                      <thead class="bg-info">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Service Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Details</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php
                       $email = $result['emailAddress'];
                       $i = 1;
                       $sql2 = "SELECT * FROM service_portfolio WHERE employee_email = '$email'";
                       if($result2 = mysqli_query($conn, $sql2)){
                        if(mysqli_num_rows($result2) > 0){
                            while($row = mysqli_fetch_array($result2)){


                                ?>
                                <tr>
                                  <th scope="row"><?php echo $i ?></th>
                                  <td><?php echo $row['service_name'] ?></td>
                                  <td><?php echo $row['service_category'] ?></td>
                                  <td><a href="view-job-details.php?id=<?php echo $row['id'] ?>"><button class="btn btn-primary btn-sm">View</button></a></td>
                              </tr>
                              
                               <?php
                               $i++;
                            }

                        }
                    } 
                    ?>
                          </tbody>
                      </table>
                  </div>
              </div>
              <div class="view_chart">
                <div class="view_chart_header">
                    <h4 class="mt-1">All Reviews</h4>
                    <div class="review_right">

                    </div>
                </div>

                <div class="job_bid_body">
                    <ul class="all_applied_jobs jobs_bookmarks">
                        <?php
                        $email = $result['emailAddress'];

                        $sql = "SELECT * FROM hire_employee Join employer on hire_employee.employerEmail = employer.emailAddress WHERE jobStatus = 2 and hire_employee.employeeEmail = '$email'";
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
</div>
</div>
</main>

<?php include('includes/footer.php')  ?>


<button onclick="topFunction()" id="pageup" title="Go to top"><i class="fas fa-arrow-up"></i></button>


<?php include('includes/js.php')  ?>
</body>

<script type="text/javascript">
    $(document).ready(function(){
        $('.msg_btn').click(function(){   
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
</script>

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


<!-- Mirrored from gambolthemes.net/html-items/jobby/jobby-medical/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 16 Mar 2022 15:40:23 GMT -->
</html>