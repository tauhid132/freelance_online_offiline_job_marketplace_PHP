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
  <title>Reminder SMS | <?php echo $siteName; ?></title>
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
       <h1><i class="fa fa-paper-plane-o"></i> Reminder SMS Sender </h1>
      <ol class="breadcrumb">
        <li><a href="#">SMS</a></li>
        <li><i class="fa fa-angle-right"></i> Bill Reminder</li>
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
            <center><h5 class="text-black">User Selector</h5></center>
          </div>
          <div class="card-body">
            <div class="row">
             
            <div class="col-md-6">
              <div class="form-group">
                <select class="form-control select2bs4" name="area" id="area" style="width: 100%;">
                  <option selected="">Choose Area</option>
                  <option value="all_area">All Area</option>
                  <?php
                  $sql5 = "SELECT * FROM service_area";
                  if($result5 = mysqli_query($conn, $sql5)){
                    if(mysqli_num_rows($result5) > 0){
                     while($row = mysqli_fetch_array($result5)){
                      echo '<option value="'. $row['area_name'] .'">' . $row['area_name'] . '</option>';
                    }
                  }
                } 
                ?>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <select class="form-control select2bs4" name="sms_type" id="sms_type" style="width: 100%;">
                <option value="no-select" selected>Choose SMS Text</option>
                <option value="bill-rem-1">Bill Reminder_1</option>
                <option value="bill-rem-warn">Bill Reminder_Warning</option>
              </select>
            </div>
          </div> 
        </div>
      </div>
      <div class="card-footer">
        <center><input type="submit" name="insert" id="btn1" value="Fetch Users" class="btn btn-info" /> </center>
      </div>
    </div>
  </form>
  <center><div class="loader"></div></center>
  <form method="post" id="form2">
    <div id="selected_div">
    <div class="card mt-2">
      <div class="card-header">
        <center><h5 class="text-black">Selected Users List</h5></center>
      </div>
      <div class="card-body">
        <div class="row">
          <center><div id="selected_users"></div></center>
        </div>
      </div>
      <div class="card-footer">
        <center><input type="submit" name="insert2" id="btn2" value="Send SMS" class="btn btn-info" /> </center>
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
   $.ajax({  
    url:"fetch/fetch-users-reminder.php",  
    method:"POST",  
    data:$('#form1').serialize(), 

    beforeSend:function(){  
      //$('#btn1').val("Updating");  
      $('.loader').css("visibility", "visible");
    },  
    success:function(data){
      $('#selected_div').show();  
      $('#selected_users').html(data); 
      
     // $('#btn1').val("Get Users");
     $('.loader').css("visibility", "hidden");
      //var smstext2 = data.smstext;
      
      //$('#add_data_Modal').modal('hide');  
      //$('#employee_table').html(data);
      //$(location.reload());  
    }  
  });  
 });

  $('#form2').on("submit", function(event){  
   event.preventDefault(); 
   var sms_type = $('#sms_type').val();
   var selectedUsers = [];
   $("input[name='selectedUsers']:checked").each(function(){
    selectedUsers.push(this.value);
  });
   if($('#sms_type').val() == 'no-select')  
   {  
    swal("Select SMS Template!!");  
  }else{

   $.ajax({  
    url:"action/send-reminder-all.php",  
    method:"POST",  
    data:{selectedUsers:selectedUsers,sms_type:sms_type},
    beforeSend:function(){  
      //$('#btn2').val("Updating");  
      $('.loader').css("visibility", "visible");
    },  
    success:function(data){  
      //$('#selected_users').html(data); 
      $('#form2')[0].reset(); 
      $('#form1')[0].reset(); 
      $('.loader').css("visibility", "hidden");
      $('#selected_div').hide();
    }  
  }); 
 } 
});


</script>



</body>
</html>
