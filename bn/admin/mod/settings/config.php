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

<head>
	<title>Site Setting | <?php echo $siteName; ?></title>
	<?php include('../../includes/stylesheet.php'); ?>
  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
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
								<i class="feather icon-inbox bg-c-blue"></i>
								<div class="d-inline">
									<h5>Page Settings</h5>
									
								</div>
							</div>
						</div>
						
						
						<div class="col-lg-4">
							<div class="page-header-breadcrumb">
								<ul class=" breadcrumb breadcrumb-title">
									
								</ul>
							</div>
						</div>
					</div>
					
				</div>
				

				<div class="pcoded-inner-content">

					<div class="main-body">
						<div class="page-wrapper">

							<div class="page-body">
               <div class="row">
                
                <div class="col-sm-12 siteName_div">
                  <div class="card">
                    <div class="card-header">
                      <h5>Site Name</h5>
                    </div>
                    <div class="card-block">
                      <h2><?php echo $siteName; ?></h2>
                      <span class="float-right hidden-phone">
                       <i class="fa fa-edit edit_siteName"></i>
                     </span>
                   </div>
                 </div>
               </div>
              

               <div class="col-sm-12 ">
                <div class="card">
                  <div class="card-block">
                    <label>Mikrotik Intregration : </label>
                    <?php
                    $query2=mysqli_query($conn,"select * from `setting` where id='1'");
                    $result2=mysqli_fetch_array($query2);
                    if($result2['enableApi']==1){
                      echo '<input id="api_setting" type="checkbox" data-toggle="toggle" data-on="Enabled" data-off="Disabled" onchange="test()"  checked="yes" data-size="xs">';
                    }else if($result2['enableApi']==0){
                      echo '<input id="api_setting" type="checkbox" data-toggle="toggle" data-on="Enabled" data-off="Disabled" onchange="test()" data-size="xs">';
                    }
                    echo '<label class="p-l-10">Auto Disconnection : </label>';
                     if($result2['enableAutoUser']==1){
                      echo '<input id="auto_user" type="checkbox" data-toggle="toggle" data-on="Enabled" data-off="Disabled" onchange="test()"  checked="yes" data-size="xs">';
                    }else if($result2['enableAutoUser']==0){
                      echo '<input id="auto_user" type="checkbox" data-toggle="toggle" data-on="Enabled" data-off="Disabled" onchange="test()"  data-size="xs">';
                    }
                    ?>
                  <input id="api_setting" type="checkbox" data-toggle="toggle" data-on="Enabled" data-off="Disabled" onchange="test()"  checked="yes" data-size="xs">
                    
                  </div>
                </div>
              </div>





              <div class="col-sm-6">
                <div id="service_area_div">
                  <div class="card">
                   <div class="card-header">
                    <h5>Service Area List</h5>
                  </div>
                  <div class="card-block">
                    <section class="task-panel tasks-widget">
                     <div class="panel-body">
                      <div class="task-content">
                       <div class="to-do-label">
                        <div class="checkbox-fade fade-in-primary">
                          <?php  
                          $sql = "SELECT * FROM service_area";
                          if($result = mysqli_query($conn,$sql)){
                            if(mysqli_num_rows($result)>0){
                              while($row = mysqli_fetch_array($result)){
                                echo '<label class="check-task">
                                <span class="cr">
                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                </span>
                                <span class="task-title-sp">'.$row['area_name'].'</span>
                                <span class="float-right hidden-phone">
                                <a><i class="icofont icofont-ui-delete delete_area" id="'. $row["id"].'"></i></a>
                                </span>
                                <span class="float-right hidden-phone">
                                <i class="icofont icofont-ui-edit edit_area" id="'. $row["id"].'"></i>
                                </span>
                                </label>';

                              }
                            }
                          }
                          ?>

                        </div>
                      </div>

                    </div>
                    <div>
                     <a class="btn btn-primary btn-sm btn-add-task waves-effect waves-light m-t-10" href="#" data-toggle="modal" data-target="#add_data_Modal"><i class="icofont icofont-plus"></i> Add New Area</a>
                   </div>
                 </div>
               </section>
             </div>
           </div>
         </div>

       </div>


       <div class="col-sm-6">
        <div id="ticket_type_div">
          <div class="card">
           <div class="card-header">
            <h5>Ticket Type</h5>
          </div>
          <div class="card-block">
            <section class="task-panel tasks-widget">
             <div class="panel-body">
              <div class="task-content">
               <div class="to-do-label">
                <div class="checkbox-fade fade-in-primary">
                  <?php  
                  $sql = "SELECT * FROM ticket_type";
                  if($result = mysqli_query($conn,$sql)){
                    if(mysqli_num_rows($result)>0){
                      while($row = mysqli_fetch_array($result)){
                        echo '<label class="check-task">
                        <span class="cr">
                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                        </span>
                        <span class="task-title-sp">'.$row['type_name'].'</span>
                        <span class="float-right hidden-phone">
                        <a><i class="icofont icofont-ui-delete delete_ticket_type" id="'. $row["id"].'"></i></a>
                        </span>
                        <span class="float-right hidden-phone">
                        <i class="icofont icofont-ui-edit edit_ticket_type" id="'. $row["id"].'"></i>
                        </span>
                        </label>';

                      }
                    }
                  }
                  ?>

                </div>
              </div>

            </div>
            <div>
             <a class="btn btn-primary btn-sm btn-add-task waves-effect waves-light m-t-10" href="#" data-toggle="modal" data-target="#add_data_Modal2"><i class="icofont icofont-plus"></i> Add New Type</a>
           </div>
         </div>
       </section>
     </div>
   </div>
 </div>

