<?php
include ('database/dbconnect.php');

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

	


	<?php include('includes/header-employee.php')  ?>

	
    

    <main class="browse-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="search_help">
                        <input class="hsrhinput" type="text" placeholder="Search Jobs you like..">
                        <button class="help_btn">Search</button>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 mainpage">
                    <div class="main-tabs">
                       
                           
                            <div class=" mtab-right">
                                <ul>
                                    <li class="sort-list-dt">
                                        <div class="ui selection dropdown skills-search sort-dropdown">
                                            <input name="gender" type="hidden" value="default">
                                            <i class="dropdown icon d-icon"></i>
                                            <div class="text">Sort By</div>
                                            <div class="menu">
                                                <div class="item" data-value="0">Relevance</div>
                                                <div class="item" data-value="1">New</div>
                                                <div class="item" data-value="2">Old</div>
                                                <div class="item" data-value="3">Last 15 Days</div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="grid-list">
                                        <button class="gl-btn" id="grid"><i class="fas fa-th-large"></i></button>
                                        <button class="gl-btn" id="list"><i class="fas fa-th-list"></i></button>
                                    </li>
                                </ul>
                            </div>
                        
                        <div class="prjoects-content">
                            <div class="row  view-group" id="products">


                                <?php
                                $sql = "SELECT *, job_posts.id as jid FROM job_posts JOIN employer ON job_posts.email = employer.emailAddress";
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
                                                            <div class="job-price">৳ <?php echo $row['jobSalary'] ?> / <?php echo $row['jobSalaryMethod'] ?></div>
                                                        </div>
                                                    </div>

                                                    <div class="job-des-dt">
                                                        <h4><?php echo $row['jobTitle'] ?></h4>
                                                        <p><?php echo $row['jobDescription'] ?></p>


                                                    </div>
                                                    <div class="job_des">
                                                        <div class="job_type">
                                                             <i class="fa fa-calendar"></i> Apply Deadline : <span><?php echo $row['jobDeadline'] ?></span>

                                                        </div>

                                                        <div class="job_type_right">
                                                            <i class="fa fa-briefcase"></i> Category : <span><?php echo $row['serviceCategory'] ?></span>
                                                        </div>

                                                    </div>
                                                    <div class="job-buttons">
                                                        <ul class="link-btn">
                                                            <li><a href="#" class="link-j1" title="Apply Now">APPLY NOW</a></li>
                                                            <li><a href="view-job.php?id=<?php echo $row['jid']?>" class="link-j1" title="View Job">View Job</a></li>
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
                                
                                <div class="col-12">
                                    <div class="main-p-pagination">
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination">
                                                <li class="page-item">
                                                    <a class="page-link" href="#" aria-label="Previous">
                                                        PREV
                                                    </a>
                                                </li>
                                                <li class="page-item"><a class="page-link active" href="#">1</a></li>
                                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                <li class="page-item"><a class="page-link" href="#">...</a></li>
                                                <li class="page-item"><a class="page-link" href="#">24</a></li>
                                                <li class="page-item">
                                                    <a class="page-link" href="#" aria-label="Next">
                                                        NEXT
                                                    </a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
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