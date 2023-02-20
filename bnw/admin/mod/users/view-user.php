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
  <title>View User | <?php echo $siteName; ?></title>
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
      <h1>View Users</h1>
      <ol class="breadcrumb">
        <li><a href="#">Users</a></li>
        <li><i class="fa fa-angle-right"></i> view-user</li>
      </ol>
    </div>
    
    <!-- Main content -->
    <div class="content">
      <div class="info-box">

       
        <div id="demo">
          <form id="adduser" method="POST">
            <div class="step-app">
              <ul class="step-steps">
                <li><a href="#tab1"><span class="number">1</span> Personal Info</a></li>
                <li><a href="#tab2"><span class="number">2</span> Connection Info</a></li>
                <li><a href="#tab3"><span class="number">3</span> Billing Info</a></li>
                <li><a href="#tab4"><span class="number">4</span> Technical Info</a></li>
              </ul>
              <div class="step-content">

                <div class="step-tab-panel" id="tab1">

                  <div class="row m-t-2">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="firstName1">User-ID:</label>
                        <input class="form-control" type="text" name="username" value="<?php echo $result['username']; ?>" readonly >
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="lastName1">Customer'Name:</label>
                        <input class="form-control" type="text" name="cus_name" value="<?php echo $result['cus_name']; ?>" readonly >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="firstName1">Organization/Father's Name:</label>
                        <input class="form-control" type="text" name="com_name" value="<?php echo $result['com_name']; ?>" readonly >
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="lastName1">Address:</label>
                        <input class="form-control" type="text" name="conn_address" value="<?php echo $result['conn_address']; ?>" readonly  >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="firstName1">Mobile No:</label>
                        <input class="form-control" type="text" name="mobile" value="<?php echo $result['mobile']; ?>; <?php echo $result['mobile2']; ?>" readonly >
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="lastName1">Email Address:</label>
                        <input class="form-control" type="text" name="email" value="<?php echo $result['email']; ?>" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="location1">Area :</label>
                        <select class="custom-select form-control" id="area" name="area" readonly>
                          <option selected><?php echo $result['area']; ?></option>

                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="lastName1">NID/Passport No:</label>
                        <input class="form-control" type="text" name="nidNo" value="<?php echo $result['nidNo']; ?>" readonly>
                      </div>
                    </div>
                  </div>

                </div>
                <div class="step-tab-panel" id="tab2">


                 <div class="row m-t-2">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="date1">Activation Date :</label>
                      <input class="form-control" id="date1" name="activation_date" type="date" value="<?php echo $result['activation_date']; ?>" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                   <div class="form-group">
                    <label for="intType1">Connection Type :</label>
                    <select class="custom-select form-control" data-placeholder="Type to search cities" name="conn_type" readonly>
                      <option><?php echo $result['conn_type']; ?></option>
                      <option value="Home">Home</option>
                      <option value="Dedicated">Dedicated</option>
                      <option value="Corporate">Corporate</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="intType1">Package :</label>
                    <select class="custom-select form-control" data-placeholder="Type to search cities" name="pack_name" readonly >
                      <option><?php echo $result['pack_name']; ?></option>

                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="lastName1">ONT / ONU MAC:</label>
                    <input class="form-control" type="text" name="ont_mac" value="<?php echo $result['ont_mac']; ?>" readonly>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="firstName1">IP Address:</label>
                    <input class="form-control" type="text" name="ip_address" value="<?php echo $result['ip_address']; ?>" readonly>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="lastName1">Fiber Code:</label>
                    <input class="form-control" type="text" name="fiberCode" value="<?php echo $result['fiberCode']; ?>" readonly>
                  </div>
                </div>
              </div>

            </div>
            <div class="step-tab-panel" id="tab3">


              <div class="row m-t-2">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="firstName1">Monthly Bill:</label>
                    <input class="form-control" type="text" name="monthly_bill" value="<?php echo $result['monthly_bill']; ?>" readonly >
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="lastName1">Current Due:</label>
                    <input class="form-control" type="text" name="due" value="<?php echo $result['due']; ?>" readonly >
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                 <div class="form-group">
                  <label for="intType1">Billing Cycle :</label>
                  <select class="custom-select form-control" data-placeholder="Type to search cities" name="billing_type" readonly>
                    <option><?php echo $result['billing_type']; ?></option>
                    <option value="Prepaid">Prepaid</option>
                    <option value="Postpaid">Postpaid</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="intType1">Reference :</label>
                  <select class="custom-select form-control" data-placeholder="Type to search cities" name="reference" readonly >
                    <option><?php echo $result['reference']; ?></option>

                  </select>
                </div>
              </div>
            </div>

          </div>
          <div class="step-tab-panel" id="tab4">


            <div class="row m-t-2">
              <div class="col-md-6">
               <div class="form-group">
                <label for="participants1">Account Status</label>
                <select class="custom-select form-control" id="participants1" name="status" readonly>
                  <option value="Active"><?php echo $result['status']; ?></option>

                </select>
              </div>

              <div class="form-group">
                <label for="participants1">API Package</label>
                <select class="custom-select form-control" id="apiPackage" name="location" disabled>
                  <option value=""><?php echo $result['apiServer']; ?></option>

                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="participants1">API Server</label>
                <select class="custom-select form-control" id="apiServer" name="apiServer" disabled >
                  <option value=""><?php echo $result['apiServer']; ?></option>

                </select>
              </div>
              <div class="form-group">
                <label>Other Settings :</label>
                <div class="c-inputs-stacked">
                  <label class="inline custom-control custom-checkbox block">
                    <?php
                    if($result['sendSms']==1){
                      echo '<input class="custom-control-input" type="checkbox" name="sendSms" checked>';
                    }else{
                      echo '<input class="custom-control-input" type="checkbox" name="sendSms">';
                    }
                    ?>
                    <span class="custom-control-indicator"></span> <span class="custom-control-description ml-0">SendSMS</span> </label>
                    <label class="inline custom-control custom-checkbox block">
                      <?php
                      if($result['sendEmail']==1){
                        echo '<input class="custom-control-input" type="checkbox" name="SendEmail" checked>';
                      }else{
                        echo '<input class="custom-control-input" type="checkbox" name="SendEmail">';
                      }
                      ?>
                      <span class="custom-control-indicator"></span> <span class="custom-control-description ml-0">SendEmail</span> </label>
                      <label class="inline custom-control custom-checkbox block">
                       <?php
                       if($result['printInvoice']==1){
                        echo '<input class="custom-control-input" type="checkbox" name="PrintInvoice" checked>';
                      }else{
                        echo '<input class="custom-control-input" type="checkbox" name="PrintInvoice">';
                      }
                      ?>
                      <span class="custom-control-indicator"></span> <span class="custom-control-description ml-0">PrintInvoice</span> </label>
                      <label class="inline custom-control custom-checkbox block">
                        <?php
                        if($result['apiEnabled']==1){
                          echo '<input class="custom-control-input" type="checkbox" name="apiEnabled" checked>';
                        }else{
                          echo '<input class="custom-control-input" type="checkbox" name="apiEnabled">';
                        }
                        ?>
                        <span class="custom-control-indicator"></span> <span class="custom-control-description ml-0">APIEnabled</span> </label>
                        <label class="inline custom-control custom-checkbox block">

                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
              <div class="step-footer">
                <button data-direction="prev" class="btn btn-light">Previous</button>
                <button data-direction="next" class="btn btn-primary">Next</button>
                <button data-direction="finish" class="btn btn-primary">Submit</button>
              </div>
            </div>
          </div>
        </div>
      </form>
      <!-- Main row --> 
      <div class="card">
        <div class="card-body">
          <center>
          <button class="btn btn-primary" data-toggle="modal" data-target="#modal-billing-history"><i class="fa fa-eye"></i> View Biling History</button>
          <button class="btn btn-success" data-toggle="modal" data-target="#modal-ticket-history"><i class="fa fa-eye"></i> View Ticket History</button>
          <button class="btn btn-info" data-toggle="modal" data-target="#modal-send-sms"><i class="fa fa-paper-plane"></i> Send SMS</button>
          <button class="btn btn-secondary gen_bill" data-toggle="modal" data-target="#modal-generate-bill"><i class="fa fa-plus"></i> Generate Bill</button>
          <a href="../pdf/generateInvoiceSingleUser.php?id=<?php echo $result['id']; ?>"><button class="btn btn-warning"><i class="fa fa-print"></i> Print Invoice</button></a>
          <a href="../pdf/billingStatement.php?id=<?php echo $result['id']; ?>"><button class="btn btn-dark"><i class="fa fa-print"></i> Billing Statement</button></a>
        </center>
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

     var userType =  '<?php echo $_SESSION['role'];?>';
     if(userType != 'admin'){
      $('.gen_bill').hide();
     }
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