</div>
</div>

<div class="row">
 <div class="col-sm-6">
  <div id="plans_div">
    <div class="card">
     <div class="card-header">
      <h5>Home Packages</h5>
    </div>
    <div class="card-block">
      <section class="task-panel tasks-widget">
       <div class="panel-body">
        <div class="task-content">
         <div class="to-do-label">
          <div class="checkbox-fade fade-in-primary">
            <?php  
            $sql = "SELECT * FROM monthly_plans WHERE planType='home'";
            if($result = mysqli_query($conn,$sql)){
              if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_array($result)){
                  echo '<label class="check-task">
                  <span class="cr">
                  <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                  </span>
                  <span class="task-title-sp">'.$row['planName'].'</span>
                  <span class="float-right hidden-phone">
                  <a><i class="icofont icofont-ui-delete delete_plans" id="'. $row["id"].'"></i></a>
                  </span>
                  <span class="float-right hidden-phone">
                  <i class="icofont icofont-ui-edit edit_monthly_plans" id="'. $row["id"].'"></i>
                  </span>
                  </label>';

                }
              }
            }
            ?>

          </div>
        </div>

      </div>
      <div>
       <a class="btn btn-primary btn-sm btn-add-task waves-effect waves-light m-t-10" href="#" data-toggle="modal" data-target="#add_data_Modal3"><i class="icofont icofont-plus"></i> Add New Type</a>
     </div>
   </div>
 </section>
</div>
</div>
</div>
</div>
<div class="col-sm-6">
 <div id="dedicated_plans_div">
  <div class="card">
   <div class="card-header">
    <h5>Dedicated Packages</h5>
  </div>
  <div class="card-block">
    <section class="task-panel tasks-widget">
     <div class="panel-body">
      <div class="task-content">
       <div class="to-do-label">
        <div class="checkbox-fade fade-in-primary">
          <?php  
          $sql = "SELECT * FROM monthly_plans WHERE planType='dedicated'";
          if($result = mysqli_query($conn,$sql)){
            if(mysqli_num_rows($result)>0){
              while($row = mysqli_fetch_array($result)){
                echo '<label class="check-task">
                <span class="cr">
                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                </span>
                <span class="task-title-sp">'.$row['planName'].'</span>
                <span class="float-right hidden-phone">
                <a><i class="icofont icofont-ui-delete delete_plans" id="'. $row["id"].'"></i></a>
                </span>
                <span class="float-right hidden-phone">
                <i class="icofont icofont-ui-edit edit_monthly_plans" id="'. $row["id"].'"></i>
                </span>
                </label>';

              }
            }
          }
          ?>

        </div>
      </div>

    </div>
    <div>
     <a class="btn btn-primary btn-sm btn-add-task waves-effect waves-light m-t-10" href="#" data-toggle="modal" data-target="#add_data_Modal3"><i class="icofont icofont-plus"></i> Add New Type</a>
   </div>
 </div>
</section>
</div>
</div>








