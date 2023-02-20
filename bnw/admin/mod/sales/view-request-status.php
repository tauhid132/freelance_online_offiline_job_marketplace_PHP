<?php
session_start();
include('../../db/conn.php');

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: ../../login.php");
  exit;
}
$id = $_GET['id'];
$query=mysqli_query($conn,"select * from `newconnectionrequest` where id='$id'");
$result=mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>View Status | <?php echo $siteName; ?></title>
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
      <h1>Request Status</h1>
      <ol class="breadcrumb">
        <li><a href="#">Sales</a></li>
        <li><i class="fa fa-angle-right"></i> View Request</li>
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
        <div class="row">
          <div class="col-md-8">
          <div class="card ">
            <div class="card-header">
              <center><h5 class="text-black">Client Info</h5></center>
            </div>
            <div class="card-body">

              <div class="form-group row">
                <label class="control-label text-center col-md-4">Full Name</label>
                <div class="col-md-8">
                  <input  class="form-control" value="<?php echo $result['fullName']; ?>" type="text" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label text-center col-md-4">Connection Address</label>
                <div class="col-md-8">
                  <input  class="form-control" value="<?php echo $result['fullAddress']; ?>" type="text" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label text-center col-md-4">Mobile No</label>
                <div class="col-md-8">
                  <input  class="form-control" value="<?php echo $result['mobileNo']; ?>" type="text" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label text-center col-md-4">Email Address</label>
                <div class="col-md-8">
                  <input  class="form-control" value="<?php echo $result['emailAddress']; ?>" type="text" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label text-center col-md-4">Selected Package</label>
                <div class="col-md-8">
                  <input  class="form-control" value="<?php echo $result['selectedPackage']; ?>" type="text" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label text-center col-md-4">Receive Date</label>
                <div class="col-md-8">
                  <input  class="form-control" value="<?php echo $result['createTime']; ?>" type="text" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label text-center col-md-4">Deadline</label>
                <div class="col-md-8">
                  <input  class="form-control" value="<?php echo $result['deadline']; ?>" type="text" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label text-center col-md-4">Assigned Executive</label>
                <div class="col-md-8">
                  <input  class="form-control" value="<?php echo $result['assignedExecutive']; ?>" type="text" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label text-center col-md-4">Reference</label>
                <div class="col-md-8">
                  <input  class="form-control" value="<?php echo $result['reference']; ?>" type="text" readonly>
                </div>
              </div>



            </div>
        
          </div>
          </div>
          <div class="col-md-4">
          <div class="card ">
            <div class="card-header">
              <h5 class="text-black">Progress Timeline</h5>
            </div>
            <div class="card-body">
              <div id="progress_div">
              <div class="info-box">
                <?php
                if($result['createTime'] != NULL){
                  echo ' <div class="sl-item sl-success">
                  <div class="sl-content"><small class="text-muted"><i class="fa fa-user position-left"></i> '.$result['createTime'].'</small>
                  <p>Request Received Successfully</p>
                  </div>
                  </div>';
                }else{
                  // echo ' <div class="sl-item sl-warning">
                  // <div class="sl-content"><small class="text-muted"><i class="fa fa-user position-left"></i> '.$result['createTime'].'</small>
                  // <p>Request Received Pending!</p>
                  // </div>
                  // </div>';
                }
                 if($result['confirmTime'] != NULL){
                  echo ' <div class="sl-item sl-success">
                  <div class="sl-content"><small class="text-muted"><i class="fa fa-user position-left"></i> '.$result['confirmTime'].'</small>
                  <p>Request Successfully Confirmed!</p>
                  </div>
                  </div>';
                }else{
                  // echo ' <div class="sl-item sl-warning">
                  // <div class="sl-content"><small class="text-muted"><i class="fa fa-user position-left"></i> '.$result['confirmTime'].'</small>
                  // <p>Confirmation Pending!</p>
                  // </div>
                  // </div>';
                }
                if($result['startProcessingTime'] != NULL){
                  echo ' <div class="sl-item sl-success">
                  <div class="sl-content"><small class="text-muted"><i class="fa fa-user position-left"></i> '.$result['startProcessingTime'].'</small>
                  <p>Processing!</p>
                  </div>
                  </div>';
                }else{
                  // echo ' <div class="sl-item sl-warning">
                  // <div class="sl-content"><small class="text-muted"><i class="fa fa-user position-left"></i> '.$result['startProcessingTime'].'</small>
                  // <p>Processing Pending!</p>
                  // </div>
                  // </div>';
                }
                if($result['finishTime'] != NULL){
                  echo ' <div class="sl-item sl-success">
                  <div class="sl-content"><small class="text-muted"><i class="fa fa-user position-left"></i> '.$result['finishTime'].'</small>
                  <p>Successfully Finished!</p>
                  </div>
                  </div>';
                }else{
                  // echo ' <div class="sl-item sl-warning">
                  // <div class="sl-content"><small class="text-muted"><i class="fa fa-user position-left"></i> '.$result['finishTime'].'</small>
                  // <p>Finishing Pending!</p>
                  // </div>
                  // </div>';
                }
                ?>
                <div class="mt-3">
                  <center>
                  <button class="btn btn-info btn-sm mb-2 confirm_request" id="<?php echo $id; ?>">Confirm Request</button><br>
                  <button class="btn btn-info btn-sm mb-2 start_processing" id="<?php echo $id; ?>">Start Proccessing</button><br>
                  <button class="btn btn-info btn-sm finish" id="<?php echo $id; ?>">Finish</button>
                  </center>
                </div>
               </div>
            </div>
            </div>
          </div>
        </div>
      </form>
      <center><div class="loader"></div></center>


    </div>
      <!-- /.content --> 
    </div>
  </div>
  <!-- /.content-wrapper -->
  <?php include('../../includes/footer.php') ?>
</div>

<!-- ./wrapper --> 
<?php include('../../includes/js.php') ?>

<script type="text/javascript">
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
      
    }  
  }); 
 } 
});



$(document).on('click', '.confirm_request', function(){  
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
          url:"action/confirm-request.php",
          method:"POST",
          data:{id:id},
          success:function(data){
            swal("Confirmed Successfully!!", {
              icon: "success",
            });
           $("#progress_div").load(location.href + " #progress_div");
          }
        })
      } else {
        return false;
      }
    });
  });  
$(document).on('click', '.start_processing', function(){  
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
          url:"action/start-processing.php",
          method:"POST",
          data:{id:id},
          success:function(data){
            swal("Processing Started!!", {
              icon: "success",
            });
           $("#progress_div").load(location.href + " #progress_div");
          }
        })
      } else {
        return false;
      }
    });
  });  
$(document).on('click', '.finish', function(){  
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
          url:"action/finish-request.php",
          method:"POST",
          data:{id:id},
          success:function(data){
            swal("Request Finished!!", {
              icon: "success",
            });
           $("#progress_div").load(location.href + " #progress_div");
          }
        })
      } else {
        return false;
      }
    });
  });  
</script>



</body>
</html>
