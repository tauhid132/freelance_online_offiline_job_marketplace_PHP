<?php
include ('../database/dbconnect.php');
session_start();

$email = $_SESSION['email'];
$query=mysqli_query($conn,"SELECT * FROM employer  WHERE emailAddress = '$email';");
$result=mysqli_fetch_array($query);


?>
<!DOCTYPE html>
<html lang="en">


<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, shrink-to-fit=9">
	<meta name="description" content="Gambolthemes">
	<meta name="author" content="Gambolthemes">
	<title>Post a new Job</title>


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q==" crossorigin="anonymous"
  referrerpolicy="no-referrer" />



  <link rel="icon" type="image/png" href="images/fav.png">

  <?php include('../includes/stylesheet.php')  ?>
</head>
<body>


	
	<?php include('../includes/header-employer.php')  ?>

	<main class="browse-section">
		<div class="container">
			<div class="row">
        <?php include('includes/sidebar.php')  ?>
        <div class="col-lg-8 col-md-8 mainpage">
         <div class="account_heading">
          <div class="account_hd_left">
           <h1><i class="fas fa-plus-circle"></i> Create New Job Post</h1>
         </div>
         
       </div>
       <?php include('includes/topbar.php')  ?>
       
       
       <div class="post501">
        <form method="post" action="action/create-job-post-action.php">
          <input type="hidden" name="email" value="<?php echo $_SESSION['email']; ?>">
          <div class="row">
            <div class="col-lg-6">
             <div class="form-group">
              <label class="label15">Job Title</label>
              <input type="text" class="job-input" name="jobTitle" placeholder="Job Title Here">
            </div>
          </div>
          <div class="col-lg-6">
           <div class="form-group">
            <label class="label16">Service Category</label>
            <div class="ui fluid search selection dropdown skills-search">
             <input name="serviceCategory" type="hidden" value="">
             <i class="dropdown icon"></i>
             <input class="search" autocomplete="off" tabindex="0">
             <span class="sizer" style=""></span>
             <div class="default text">Select Category</div>
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
   <div class="col-lg-12">
    <div class="form-group">
      <label class="label15">Job Description</label>
      <textarea class="textarea_input" name="jobDescription" placeholder="Type Description"></textarea>
    </div>
  </div>

  <div class="col-lg-6">
   <div class="form-group">
    <label class="label15">Salary</label>
    <div class="smm_input">
     <input type="text" class="job-input" name="serviceSalary" placeholder="$0.00">
     <div class="mix_max">BDT</div>
   </div>
 </div>
</div>
<div class="col-lg-6">
 <div class="form-group">
  <label class="label16">Salary Method</label>
  <div class="ui fluid search selection dropdown skills-search">
   <input name="serviceSalaryMethod" type="hidden" value="">
   <i class="dropdown icon"></i>
   <input class="search" autocomplete="off" tabindex="0">
   <span class="sizer" style=""></span>
   <div class="default text">Salary Method</div>
   <div class="menu transition hidden" tabindex="-1">
    <div class="item" data-value="Per Service">Per Service</div>
    <div class="item" data-value="Per Hour">Per Hour</div>
    <div class="item" data-value="Per Day">Per Day</div>
  </div>
</div>
</div>
</div>
<div class="col-lg-6">
 <div class="form-group">
  <label class="label16">Job Type</label>
  <div class="ui fluid search selection dropdown skills-search">
   <input name="jobWorkingType" type="hidden" value="">
   <i class="dropdown icon"></i>
   <input class="search" autocomplete="off" tabindex="0">
   <span class="sizer" style=""></span>
   <div class="default text">Select Job Type</div>
   <div class="menu transition hidden" tabindex="-1">
    <div class="item" data-value="Online">Online</div>
    <div class="item" data-value="Offline">Offline</div>
  </div>
</div>
</div>
</div>
<div class="col-lg-6">
 <div class="form-group">
  <label class="label15">Job Deadline</label>
  <input class="form-control" id="date1" name="jobDeadline" type="date">
</div>
</div>
<!-- <div class="col-lg-6">
 <div class="form-group">
  <label class="label15">Job Type</label>
  <div class="ui fluid search selection dropdown skills-search">
   <input name="jobExperience" type="hidden" value="">
   <i class="dropdown icon"></i>
   <input class="search" autocomplete="off" tabindex="0">
   <span class="sizer" style=""></span>
   <div class="default text">Choose Job Type</div>
   <div class="menu transition hidden" tabindex="-1">
    <div class="item selected" data-value="Full Time">Full Time</div>
    <div class="item selected" data-value="Part Time">Part Time</div>
    <div class="item selected" data-value="Flexible">Flexible</div>
  </div>
</div>
</div>
</div> -->

<div class="col-lg-6">
 <div class="form-group">
  <label class="label16">Experience Level (Optional)</label>
  <div class="ui fluid search selection dropdown skills-search">
   <input name="jobExperience" type="hidden" value="">
   <i class="dropdown icon"></i>
   <input class="search" autocomplete="off" tabindex="0">
   <span class="sizer" style=""></span>
   <div class="default text">Select Experience</div>
   <div class="menu transition hidden" tabindex="-1">
    <div class="item" data-value="0-1 Years">0-1 Years</div>
    <div class="item" data-value="0-1 Years">1-2 Years</div>
    <div class="item" data-value="0-1 Years">2-3 Years</div>
  </div>
</div>
</div>
</div>



<div class="col-lg-12">
 <button class="post_jp_btn" type="submit">Post Job</button>
</div>
</div>
</form>
</div>


</div>
</div>
</div>
</div>
</main>


<?php include('../includes/footer.php')  ?>


<button onclick="topFunction()" id="pageup" title="Go to top"><i class="fas fa-arrow-up"></i></button>


<?php include('../includes/js.php')  ?>


<script type="text/javascript">
  $(document).ready(function(){


    $('#areas').change(function(){
      $('#service_area').val($('#areas').val());
    // var query = $('#area_select').val();
    // alert(query);
  });
    
  });
  
</script>




<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Mirrored from gambolthemes.net/html-items/jobby/jobby-medical/hospital_dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 16 Mar 2022 15:41:37 GMT -->
</html>