<?php
// Initialize the session
session_start();
include('../../db/conn.php');


// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: ../../login.php");
  exit;
}
$id=$_GET['id'];
$query=mysqli_query($conn,"select * from `users` where id='$id'");
$result=mysqli_fetch_array($query);
$query=mysqli_query($conn,"select * from `users` where id='$id'");
$result2=mysqli_fetch_array($query);

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>View IDs | <?php echo $siteName; ?></title>
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
      <h1>View IDs</h1>
      <ol class="breadcrumb">
        <li><a href="#">Users</a></li>
        <li><i class="fa fa-angle-right"></i> view-user</li>
      </ol>
    </div>
    
    <!-- Main content -->
    <div class="content">
      
      <div class="info-box">

      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
             <th>No</th>
             <th>Usename</th>
             <th>Password</th>
             <th>Status</th>
             <th>Action</th>
             <th>Package</th>
             <th>Activation</th>
             <!-- <th>Area</th>
             <th>Mobile</th>
             <th>Monthly Bill</th>
             <th>Current Due</th> -->
           </tr>
         </thead>
         <tbody>
          <?php

// Attempt select query execution
          $sql = "SELECT * FROM resellerMac WHERE reseller_id='RSL0187'";
          if($result = mysqli_query($conn, $sql)){
            if(mysqli_num_rows($result) > 0){

              while($row = mysqli_fetch_array($result)){

                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['password'] . "</td>";
                if($row['status']=='1')
                  echo '<td><span class="label label-success">Active</span></td>'; 
                else if($row['status']=='0')
                  echo '<td><span class="label label-danger">Inactive</span></td>';
                echo '<td>
                <a href="view-mac.php?id=' . $row['username'] . '">
                <i class="fa fa-eye text-info " style="font-size:20px"></i>
                </a>
                <a href="edit-user.php?id=' . $row['id'] . '">
                <i class="fa fa-edit " style="font-size:20px"></i>
                </a>

                <i class="fa fa-trash text-danger delete_user" id=' . $row['id'] . ' style="font-size:20px"></i>

                </td>';
                echo "<td>" . $row['package'] . "</td>";
                echo "<td>" . $row['activation_date'] . "</td>";
                // echo "<td>" . $row['mobile'] . "</td>";
                // echo "<td>" . $row['monthly_bill'] . "</td>";
                // echo "<td>" . $row['due'] . "</td>";



        //echo "<td>" . $row['due'] . "</td>";









                echo "</tr>";

              }

        // Free result set
              mysqli_free_result($result);
            } else{
              echo "No records matching your query were found.";
            }
          } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
          }


          ?>

        </tbody>
        <tfoot>

        </tfoot>
      </table>
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
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<script>
  var adduser = $('#adduser');
  var frmResValidator = adduser.validate();
  $('#demo').steps({
    onChange: function (currentIndex, newIndex, stepDirection) {
      console.log('onChange', currentIndex, newIndex, stepDirection);
        // tab1
        if (currentIndex === 0) {
          if (stepDirection === 'forward') {
            var valid = adduser.valid();
            return valid;
          }
          if (stepDirection === 'backward') {
            frmResValidator.resetForm();
          }
        }

    // tab2
    if (currentIndex === 1) {
      if (stepDirection === 'forward') {
        var valid = adduser.valid();
        return valid;
      }
      if (stepDirection === 'backward') {
        frmResValidator.resetForm();
      }
    }

        // tab3
        if (currentIndex === 2) {
          if (stepDirection === 'forward') {
            var valid = adduser.valid();
            return valid;
          }
          if (stepDirection === 'backward') {
            frmResValidator.resetForm();
          }
        }

        // tab4
        if (currentIndex === 3) {
          if (stepDirection === 'forward') {
            var valid = adduser.valid();
            return valid;
          }
          if (stepDirection === 'backward') {
            frmResValidator.resetForm();
          }
        }

        return true;

      },
      onFinish: function () {
       $('form#adduser').submit();
     }
   });
    // $('#demo').steps({
    //   onFinish: function () {
    //    $('form#adduser').submit();
    //   }
    // });
  </script>
  <script type="text/javascript">
    $(document).ready(function(){
      $('#enableAPi').change(function(){
        $('#apiServer').prop("disabled",false);
        $('#apiPackage').prop("disabled",false);
      });
    });
  </script>
  
 <div class="modal fade" id="modal-billing-history">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Billing History</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table m-0">
            <?php
            $i=1;         
            $user_id= $result['username'];
            $sql = "SELECT * FROM billing WHERE user_id = '$user_id'";
            if($result3 = mysqli_query($conn, $sql)){
              if(mysqli_num_rows($result3) > 0){

                echo '  <thead>';
                echo '  <tr>';
                echo ' <th>No</th>';
                echo '<th>Billing Month</th>';
                echo '<th>Monthly Bill</th>';
                echo ' <th>Previous Due</th>';
                echo ' <th>Paid Bill</th>';
                echo ' <th>Paid Due</th>';
                echo ' <th>Date</th>';
                echo ' <th>Pay Method</th>';
                echo ' <th>Received By</th>';
                echo '  </tr>';
                echo '   </thead>';
                echo '   <tbody>';
                while($row = mysqli_fetch_array($result3)){

                  echo "<tr>";
                  echo "<td>" . $i . "</td>";
                  echo "<td>" . $row['billing_month'] . "</td>";
                  echo "<td>" . $row['monthly_bill'] . "</td>";
                  echo "<td>" . $row['pre_due'] . "</td>";
                  echo "<td>" . $row['paid_bill'] . "</td>";
                  echo "<td>" . $row['paid_due'] . "</td>";
                  echo "<td>" . $row['pay_date'] . "</td>";
                  echo "<td>" . $row['pay_method'] . "</td>";
                  echo "<td>" . $row['received_by'] . "</td>";
                  echo "</tr>";
                  $i++;

                }

        // Free result set
                mysqli_free_result($result3);
              } else{
                echo "No Billing History available.";
              }
            } else{
              echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
            }
 // Close connection


            ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="modal-footer justify-content-between">
      <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

    </div>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-ticket-history">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Ticket History</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table m-0">
            <?php

