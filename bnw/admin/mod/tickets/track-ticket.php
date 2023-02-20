<?php
session_start();
include('../../db/conn.php');

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: ../../login.php");
  exit;
}
$id = $_GET['id'];
$query=mysqli_query($conn,"select * from `tickets` where id='$id'");
$result=mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Ticket Tracker | <?php echo $siteName; ?></title>
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
      <h1>Track Ticket</h1>
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
    
      <div class="row">
        <div class="col-md-8">
          <div class="card ">
            <div class="card-header">
              <center><h5 class="text-black">Ticket Info</h5></center>
            </div>
            <div class="card-body">
              <form method="post" id="form_test"> 
                <div class="form-group row">
                  <label class="control-label text-center col-md-4">Ticket ID:</label>
                  <div class="col-md-8">
                    <input  class="form-control" value="<?php echo $result['id']; ?>" id="id" type="text" name="id" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label text-center col-md-4">User ID</label>
                  <div class="col-md-8">
                    <input  class="form-control" value="<?php echo $result['user_id']; ?>" type="text" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label text-center col-md-4">Customer Name</label>
                  <div class="col-md-8">
                    <input  class="form-control" value="<?php echo $result['username']; ?>" type="text" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label text-center col-md-4">Ticket Type</label>
                  <div class="col-md-8">
                    <input  class="form-control" value="<?php echo $result['ticket_type']; ?>" type="text" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label text-center col-md-4">Ticket Details</label>
                  <div class="col-md-8">
                    <input  class="form-control" value="<?php echo $result['ticket_details']; ?>" type="text" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label text-center col-md-4">Created By</label>
                  <div class="col-md-8">
                    <input  class="form-control" value="<?php echo $result['created_by']; ?>" type="text" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label text-center col-md-4">Assigned Executive</label>
                  <div class="col-md-8">
                    <input  class="form-control" value="<?php echo $result['ass_person']; ?>" type="text" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label text-center col-md-4">Comment</label>
                  <div class="col-md-8">
                    <textarea type="text" class="form-control" name="comment"><?php echo $result['review']; ?></textarea>
                    <!-- <input  class="form-control" value="<?php echo $result['review']; ?>" type="textarea" > -->
                  </div>
                </div>
              <!-- <div class="form-group row">
                <label class="control-label text-center col-md-4">Reference</label>
                <div class="col-md-8">
                  <input  class="form-control" value="<?php echo $result['reference']; ?>" type="text" readonly>
                </div>
              </div> -->
              <!-- <center>
                <button class="btn-sm btn-info"><i class="fa fa-save"></i> Save </button>
              </center> -->

              
              <center>
                 <div class="card-footer">
               <input type="submit" name="insert" id="insert" value="Save" class="btn btn-primary" /> 
             </div>
              </center>
             
           </form>

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
              if($result['create_time'] != NULL){
                echo ' <div class="sl-item sl-success">
                <div class="sl-content"><small class="text-muted"><i class="fa fa-calendar position-left"></i> '.$result['create_time'].'</small>
                <p>Ticket Created Successfully!</p>
                </div>
                </div>';
              }else{
                  // echo ' <div class="sl-item sl-warning">
                  // <div class="sl-content"><small class="text-muted"><i class="fa fa-user position-left"></i> '.$result['createTime'].'</small>
                  // <p>Request Received Pending!</p>
                  // </div>
                  // </div>';
              }
              if($result['startProcessingTime'] != NULL){
                echo ' <div class="sl-item sl-success">
                <div class="sl-content"><small class="text-muted"><i class="fa fa-calendar position-left"></i> '.$result['startProcessingTime'].'</small>
                <p>Processing Started!</p>
                </div>
                </div>';
              }else{
                  // echo ' <div class="sl-item sl-warning">
                  // <div class="sl-content"><small class="text-muted"><i class="fa fa-user position-left"></i> '.$result['confirmTime'].'</small>
                  // <p>Confirmation Pending!</p>
                  // </div>
                  // </div>';
              }
              if($result['close_date'] != NULL){
                echo ' <div class="sl-item sl-success">
                <div class="sl-content"><small class="text-muted"><i class="fa fa-calendar position-left"></i> '.$result['close_date'].'</small>
                <p>Ticket Closed Successfully!</p>
                </div>
                </div>';
              }else{
                  // echo ' <div class="sl-item sl-warning">
                  // <div class="sl-content"><small class="text-muted"><i class="fa fa-user position-left"></i> '.$result['startProcessingTime'].'</small>
                  // <p>Processing Pending!</p>
                  // </div>
                  // </div>';
              }

              ?>
              <div class="mt-3">
                <center>

                  <button class="btn btn-warning btn-sm mb-2 start_processing" id="<?php echo $id; ?>"><i class="fa fa-check"></i> Start Proccessing</button><br>
                  <button class="btn btn-success btn-sm close_ticket" id="<?php echo $id; ?>"><i class="fa fa-times"></i> Close Ticket</button>
                </center>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  
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
  $(document).on('click', '.close_ticket', function(){  
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
          url:"action/close-ticket.php",
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

  $('#form_test').on("submit", function(event){  
   event.preventDefault(); 
   $.ajax({  
     url:"action/save-comment.php",  
     method:"POST",  
     data:$('#form_test').serialize(),  
     beforeSend:function(){  
      $('#insert').val("Saving Data");  
    },  
    success:function(data){  
     // $('#insert_form')[0].reset();  
     // $('#add_data_Modal').modal('hide');  
     // $('#employee_table').html(data);
    //  dataTable.ajax.reload();
    $('#insert').val("Save");
    }  
  });   
  
});
</script>



</body>
</html>