<div id="add_data_Modal" class="modal fade">  
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><b>Add / Update Service Area</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="post" id="insert_form">  
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <input type="hidden" name="id" id="id" class="form-control"  />  
                
                
                
                
                <div class="form-group">
                  <label for="exampleInputEmail1">Area/Zone Name</label>
                  <input type="text" class="form-control" name="area_name" id="area_name">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Comment</label>
                  <input type="text" class="form-control" name="comment" id="comment">
                </div>
                
                
                
                <!-- /.form-group -->
                
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
               <div class="form-group">
                <label for="exampleInputEmail1">Area Code</label>
                <input type="text" class="form-control" name="area_code" id="area_code">
              </div>
              
              
              
              <!-- /.form-group -->
              
              
              
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
           <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" /> 
         </div>
       </form>
     </div>
     <!-- /.row -->
   </div>
   
   <!-- /.card -->
 </div>
 <!-- /.col -->
</div>

</div>



<div id="add_data_Modal2" class="modal fade">  
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><b>Add / Update Ticket Type</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="post" id="insert_form2">  
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <input type="hidden" name="id" id="id2" class="form-control"  />  
                
                
                
                
                <div class="form-group">
                  <label for="exampleInputEmail1">Ticket Type Name</label>
                  <input type="text" class="form-control" name="type_name" id="type_name">
                </div>
                
                
                
                
                <!-- /.form-group -->
                
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              
              <!-- /.row -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
             <input type="submit" name="insert2" id="insert2" value="Insert" class="btn btn-success" /> 
           </div>
         </form>
       </div>
       <!-- /.row -->
     </div>
     
     <!-- /.card -->
   </div>
   <!-- /.col -->
 </div>
</div>  
</div>  
<div id="add_data_Modal3" class="modal fade">  
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><b>Add / Update Monthly Plan</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="post" id="insert_form3">  
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <input type="hidden" name="id" id="id3" class="form-control"  />  
                <div class="form-group">
                  <label for="exampleInputEmail1">Monthly Plan Name</label>
                  <input type="text" class="form-control" name="planName" id="planName">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Bandwidth</label>
                  <input type="text" class="form-control" name="planBW" id="planBW">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <div class="col-sm-12">
                  Plan Type</div>
                  <div class="col-sm-12">
                    <select class="form-control" name="planType" id="planType">
                      <option value="home">Home</option>
                      <option value="dedicated">Dedicated</option>

                    </select>
                  </div>
                </div>
                
              </div>
              <!-- /.col -->
              
              <!-- /.row -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
             <input type="submit" name="insert2" id="insert2" value="Insert" class="btn btn-success" /> 
           </div>
         </form>
       </div>
       <!-- /.row -->
     </div>
     
     <!-- /.card -->
   </div>
   <!-- /.col -->
 </div>
</div>  
</div>  

