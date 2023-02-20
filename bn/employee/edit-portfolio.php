<?php
include ('../database/dbconnect.php');
session_start();

$email = $_SESSION['email'];
$query=mysqli_query($conn,"SELECT * FROM employee  WHERE emailAddress = '$email';");
$result=mysqli_fetch_array($query);

$portfolio_id = $_GET['id'];
$query2=mysqli_query($conn,"SELECT * FROM service_portfolio WHERE id = '$portfolio_id'");
$result2=mysqli_fetch_array($query2);
?>
<!DOCTYPE html>
<html lang="en">


<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, shrink-to-fit=9">
	<meta name="description" content="Gambolthemes">
	<meta name="author" content="Gambolthemes">
	<title>Edit New Portfolio</title>


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q==" crossorigin="anonymous"
  referrerpolicy="no-referrer" />



  <link rel="icon" type="image/png" href="images/fav.png">

  <?php include('../includes/stylesheet.php')  ?>
</head>
<body>


	
	<?php include('../includes/header.php')  ?>

	<main class="browse-section">
		<div class="container">
			<div class="row">
        <?php include('includes/sidebar.php')  ?>
        <div class="col-lg-8 col-md-8 mainpage">
         <div class="account_heading">
          <div class="account_hd_left">
           <h1><i class="fas fa-edit"></i> Edit New Portfolio</h1>
         </div>
         
       </div>
       <?php include('includes/topbar.php')  ?>
       
       
       <div class="post501">
        <form method="post" action="action/update-portfolio-action.php" enctype='multipart/form-data'>
          <input type="hidden" name="id" value="<?php echo $result2['id']; ?>">
          <div class="row">
            <div class="col-lg-12">
             <div class="form-group">
              <label class="label15">Service Name</label>
              <input type="text" class="job-input" name="service_name" value="<?php echo $result2['service_name']; ?>">
            </div>
            <div class="form-group">
              <label class="label15">Service Description</label>
              <textarea class="textarea_input" name="service_description" placeholder="Type Description"><?php echo $result2['service_description']; ?></textarea>
            </div>
          </div>
          <div class="col-lg-6">
           <div class="form-group">
            <label class="label15">Salary</label>
            <div class="smm_input">
             <input type="text" class="job-input" name="service_salary" value="<?php echo $result2['service_salary']; ?>">
             <div class="mix_max">BDT</div>
           </div>
         </div>
       </div>
       <div class="col-lg-6">
         <div class="form-group">
          <label class="label15">Salary Method</label>
          <div class="ui fluid search selection dropdown skills-search">
           <input name="service_salary_method" type="hidden" value="<?php echo $result2['service_salary_method']; ?>">
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
      <label class="label15">Job Working Type</label>
      <div class="ui fluid search selection dropdown skills-search">
       <input name="service_working_type" type="hidden" value="<?php echo $result2['service_working_type']; ?>">
       <i class="dropdown icon"></i>
       <input class="search" autocomplete="off" tabindex="0">
       <span class="sizer" style=""></span>
       <div class="default text">Choose One</div>
       <div class="menu transition hidden" tabindex="-1">
        <div class="item selected" data-value="Online">Online</div>
        <div class="item selected" data-value="Offline">Offline</div>
      </div>
    </div>
  </div>
</div>
<div class="col-lg-6">
 <div class="form-group">
  <label class="label15">Experience Level</label>
  <div class="ui fluid search selection dropdown skills-search">
   <input name="service_experience" type="hidden" value="<?php echo $result2['service_experience']; ?>">
   <i class="dropdown icon"></i>
   <input class="search" autocomplete="off" tabindex="0">
   <span class="sizer" style=""></span>
   <div class="default text">Select Experience</div>
   <div class="menu transition hidden" tabindex="-1">
    <div class="item" data-value="level1">Intermediate (0 year - 2 year)</div>
    <div class="item" data-value="level2">Intermediate (2 year - 4 year)</div>
    <div class="item" data-value="level3">Intermediate (4 year - 6 year)</div>
    <div class="item" data-value="level4">Intermediate (6 year - 8 year)</div>
    <div class="item" data-value="level5">Intermediate (8 year - 10 year)</div>
    <div class="item" data-value="level6">Intermediate (10 year - 12 year)</div>
    <div class="item" data-value="level7">Intermediate (12 year - 14 year)</div>
    <div class="item" data-value="level8">Intermediate (14 year - 16 year)</div>
    <div class="item" data-value="level9">Intermediate (16 year - 20 year)</div>
    <div class="item" data-value="level10">Intermediate (20 year - 30 year)</div>
  </div>
</div>
</div>
</div>
<div class="col-lg-6">
 <div class="form-group">
  <label class="label15">Service Category</label>
  <div class="ui fluid search selection dropdown skills-search">
   <input name="service_category" type="hidden" value="<?php echo $result2['service_category']; ?>">
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
<div class="col-lg-6">
 <div class="form-group">
  <label class="label15">Service Areas</label>
  <select class="selectpicker ui fluid search selection dropdown skills-search " value="<?php echo $result2['service_area']; ?>" id="areas" multiple aria-label="">
    
    <?php
    $sql = "SELECT * FROM operation_area";
    if($result = mysqli_query($conn, $sql)){
      if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
          echo '<option value="'.$row['policeStation'].'">'.$row['policeStation'].'</option>';
        }
      }
    }
    ?>
  </select>
  <input type="hidden" name="service_area" id="service_area" />
  
</div>

</div>
</div>

<div class="col-lg-12">
 <div class="form-group">
  <label class="label15">Upload Service Images for Demo</label><br>
  <input type="file" name="fileUpload[]" multiple>
</div>
</div>
<div class="col-lg-12">
 <button class="post_jp_btn" type="submit">Post a Job</button>
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