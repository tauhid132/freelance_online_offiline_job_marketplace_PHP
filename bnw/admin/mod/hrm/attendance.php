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
  <title>Attendance | <?php echo $siteName; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1" />

  <?php include('../../includes/stylesheet.php') ?>

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
      <h1><i class="fa fa-user-o"></i> Attendance System </h1>
      <ol class="breadcrumb">
        <li><a href="#">HRM</a></li>
        <li><i class="fa fa-angle-right"></i> Attendance</li>
      </ol>
    </div>

    <style>
      .loader {
        visibility: hidden;
        position: fixed;
        border: 16px solid #f3f3f3;
        z-index: +100 !important;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        width: 120px;
        height: 120px;
        margin-left: 35%;
        -webkit-animation: spin 2s linear infinite; /* Safari */
        animation: spin 2s linear infinite;
      }

      /* Safari */
      @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
      }

      @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
      }
    </style>
    
    <!-- Main content -->
    <div class="content">
      <form method="post" id="form1"> 
        <div class="card">
          <div class="card-header">
            <center><h5 class="text-black">Attendance Action Selector</h5></center>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <input type="date" class="form-control" id="attendance_date" name="attendance_date">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <select class="form-control select2bs4" name="attendance_action" id="attendance_action" style="width: 100%;">
                    <option value="add_attendance">Add Attendance</option>
                    <option value="update_attendance">Update Attendance</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <center><input type="submit" name="insert" id="btn1" value="Fetch Employee" class="btn btn-info" /> </center>
          </div>
        </div>
      </form>
      <center><div class="loader"></div></center>
      <form method="post" id="form2">
        <div id="selected_div">
        <div class="card mt-2">
          <div class="card-header">
            <center><h5 class="text-black">Selected Employee List</h5></center>
          </div>
          <div class="card-body">
          
              <div id="selected_users"></div>
            
          </div>
          <div class="card-footer">
            <center> <input type="submit" name="insert2" id="btn2" value="Add Attendance" class="btn btn-info" /></center>
          </div>
        </div> 
      </div>
      </form>



      <!-- /.content --> 
    </div>
  </div>
  <!-- /.content-wrapper -->
  <?php include('../../includes/footer.php') ?>
</div>

<!-- ./wrapper --> 
<?php include('../../includes/js.php') ?>

<script type="text/javascript">
  $('#selected_div').hide();
  $('#form1').on("submit", function(event){  
   event.preventDefault();
   if($('#attendance_action').val()=='add_attendance' && $('#attendance_date').val() == ''){
    swal("Please Select date!!")
   }else if($('#attendance_action').val()=='add_attendance' && $('#attendance_date').val() != ''){
   $.ajax({  
    url:"fetch/fetch-employee.php",  
    method:"POST",  
    data:$('#form1').serialize(), 
    beforeSend:function(){    
      $('.loader').css("visibility", "visible");
    },  
    success:function(data){
      $('#selected_div').show();  
      $('#selected_users').html(data);      
      $('.loader').css("visibility", "hidden");
      $('#btn2').val("Add Attendance");
      
     
     
    }  
  });
  } else if($('#attendance_action').val()=='update_attendance' && $('#attendance_date').val() != ''){
   $.ajax({  
    url:"fetch/fetch-employee-update.php",  
    method:"POST",  
    data:$('#form1').serialize(), 
    beforeSend:function(){    
      $('.loader').css("visibility", "visible");
    },  
    success:function(data){
      $('#selected_div').show();  
      $('#selected_users').html(data);      
      $('.loader').css("visibility", "hidden");
      $('#btn2').val("Update Attendance");
      
     
    }  
  });
  }   
 });

  $('#form2').on("submit", function(event){  
   event.preventDefault(); 
   // var attendance_date = $('#attendance_date2').val();
   // console.log(attendance_date)
   //$('#attendance_action2').val(attendance_date);
  
  $.ajax({  
    url:"action/add-update-attendance.php",  
    method:"POST",  
    data:$('#form2').serialize(),
    //data:{attendance_date:attendance_date},
    beforeSend:function(){  
      //$('#btn2').val("Updating");  
      $('.loader').css("visibility", "visible");
    },  
    success:function(data){
      swal(data);  
      $('#form1')[0].reset(); 
      $('#form2')[0].reset(); 
      //$('#btn2').val("Get Users");
      $('.loader').css("visibility", "hidden");
      $('#selected_div').hide();
      
    }  
  }); 
  
});


 
    


</script>



</body>
</html>