<script>  
 $(document).ready(function(){ 

   $('#api_setting').change(function(){
    swal({
      title: "Are you sure?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url:"action/change-api-setting.php",
          method:"POST",
          success:function(data){
            swal(data, {
              icon: "success",
            }); 
            //$("#service_area_div").load(location.href + " #service_area_div");  
          }
        })
      } else {
        return false;
      }
    });
    
   }); 

    $('#auto_user').change(function(){
    swal({
      title: "Are you sure?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url:"action/change-autouser-setting.php",
          method:"POST",
          success:function(data){
            swal(data, {
              icon: "success",
            }); 
            //$("#service_area_div").load(location.href + " #service_area_div");  
          }
        })
      } else {
        return false;
      }
    });
    
   }); 

   
  function test(){
    alert("hh");
  }


   $('#add').click(function(){  
     $('#insert').val("Insert");  
     $('#insert_form')[0].reset();  
   });  
   $(document).on('click', '.edit_area', function(){  
     var id = $(this).attr("id");  
     $.ajax({  
      url:"action/fetch-area.php",  
      method:"POST",  
      data:{id:id},  
      dataType:"json",  
      success:function(data){  
        $('#area_name').val(data.area_name);  
        $('#area_code').val(data.area_code);
        $('#comment').val(data.comment); 
        $('#id').val(data.id); 
        $('#insert').val("Add Area");  
        $('#add_data_Modal').modal('show');  
      }  
    });  
   });  

   $(document).on('click', '.edit_ticket_type', function(){  
     var id = $(this).attr("id");  
     $.ajax({  
      url:"action/fetch-ticket-type.php",  
      method:"POST",  
      data:{id:id},  
      dataType:"json",  
      success:function(data){  
        $('#type_name').val(data.type_name); 
        $('#id2').val(data.id); 
        $('#insert2').val("Add Area");  
        $('#add_data_Modal2').modal('show');  
      }  
    });  
   });  
   $(document).on('click', '.edit_monthly_plans', function(){  
     var id = $(this).attr("id");  
     $.ajax({  
      url:"fetch/fetch-plans.php",  
      method:"POST",  
      data:{id:id},  
      dataType:"json",  
      success:function(data){  
        $('#planName').val(data.planName); 
        $('#planType').val(data.planType); 
        $('#planBW').val(data.planBW); 
        $('#id3').val(data.id); 
        $('#insert2').val("Add Plans");  
        $('#add_data_Modal3').modal('show');  
      }  
    });  
   });  
   $(document).on('click', '.delete_area', function(){  
    var id = $(this).attr("id");
    swal({
      title: "Are you sure?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url:"action/deletearea.php",
          method:"POST",
          data:{id:id},
          success:function(data){
            swal("Deleted Successfully!!!!", {
              icon: "success",
            }); 
            $("#service_area_div").load(location.href + " #service_area_div");  
          }
        })
      } else {
        return false;
      }
    });
  });  
   $(document).on('click', '.delete_ticket_type', function(){  
    var id = $(this).attr("id");
    swal({
      title: "Are you sure?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url:"action/deletetickettype.php",
          method:"POST",
          data:{id:id},
          success:function(data){
            swal("Deleted Successfully!!!!", {
              icon: "success",
            }); 
            $("#ticket_type_div").load(location.href + " #ticket_type_div");  
          }
        })
      } else {
        return false;
      }
    });
  });  
   $(document).on('click', '.delete_plans', function(){  
    var id = $(this).attr("id");
    swal({
      title: "Are you sure?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url:"action/delete-plans.php",
          method:"POST",
          data:{id:id},
          success:function(data){
            swal("Deleted Successfully!!!!", {
              icon: "success",
            }); 
            $("#plans_div").load(location.href + " #plans_div");  
            $("#dedicated_plans_div").load(location.href + " #dedicated_plans_div");
          }
        })
      } else {
        return false;
      }
    });
  });  

   $(document).on('click', '.edit_siteName', function(){  
    swal("Enter New Name", {
      content: "input",
    })
    .then((value) => {
      var new_name = value;
      if(new_name == ""){
        swal("Site Name can't be empty!", {
          icon: "warning",
        });
      }else{
        $.ajax({
          url:"action/update-siteName.php",
          method:"POST",
          data:{new_name:new_name},
          success:function(data){
            swal("Name Changed Successfully!", {
              icon: "success",
            });   
            $(".siteName_div").load(location.href + " .siteName_div");  
          }
        });
      } 
    });
  });


   $('#insert_form').on("submit", function(event){  
     event.preventDefault();  
     $.ajax({  
       url:"action/update-area.php",  
       method:"POST",  
       data:$('#insert_form').serialize(),  
       beforeSend:function(){  
        $('#insert').val("Updating");  
      },  
      success:function(data){  
        $('#insert_form')[0].reset();  
        $('#add_data_Modal').modal('hide');  
        $("#service_area_div").load(location.href + " #service_area_div");
      }  
    });  

   });  
   $('#insert_form2').on("submit", function(event){  
     event.preventDefault();  
     $.ajax({  
       url:"action/update-ticket-type.php",  
       method:"POST",  
       data:$('#insert_form2').serialize(),  
       beforeSend:function(){  
        $('#insert').val("Updating");  
      },  
      success:function(data){  
        $('#insert_form2')[0].reset();  
        $('#add_data_Modal2').modal('hide');  
        $("#ticket_type_div").load(location.href + " #ticket_type_div"); 
      }  
    });  

   });  
   $('#insert_form3').on("submit", function(event){  
     event.preventDefault();  
     $.ajax({  
       url:"action/update-plans.php",  
       method:"POST",  
       data:$('#insert_form3').serialize(),  
       beforeSend:function(){  
        $('#insert').val("Updating");  
      },  
      success:function(data){  
        $('#insert_form3')[0].reset();  
        $('#add_data_Modal3').modal('hide');  
        $("#plans_div").load(location.href + " #plans_div"); 
        $("#dedicated_plans_div").load(location.href + " #dedicated_plans_div"); 
      }  
    });  

   });  


 });  
</script>


<?php include('../../includes/js.php'); ?>
</body>

</html>
