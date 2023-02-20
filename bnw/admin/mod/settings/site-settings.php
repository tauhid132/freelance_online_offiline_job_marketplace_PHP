<?php
session_start();
include('../../db/conn.php');

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: ../../login.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Settings | <?php echo $siteName; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1" />

  <?php include('../../includes/stylesheet.php') ?>
  <link rel="stylesheet" href="<?php echo $url;?>/dist/plugins/bootstrap-switch/bootstrap-switch.css">
  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
  

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper boxed-wrapper">
   <?php include('../../includes/header.php') ?>
   <!-- Left side column. contains the logo and sidebar -->
   <aside class="main-sidebar"> 
    <!-- sidebar: style can be found in sidebar.less -->
    <?php include('../../includes/sidebar.php') ?>
    <!-- /.sidebar --> 
  </aside>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <div class="content-header sty-one">
       <h1><i class="fa fa-cogs"></i> Settings </h1>
      <ol class="breadcrumb">
        <li><a href="#">settings</a></li>
        <li><i class="fa fa-angle-right"></i> site settings</li>
      </ol>
    </div>
    
    <!-- Main content -->
    <div class="content"> 
      <!-- Small boxes (Stat box) -->
      <div class="info-box">
        <div class="row">
          <div class="col-sm-8">
          <div class="card">
            <div class="card-header text-black">
              <h5>Site Name: </h5>
            </div>
            <div class="card-body text-black">
              <h2 class="siteName_div"><?php echo $siteName; ?></h2>
            </div>
            <div class="card-footer">
              <button class="btn btn-info btn-sm edit_siteName"><i class="fa fa-edit"></i> Change Site Name</button>
            </div>
          </div>
          </div>
          <div class="col-lg-4">
          <div class="card">
            <div class="card-header text-black">
              <h5>Site Logo:  </h5>
            </div>
            <div class="card-body">
              <img src="<?php echo $url;?>/dist/img/logo3.png" alt="" style=" height: 50px">
            </div>
            <div class="card-footer">
              <button class="btn btn-info btn-sm edit_siteName"><i class="fa fa-edit"></i> Change Logo</button>
            </div>
          </div>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <label class="text-black">API Settings : </label>
              <?php
              $query2=mysqli_query($conn,"select * from `setting` where id='1'");
              $result2=mysqli_fetch_array($query2);
              if($result2['enableApi']==1){
                echo '<input id="api_setting" type="checkbox" data-toggle="toggle" data-on="Enabled" data-off="Disabled" onchange="test()"  checked="yes" data-size="xs">';
              }else if($result2['enableApi']==0){
                echo '<input id="api_setting" type="checkbox" data-toggle="toggle" data-on="Enabled" data-off="Disabled" onchange="test()" data-size="xs">';
              }
              echo '<label class="ml-3 text-black">Auto Disconnection : </label>';
              if($result2['enableAutoUser']==1){
                echo '<input id="auto_user" type="checkbox" data-toggle="toggle" data-on="Enabled" data-off="Disabled" onchange="test()"  checked="yes" data-size="xs">';
              }else if($result2['enableAutoUser']==0){
                echo '<input id="auto_user" type="checkbox" data-toggle="toggle" data-on="Enabled" data-off="Disabled" onchange="test()"  data-size="xs">';
              }
              ?>

            </div>
            </div>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-lg-4 col-sm-6 m-b-3">
            <div id="service_area_div">
            <h4 class="text-black">Service Area List</h4>
            <ul class="list-group">
              <?php  
              $sql = "SELECT * FROM service_area";
              if($result = mysqli_query($conn,$sql)){
                if(mysqli_num_rows($result)>0){
                  while($row = mysqli_fetch_array($result)){
                    echo ' <li class="list-group-item d-flex justify-content-between align-items-center"> '.$row['area_name'].' <span class="float-right"><i class="fa fa-edit text-green edit_area" id="'. $row["id"].'"></i><i class="fa fa-trash ml-1 text-red delete_area" id="'. $row["id"].'"></i></span> </li>';
                 }
               }
             }
             ?>

           </ul>
         </div>
          <div class="mt-3 float-right">
             <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#add_data_Modal"><i class="fa fa-plus"></i> Add New</button>
           </div>
         </div>
          <div class="col-lg-4 col-sm-6 m-b-3">
            <div id="ticket_type_div">
            <h4 class="text-black">Ticket Type List</h4>
            <ul class="list-group">
              <?php  
              $sql = "SELECT * FROM ticket_type";
              if($result = mysqli_query($conn,$sql)){
                if(mysqli_num_rows($result)>0){
                  while($row = mysqli_fetch_array($result)){
                    echo ' <li class="list-group-item d-flex justify-content-between align-items-center"> '.$row['type_name'].' <span class="float-right"><i class="fa fa-edit text-green edit_ticket_type" id="'. $row["id"].'"></i><i class="fa fa-trash ml-1 text-red delete_ticket_type" id="'. $row["id"].'"></i></span> </li>';
                 }
               }
             }
             ?>

           </ul>
         </div>
          <div class="mt-3 float-right">
             <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#add_data_Modal2"><i class="fa fa-plus"></i> Add New</button>
           </div>
         </div>
          <div class="col-lg-4 col-sm-6 m-b-3">
            <div id="plans_div">
            <h4 class="text-black">Packages</h4>
            <ul class="list-group">
              <?php  
              $sql = "SELECT * FROM monthly_plans";
              if($result = mysqli_query($conn,$sql)){
                if(mysqli_num_rows($result)>0){
                  while($row = mysqli_fetch_array($result)){
                    echo ' <li class="list-group-item d-flex justify-content-between align-items-center"> '.$row['planName'].' <span class="float-right"><i class="fa fa-edit text-green edit_monthly_plans" id="'. $row["id"].'"></i><i class="fa fa-trash ml-1 text-red delete_plans" id="'. $row["id"].'"></i></span> </li>';
                 }
               }
             }
             ?>

           </ul>
         </div>
          <div class="mt-3 float-right">
             <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#add_data_Modal3"><i class="fa fa-plus"></i> Add New Plan</button>
           </div>
         </div>
      </div>

    </div>
  </div>
  <!-- /.content --> 
</div>
<!-- /.content-wrapper -->
<?php include('../../includes/footer.php') ?>
</div>
<!-- ./wrapper --> 
<?php include('../../includes/js.php') ?>

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
    $('#insert_form2')[0].reset();  
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
      if(new_name == "" || new_name == null){
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
<!-- <script src="<?php echo $url;?>/dist/plugins/bootstrap-switch/bootstrap-switch.js"></script> 
<script src="<?php echo $url;?>/dist/plugins/bootstrap-switch/highlight.js"></script> 
<script src="<?php echo $url;?>/dist/plugins/bootstrap-switch/main.js"></script> -->
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

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
</body>
</html>
