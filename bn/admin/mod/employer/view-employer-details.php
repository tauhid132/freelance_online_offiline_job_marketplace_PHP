<?php
// Initialize the session
session_start();
include ('../../../database/dbconnect.php');


// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: ../../../login.php");
  exit;
}
$id=$_GET['id'];
$query=mysqli_query($conn,"select * from `employer` where id='$id'");
$result=mysqli_fetch_array($query);


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
      <h1>View Employer Details</h1>
      <ol class="breadcrumb">
        <li><a href="#">Users</a></li>
        <li><i class="fa fa-angle-right"></i> view-user</li>
      </ol>
    </div>
    
    <!-- Main content -->
    <div class="content">
      <div class="info-box">
        <div class="row m-t-2">
          <div class="col-md-6">
            <div class="form-group">
              <label for="firstName1">Full Name:</label>
              <input class="form-control" type="text" name="username" value="<?php echo $result['fullName']; ?>" readonly >
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="lastName1">Email Address:</label>
              <input class="form-control" type="text" name="cus_name" value="<?php echo $result['emailAddress']; ?>" readonly >
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="firstName1">Join Date:</label>
              <input class="form-control" type="text" name="com_name" value="<?php echo $result['joinDate']; ?>" readonly >
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="lastName1">Gender:</label>
              <input class="form-control" type="text" name="conn_address" value="<?php echo $result['gender']; ?>" readonly  >
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="firstName1">Street:</label>
              <input class="form-control" type="text" name="mobile" value="<?php echo $result['streetNo']; ?>" readonly >
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="lastName1">Thana</label>
              <input class="form-control" type="text" name="email" value="<?php echo $result['policeStation']; ?>" readonly>
            </div>
          </div>
        </div>
        <div class="row">
         <div class="col-md-6">
          <div class="form-group">
            <label for="lastName1">District</label>
            <input class="form-control" type="text" name="email" value="<?php echo $result['district']; ?>" readonly>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="lastName1">Mobile No:</label>
            <input class="form-control" type="text" name="nidNo" value="<?php echo $result['mobileNo']; ?>" readonly>
          </div>
        </div>
      </div>

    </div>


    <!-- Main row --> 
    <div class="card">
      <div class="card-body">
        <center>
          <button class="btn btn-primary" data-toggle="modal" data-target="#modal-billing-history"><i class="fa fa-eye"></i> View Job Posts</button>
          <button class="btn btn-success" data-toggle="modal" data-target="#modal-ticket-history"><i class="fa fa-eye"></i> View Hired Employees</button>
          <button class="btn btn-info" data-toggle="modal" data-target="#modal-send-sms"><i class="fa fa-paper-plane"></i> Send View Job Offers</button>
          <!-- <button class="btn btn-secondary gen_bill" data-toggle="modal" data-target="#modal-generate-bill"><i class="fa fa-plus"></i> Generate Bill</button>
          <a href="../pdf/generateInvoiceSingleUser.php?id=<?php echo $result['id']; ?>"><button class="btn btn-warning"><i class="fa fa-print"></i> Print Invoice</button></a>
          <a href="../pdf/billingStatement.php?id=<?php echo $result['id']; ?>"><button class="btn btn-dark"><i class="fa fa-print"></i> Billing Statement</button></a> -->
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
          <h4 class="modal-title">Job Posts</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="table-responsive">
            <table class="table m-0">
              <?php
              $i=1;         
              $email= $result['emailAddress'];
              $sql = "SELECT * FROM job_posts WHERE email = '$email'";
              if($result3 = mysqli_query($conn, $sql)){
                if(mysqli_num_rows($result3) > 0){

                  echo '  <thead>';
                  echo '  <tr>';
                  echo ' <th>No</th>';
                  echo '<th>Job Title</th>';
                  echo '<th>Service Category</th>';
                  echo ' <th>Working Type</th>';
                  echo ' <th>Deadline</th>';
                  echo ' <th>Job Salary</th>';
                  echo ' <th>Posted On</th>';
                  echo ' <th>Status</th>';

                  echo '  </tr>';
                  echo '   </thead>';
                  echo '   <tbody>';
                  while($row = mysqli_fetch_array($result3)){

                    echo "<tr>";
                    echo "<td>" . $i . "</td>";
                    echo "<td>" . $row['jobTitle'] . "</td>";
                    echo "<td>" . $row['serviceCategory'] . "</td>";
                    echo "<td>" . $row['jobWorkingType'] . "</td>";
                    echo "<td>" . $row['jobDeadline'] . "</td>";
                    echo "<td>" . $row['jobSalary'] . "</td>";
                    echo "<td>" . $row['postedOn'] . "</td>";
                    if($row['jobStatus']== 2)
                      echo '<td><span class="label label-success">Completed</span></td>'; 
                    else if($row['jobStatus']==1)
                      echo '<td><span class="label label-warning">Hired</span></td>';
                    else if($row['jobStatus']==0)
                      echo '<td><span class="label label-danger">Pending</span></td>';
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
        <h4 class="modal-title">Hired Employees</h4>
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
            $email = $result['emailAddress'];
            $sql2 = "SELECT * , hire_employee.id as hid FROM (hire_employee JOIN service_portfolio ON hire_employee.servicePortfolioId = service_portfolio.id) JOIN employee ON hire_employee.employeeEmail = employee.emailAddress WHERE hire_employee.employerEmail = '$email' order by hireTime desc";
            if($result4 = mysqli_query($conn, $sql2)){
              if(mysqli_num_rows($result4) > 0){

                echo "<thead>";
                echo "<tr>";
                echo "<th>No</th>";
                echo "<th>Job No</th>";
                echo "<th>Employee/Worker</th>";
                echo "<th>Service Name</th>";
                echo "<th>Status</th>";

                echo "</tr>";
                echo "</thead>";
                while($row = mysqli_fetch_array($result4)){
                  echo "<thead>";
                  echo "<tr>";
                  echo "<td>" . $j . "</td>";
                  echo "<td>JOB-" . $row['hid'] . "</td>";
                  echo '<td><img class="datatable_image" src="../'.$row['imageLink'].'" alt="">'. $row['fullName'] .'</td>';
                            // echo "<td>" . $row['fullName'] . "</td>";
                  echo "<td>" . $row['service_name'] . "</td>";
                  if($row['jobStatus']== 0)
                    echo '<td><span class="label label-info">Hired</span></td>'; 
                  else if($row['jobStatus']==1)
                    echo '<td><span class="label label-warning">On Progress</span></td>';
                  else if($row['jobStatus']==2)
                    echo '<td><span class="label label-success">Completed</span></td>';



                  

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
        <h4 class="modal-title">Offered Jobs Invitation</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table m-0">
            <?php

// Attempt select query execution
            $l=1;
            $email = $result['emailAddress'];
            $sql2 = "SELECT * , job_offers.status as jStatus, job_offers.id as jid FROM job_offers join service_portfolio on job_offers.serviceId = service_portfolio.id join employee on service_portfolio.employee_email = employee.emailAddress WHERE job_offers.offeredBy = '$email'";
            if($result4 = mysqli_query($conn, $sql2)){
              if(mysqli_num_rows($result4) > 0){

                echo "<thead>";
                echo "<tr>";
                echo "<th>No</th>";
                echo "<th>Employee Name</th>";
                echo "<th>Service</th>";
               
                echo "<th>Status</th>";

                echo "</tr>";
                echo "</thead>";
                while($row = mysqli_fetch_array($result4)){
                  echo "<thead>";
                  echo "<tr>";
                  echo "<td>" . $l . "</td>";

                  echo '<td><img class="datatable_image" src="../'.$row['imageLink'].'" alt="">'. $row['fullName'] .'</td>';
                  echo "<td>" . $row['service_name'] . "</td>";
                  if($row['jStatus']== 1)
                    echo '<td><span class="label label-success">Accepted</span></td>'; 
                  else if($row['jStatus']==0)
                    echo '<td><span class="label label-warning">Pending</span></td>';
                  else if($row['jStatus']==2)
                    echo '<td><span class="label label-danger">Declined</span></td>';




                

                  $l++;

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
      <!-- /.modal-content -->
    </div>
    <div class="modal-footer justify-content-between">
      <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

    </div>
    <!-- /.modal-dialog -->
  </div>

</body>
</html>