// Attempt select query execution
            $j=1;
            $user_id = $result2['username'];
            $sql2 = "SELECT * FROM tickets WHERE user_id = '$user_id'";
            if($result4 = mysqli_query($conn, $sql2)){
              if(mysqli_num_rows($result4) > 0){

                echo "<thead>";
                echo "<tr>";
                echo "<th>No</th>";
                echo "<th>Created Time</th>";
                echo "<th>Ticket Type</th>";
                echo "<th>Details</th>";
                echo "<th>Status</th>";

                echo "</tr>";
                echo "</thead>";
                while($row = mysqli_fetch_array($result4)){
                  echo "<thead>";
                  echo "<tr>";
                  echo "<td>" . $j . "</td>";
                  echo "<td>" . $row['create_time'] . "</td>";
                  echo "<td>" . $row['ticket_type'] . "</td>";
                  echo "<td>" . $row['ticket_details'] . "</td>";
                  echo "<td>" . $row['status'] . "</td>";
                  $j++;




                  echo "</tr>";
                  echo "</thead>";
                }
                echo "</table>";
        // Free result set
                mysqli_free_result($result4);
              } else{
                echo "No Ticket History available!";
              }
            } else{
              echo "ERROR: Could not able to execute $sql2. " . mysqli_error($conn);
            }

// Close connection

            ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="modal-footer justify-content-between">
      <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

    </div>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>


<div class="modal fade" id="modal-generate-bill">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Generate Bill</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" method="POST" action="action/generate-singal-bill-action.php">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">User-ID</label>
                  <input type="text" class="form-control" name="user_id" value="<?php echo $result['username']; ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Monthly Bill</label>
                  <input type="text" class="form-control" name="monthly_bill" value="<?php echo $result['monthly_bill']; ?>">
                </div>


                <!-- /.form-group -->

                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Customer Name</label>
                  <input type="text" class="form-control" name="cus_name" value="<?php echo $result['cus_name']; ?>" readonly>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label for="exampleInputEmail1">Prevoius Due Bill</label>
                  <input type="text" class="form-control" name="due" value="<?php echo $result['due']; ?>">
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
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" name="add" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>




<div class="modal fade" id="modal-send-sms">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Send SMS</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" method="POST" action="action/single-sms.php">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <input type="hidden" name="mobile" value="<?php echo $result['mobile']; ?>">
                <div class="form-group">
                  <label for="exampleInputEmail1">Text / Messege Body</label>
                  <textarea type="text" class="form-control" name="smsbody"></textarea>
                </div>
              </div>
            </div>
            <!-- /.row -->
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" name="add" class="btn btn-primary"><i class="fa fa-paper-plane"></i>Send</button>
        </div>
      </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

</body>
</html>
