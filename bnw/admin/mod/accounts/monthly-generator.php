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
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Monthly Generator | <?php echo $siteName; ?></title>
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
      <h1><i class="fa  fa-history"></i> Manual Cron Generators </h1>
      <ol class="breadcrumb">
        <li><a href="#">Accounts</a></li>
        <li><i class="fa fa-angle-right"></i> otc</li>
      </ol>
    </div>
    

    <!-- Main content -->
    <div class="content"> 
      <!-- Small boxes (Stat box) -->
      <div class="info-box">

        <div class="row">




          <div class="col-sm-12">
            <div class="card">
              <div class="card-header">
                <h5>Manual Cron Generator</h5>
              </div>
              
              <div class="card-block d-flex">



                <button type="button"  class="btn btn-primary m-3 gen_monthly_bill" ><i class="fa fa-plus"></i> Generate Bill</button>


                <button type="button" class="btn btn-primary m-3 gen_salary" ><i class="fa fa-plus"></i> Generate Salary</button>


                <button type="button" class="btn btn-primary m-3 gen_ups" ><i class="fa fa-plus"></i> Generate Upstream Bill</button>


                <!-- <button type="button" class="btn btn-primary m-3" data-toggle="modal" data-target="#modal-otc"><i class="fa fa-plus"></i> OTC Generator</button> -->

              </div>
              
            </div>
          </div>


          <div class="col-sm-8">
            <div class="card mt-2">
              <div class="card-header">
                <h5>Print / PDF </h5>
              </div>
              <div class="card-block">
               <a href="../pdf/generateInvoice.php">
                <button type="button" class="btn btn-success m-3" ><i class="fa fa-print"></i> Print Monthly Invoice</button>
              </a>
              <button type="button" class="btn btn-success m-3" data-toggle="modal" data-target="#modal-sheet" ><i class="fa fa-print"></i> Print Billing Sheet</button>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
            <div class="card mt-2">
              <div class="card-header">
                <h5>Bill / OTC Generator </h5>
              </div>
              <div class="card-block">
              <button type="button" class="btn btn-primary m-3" data-toggle="modal" data-target="#modal-otc"><i class="fa fa-plus"></i> OTC Generator</button>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
            <div class="card mt-2">
              <div class="card-header">
                <h5>API Generators </h5>
              </div>
              <div class="card-block">
              <button type="button" class="btn btn-warning m-3 expire_unpaid_users"><i class="fa fa-ban"></i> Expire Unpaid Users</button>
              <button type="button" class="btn btn-danger m-3 disable_expired_users" ><i class="fa fa-ban"></i> Disable Expired Users</button>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
            <div class="card mt-2">
              <div class="card-header">
                <h5>Reminder SMS / Email </h5>
              </div>
              <div class="card-block">
              <button type="button" class="btn btn-info m-1" data-toggle="modal" data-target="#modal-otc"><i class="fa fa-envelope-o"></i> Send Reminder</button>
              <button type="button" class="btn btn-warning m-1" data-toggle="modal" data-target="#modal-otc"><i class="fa fa-envelope-o"></i> Send Warning</button>
              <button type="button" class="btn btn-success m-1" data-toggle="modal" data-target="#modal-otc"><i class="fa fa-envelope-o"></i> Send Email Reminder</button>
            </div>
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




  $(document).on('click', '.gen_salary', function(){  

   swal({
    title: "Are you sure?",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
   .then((willDelete) => {
    if (willDelete) {

      var action = 1;
      //$('.send_reminder').attr("href", "reminder.php?id="+id);
      $.ajax({
        url:"generator/salary-generator.php",
        method:"POST",
        data:{action:action},
        dataType:"json",
        success:function(data){
          swal(data, {
            icon: "success",
          });
        }
      })
    } else {
      swal("Bill generation if Failed!", {
        icon: "warning",
      });
      return false;
    }
  });
 });  

  $(document).on('click', '.gen_ups', function(){   
   swal({
    title: "Are you sure?",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
   .then((willDelete) => {
    if (willDelete) {

      var action = 1;
      //$('.send_reminder').attr("href", "reminder.php?id="+id);
      $.ajax({
        url:"generator/upstream-generator.php",
        method:"POST",
        data:{action:action},
        dataType:"json",
        success:function(data){
          swal(data, {
            icon: "success",
          });
        }
      })
    } else {
      swal("Bill generation if Failed!", {
        icon: "warning",
      });
      return false;
    }
  });
 });  


  $(document).on('click', '.gen_monthly_bill', function(){  
   var id = $(this).attr("id");  
   swal({
    title: "Are you sure?",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
   .then((willDelete) => {
    if (willDelete) {

      var action = 1;
      //$('.send_reminder').attr("href", "reminder.php?id="+id);
      $.ajax({
        url:"generator/monthly-bill-generator.php",
        method:"POST",
        data:{action:action},
        dataType:"json",
        success:function(data){
          swal(data, {
            icon: "success",
          });
        }
      })
    } else {
      swal("Bill generation if Failed!", {
        icon: "warning",
      });
      return false;
    }
  });
 });

   $(document).on('click', '.expire_unpaid_users', function(){   
   swal({
    title: "Are you sure?",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
   .then((willDelete) => {
    if (willDelete) {

      var action = 1;
      //$('.send_reminder').attr("href", "reminder.php?id="+id);
      $.ajax({
        url:"../../cron/expire_unpaid_users.php",
        method:"POST",
        data:{action:action},
        dataType:"json",
        success:function(data){
          swal(data, {
            icon: "success",
          });
        }
      })
    } else {
      swal("User Expiring Process Failed!", {
        icon: "error",
      });
      return false;
    }
  });
 });  
   $(document).on('click', '.disable_expired_users', function(){   
   swal({
    title: "Are you sure?",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
   .then((willDelete) => {
    if (willDelete) {

      var action = 1;
      //$('.send_reminder').attr("href", "reminder.php?id="+id);
      $.ajax({
        url:"../mikrotikApi/api_action/auto-disconnect-expired.php",
        method:"POST",
        data:{action:action},
        dataType:"json",
        success:function(data){
          swal(data, {
            icon: "success",
          });
        }
      })
    } else {
      swal("Disabling Proccess Failed!", {
        icon: "error",
      });
      return false;
    }
  });
 });  


});  
</script>

<div class="modal fade" id="modal-otc">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><b>OTC / Others Generator</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" method="POST" action="action/otc-action.php">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">User ID</label>
                  <input type="text" class="form-control" name="user_id">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Customer Name</label>
                  <input type="text" class="form-control" name="cus_name" >
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">On Account</label>
                  <input type="text" class="form-control" name="on_account" >
                </div>


                <!-- /.form-group -->

                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">

                <!-- /.form-group -->
                <div class="form-group">
                  <label for="exampleInputEmail1">Amount</label>
                  <input type="text" class="form-control" name="amount" >
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Generated By</label>
                  <input type="text" class="form-control" name="gen_by" Value="<?php echo $_SESSION['username']; ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Month</label>
                  <input type="text" class="form-control" name="month" Value="<?php echo date("F-Y") ?>" readonly>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->


        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" name="add" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>




<div class="modal fade" id="modal-sheet">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><b>Select Area</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" method="POST" action="../pdf/printBillingSheet.php">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group row">
                  <div class="col-sm-12">
                  Area/Branch</div>
                  <div class="col-sm-12">
                    <select class="form-control" name="area">

                      <option value="all">All</option>
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



                <!-- /.form-group -->

                <!-- /.form-group -->
              </div>
              <!-- /.col -->

            </div>
            <!-- /.card-body -->


          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>


</div>
</div>
</body>
</html>
