<?php
include ('database/dbconnect.php');
session_start();
$area = '';
$category = '';
if(isset($_GET['area']) && isset($_GET['category'])){
    $area = $_GET['area'];
    $category = $_GET['category'];
}
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
	<title>Home | Work for All</title>

	<link rel="icon" type="image/png" href="images/fav.png">

	<?php include('includes/stylesheet.php')  ?>
	
</head>
<body>

	


	<?php include('includes/header.php')  ?>



</div>


<main class="browse-section">
    <div class="container">
        <div class="col-md-12 search_box">



            <div class="col-md-12"  >
                <form method="get" action="services.php">

                    <div class="row">
                        <div class="col-xl-5 col-lg-4">
                            <div class="form-group">

                                <div class="ui fluid search selection dropdown skills-search">
                                    <div class="loc_icon"><i class="fas fa-map-marker-alt"></i></div>
                                    <input name="area" type="hidden" value="">
                                    <!-- <i class="dropdown icon"></i> -->
                                    <input class="search" autocomplete="off" tabindex="0">
                                    <span class="sizer" style=""></span>
                                    <div class="default text">Choose Location</div>
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
                                    <div class="default text">Choose Service</div>
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
                            <button class="btn btn-info" type="submit"><i class="fas fa-search"></i> Search</button>
                        </div>

                    </form>


                </div>
            </form>
        </div>
    </div>



    <div class="row">

        <div class="col-lg-12 col-md-12 mainpage">
            <div class="main-tabs">


                <div class=" mtab-right">
                    <ul>

                        <li class="grid-list">
                            <button class="gl-btn" id="grid"><i class="fas fa-th-large"></i></button>
                            <button class="gl-btn" id="list"><i class="fas fa-th-list"></i></button>
                        </li>
                    </ul>
                </div>

                <div class="prjoects-content">
                    <div class="row  view-group" id="products">

                        <?php
                        $sql = "SELECT *, service_portfolio.id as sid FROM service_portfolio JOIN employee ON employee.emailAddress = service_portfolio.employee_email 
                        WHERE
                        service_portfolio.service_category like '%{$category}%'

                        ";
                        if($logged_in == 0){
                            $sql = "SELECT *, service_portfolio.id as sid, NULL as bid FROM service_portfolio JOIN employee ON employee.emailAddress = service_portfolio.employee_email WHERE
                        service_portfolio.service_category like '%{$category}%' ";
                        }else{
                            $email = $_SESSION['email'];
                            $sql = "SELECT *, service_portfolio.id as sid, bookmark_service_portfolio.id as bid FROM service_portfolio JOIN employee ON employee.emailAddress = service_portfolio.employee_email left join bookmark_service_portfolio on (service_portfolio.id = bookmark_service_portfolio.service_portfolio) and (bookmark_service_portfolio.email = '$email') ";
                        }
                        if($result = mysqli_query($conn, $sql)){
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_array($result)){
                                    ?>

                                    <div class="lg-item col-lg-6 col-xs-6 grid-group-item1">
                                        <div class="job-item mt-30">
                                            <div class="job-top-dt">
                                                <div class="job-left-dt">
                                                    <img src="<?php echo $url ?>/<?php echo $row['imageLink'] ?>" alt="">
                                                    <div class="job-ut-dts">
                                                        <a href="#"><h4><?php echo $row['fullName'] ?></h4></a>
                                                        <span><i class="fas fa-map-marker-alt"></i> <?php echo $row['district'] ?>, <?php echo $row['country'] ?></span>
                                                    </div>
                                                </div>
                                                <div class="job-right-dt">
                                                    <div class="job-price">৳ <?php echo $row['service_salary'] ?></div>
                                                </div>
                                            </div>
                                            <?php
                                            $service_id = $row['sid'];
                                            $sum_rating = mysqli_fetch_array(mysqli_query($conn, "SELECT avg(jobRating) FROM hire_employee where servicePortfolioId = '$service_id' and jobStatus = 1")); 
                                            $count_review = mysqli_fetch_array(mysqli_query($conn, "SELECT count(*) FROM hire_employee where servicePortfolioId = '$service_id' and jobStatus = 1"));
                                            ?>
                                            <div class="job-des-dt">
                                                <h4><?php echo $row['service_name'] ?></h4> <span class="label label-success"><?php echo $row['service_working_type'] ?> Job</span>
                                                <p><?php echo $row['service_description'] ?></p>
                                                <div class="left-rating">
                                                    <div class="rtitle">Rating</div>
                                                    <div class="star">
                                                        <?php
                                                        for($i=0; $i<$sum_rating[0]; $i++){
                                                            echo '<i class="fas fa-star"></i>';
                                                        }  
                                                        ?>

                                                        <span><?php echo round($sum_rating[0]) ?></span>

                                                    </div>
                                                    (<?php echo $count_review[0] ?> Reviews)
                                                </div>
                                                <div class="right-location">
                                                    <div class="text-left">
                                                        <div class="verified-text"><i class="fas fa-check-circle"></i> Verified</div>


                                                    </div>
                                                </div>
                                            </div>

                                            <div class="job-buttons">
                                                <ul class="link-btn">
                                                    <li><a href="view-job-details.php?id=<?php echo $row['sid'] ?>" class="link-j1 success"  title="Apply Now"><i class="fa fa-eye"></i> Job Details</a></li>
                                                    <li><a href="view-job-details.php?id=<?php echo $row['sid'] ?>" class="link-j1" title="View Job"><i class="fa fa-check"></i> Hire Now!</a></li>
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