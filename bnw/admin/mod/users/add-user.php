<?php
session_start();
include('../../db/conn.php');

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Add New User | <?php echo $siteName; ?></title>
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
      <!-- <h1>All Users List</h1> -->
      <ol class="breadcrumb">
        <li><a href="#">Users</a></li>
        <li><i class="fa fa-angle-right"></i> Add new</li>
      </ol>
    </div>
    
    <!-- Main content -->
    <div class="content">
      <div class="info-box">

        <h4 class="text-black m-b-3">Add New User</h4>
        <div id="demo">
          <form id="adduser" method="POST"  action="action/add-user-action.php">
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
                        <input class="form-control" type="text" name="username" >
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="lastName1">Customer'Name:</label>
                        <input class="form-control" type="text" name="cus_name" >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="firstName1">Organization/Father's Name:</label>
                        <input class="form-control" type="text" name="com_name" >
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="lastName1">Address:</label>
                        <input class="form-control" type="text" name="conn_address"  >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="firstName1">Mobile No: (Primary) </label><i class="fa fa-plus text-info add_second_mobile" style="float:right;"> Add Secondary</i>
                        <input class="form-control" type="text" name="mobile"  >
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="lastName1">Email Address:</label>
                        <input class="form-control" type="text" name="email" >
                      </div>
                    </div>
                    <div class="col-md-6 second_mobile">
                      <div class="form-group">
                        <label for="firstName1">Mobile No: (Secondary) </label>
                        <input class="form-control" type="text" name="mobile2"  >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="location1">Area :</label>
                        <select class="custom-select form-control" id="area" name="area">
                          <option selected>Select One Area/Branch</option>
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
                      <label for="lastName1">NID/Passport No:</label>
                      <input class="form-control" type="text" name="nidNo" >
                    </div>
                  </div>
                </div>
              
            </div>
            <div class="step-tab-panel" id="tab2">
             
              
               <div class="row m-t-2">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="date1">Activation Date :</label>
                    <input class="form-control" id="date1" name="activation_date" type="date">
                  </div>
                </div>
                <div class="col-md-6">
                 <div class="form-group">
                  <label for="intType1">Connection Type :</label>
                  <select class="custom-select form-control" data-placeholder="Type to search cities" name="conn_type" >
                    <option>Select One</option>
                    <option value="Home">Home</option>
                    <option value="Dedicated">Dedicated</option>
                   <!--  <option value="Corporate">Corporate</option> -->
                   <option value="Mac-Reseller">Mac-Reseller</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="intType1">Package :</label>
                  <select class="custom-select form-control" data-placeholder="Type to search cities" name="pack_name" >
                    <option>Select One</option>
                    <?php
                    $sql7 = "SELECT * FROM monthly_plans";
                    if($result7 = mysqli_query($conn, $sql7)){
                      if(mysqli_num_rows($result7) > 0){
                        while($row = mysqli_fetch_array($result7)){
                          echo '<option value="'. $row['planName'] .'">' . $row['planName'] . '</option>';
                        }
                      }
                    } 
                    ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="lastName1">ONT / ONU MAC:</label>
                  <input class="form-control" type="text" name="ont_mac" >
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="firstName1">IP Address:</label>
                  <input class="form-control" type="text" name="ip_address" >
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="lastName1">Fiber Code:</label>
                  <input class="form-control" type="text" name="fiberCode" >
                </div>
              </div>
            </div>
         
        </div>
        <div class="step-tab-panel" id="tab3">
         
          
            <div class="row m-t-2">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="firstName1">Monthly Bill:</label>
                  <input class="form-control" type="text" name="monthly_bill"  >
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="lastName1">Prevoius Due(If any):</label>
                  <input class="form-control" type="text" name="due" >
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
               <div class="form-group">
                <label for="intType1">Billing Cycle :</label>
                <select class="custom-select form-control" data-placeholder="Type to search cities" name="billing_type" >
                  <option>Select One</option>
                  <option value="Prepaid">Prepaid</option>
                  <option value="Postpaid">Postpaid</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="intType1">Reference :</label>
                <select class="custom-select form-control" data-placeholder="Type to search cities" name="reference" >
                  <option value="No Reference">No Reference</option>
                  <option value="User Reference">User Reference</option>
                  <option value="Advertisement">Advertisement</option>
                  <?php
                  $sql6 = "SELECT * FROM employee";
                  if($result6 = mysqli_query($conn, $sql6)){
                    if(mysqli_num_rows($result6) > 0){
                      while($row = mysqli_fetch_array($result6)){
                        echo '<option value="'. $row['username'] .'">' . $row['fullName'] . '</option>';
                      }
                    }
                  } 
                  ?>
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
              <select class="custom-select form-control" id="participants1" name="status">
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
                <option value="Expired">Expired</option>
              </select>
            </div>

            <div class="form-group">
              <label for="participants1">API Package</label>
              <select class="custom-select form-control" id="apiPackage" name="location" disabled>
                <option value="">Select Result</option>
                <?php
                  $sql7 = "SELECT * FROM mikrotiklist";
                  if($result7 = mysqli_query($conn, $sql7)){
                    if(mysqli_num_rows($result7) > 0){
                      while($row = mysqli_fetch_array($result7)){
                        echo '<option value="'. $row['serverName'] .'">' . $row['serverName'] . '</option>';
                      }
                    }
                  } 
                  ?>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="participants1">API Server</label>
              <select class="custom-select form-control" id="apiServer" name="apiServer" disabled >
                <option value="">Select One</option>
                <?php
                  $sql7 = "SELECT * FROM mikrotiklist";
                  if($result7 = mysqli_query($conn, $sql7)){
                    if(mysqli_num_rows($result7) > 0){
                      while($row = mysqli_fetch_array($result7)){
                        echo '<option value="'. $row['serverName'] .'">' . $row['serverName'] . '</option>';
                      }
                    }
                  } 
                  ?>
              </select>
            </div>
            <div class="form-group">
              <label>Other Settings :</label>
              <div class="c-inputs-stacked">
                <label class="inline custom-control custom-checkbox block">
                  <input class="custom-control-input" type="checkbox" name="sendSms">
                  <span class="custom-control-indicator"></span> <span class="custom-control-description ml-0">SendSMS</span> </label>
                  <label class="inline custom-control custom-checkbox block">
                    <input class="custom-control-input" type="checkbox" name="sendEmail">
                    <span class="custom-control-indicator"></span> <span class="custom-control-description ml-0">SendEmail</span> </label>
                    <label class="inline custom-control custom-checkbox block">
                      <input class="custom-control-input" type="checkbox" name="printInvoice">
                      <span class="custom-control-indicator"></span> <span class="custom-control-description ml-0">PrintInvoice</span> </label>
                      <label class="inline custom-control custom-checkbox block">
                        <input class="custom-control-input" type="checkbox" id="enableAPi" name="apiEnabled">
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
      $('.second_mobile').hide();

      $('.add_second_mobile').click(function(){
        $('.second_mobile').show();
      });
      $('#enableAPi').change(function(){
      $('#apiServer').prop("disabled",false);
      $('#apiPackage').prop("disabled",false);
    });
    });
  </script>
  
  <!-- jQuery 3 --> 

</body>
</html>
