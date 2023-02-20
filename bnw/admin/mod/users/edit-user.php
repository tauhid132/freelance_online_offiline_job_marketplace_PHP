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
  <title>Edit User | <?php echo $siteName; ?></title>
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
        <li><i class="fa fa-angle-right"></i> Edit User</li>
      </ol>
    </div>
    
    <!-- Main content -->
    <div class="content">
      <div class="info-box">

        <h4 class="text-black m-b-3">Edit User</h4>
        <div id="demo">
          <form id="adduser" method="POST"  action="action/update-user-action.php?id=<?php echo $id; ?>">
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
                        <input class="form-control" type="text" name="username" value="<?php echo $result['username']; ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="lastName1">Customer'Name:</label>
                        <input class="form-control" type="text" name="cus_name" value="<?php echo $result['cus_name']; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="firstName1">Organization/Father's Name:</label>
                        <input class="form-control" type="text" name="com_name" value="<?php echo $result['com_name']; ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="lastName1">Address:</label>
                        <input class="form-control" type="text" name="conn_address" value="<?php echo $result['conn_address']; ?>" >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="firstName1">Mobile No:</label><i class="fa fa-plus text-info add_second_mobile" style="float:right;"> Add Secondary</i>
                        <input class="form-control" type="text" name="mobile" value="<?php echo $result['mobile']; ?>" >
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="lastName1">Email Address:</label>
                        <input class="form-control" type="text" name="email" value="<?php echo $result['email']; ?>" >
                      </div>
                    </div>
                     <div class="col-md-6 second_mobile">
                      <div class="form-group">
                        <label for="firstName1">Mobile No: (Secondary) </label>
                        <input class="form-control" type="text" name="mobile2" value="<?php echo $result['mobile2']; ?>"  >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="location1">Area :</label>
                        <select class="custom-select form-control" id="area" name="area">
                          <option selected><?php echo $result['area']; ?></option>
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
                      <input class="form-control" type="text" name="nidNo" value="<?php echo $result['nidNo']; ?>" >
                    </div>
                  </div>
                </div>

              </div>
              <div class="step-tab-panel" id="tab2">


               <div class="row m-t-2">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="date1">Activation Date :</label>
                    <input class="form-control" id="date1" name="activation_date" type="date" value="<?php echo $result['activation_date']; ?>">
                  </div>
                </div>
                <div class="col-md-6">
                 <div class="form-group">
                  <label for="intType1">Connection Type :</label>
                  <select class="custom-select form-control" data-placeholder="Type to search cities" name="conn_type" >
                    <option selected><?php echo $result['conn_type']; ?></option>
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
                    <option selected><?php echo $result['pack_name']; ?></option>
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
                  <input class="form-control" type="text" name="ont_mac" value="<?php echo $result['ont_mac']; ?>" >
                </div>
              </div>
            </div>
            <div class="row">

              <div class="col-md-6">
                <div class="form-group">
                  <label for="firstName1">IP Address:</label>
                  <input class="form-control" type="text" name="ip_address" value="<?php echo $result['ip_address']; ?>" >
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="lastName1">Fiber Code:</label>
                  <input class="form-control" type="text" name="fiberCode" value="<?php echo $result['fiberCode']; ?>">
                </div>
              </div>
            </div>

          </div>
          <div class="step-tab-panel" id="tab3">


            <div class="row m-t-2">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="firstName1">Monthly Bill:</label>
                  <input class="form-control" type="text" name="monthly_bill" value="<?php echo $result['monthly_bill']; ?>"  >
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="lastName1">Prevoius Due(If any):</label>
                  <input class="form-control" type="text" name="due" value="<?php echo $result['due']; ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
               <div class="form-group">
                <label for="intType1">Billing Cycle :</label>
                <select class="custom-select form-control" data-placeholder="Type to search cities" name="billing_type" >
                  <option selected><?php echo $result['billing_type']; ?></option>
                  <option value="Prepaid">Prepaid</option>
                  <option value="Postpaid">Postpaid</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="intType1">Reference :</label>
                <select class="custom-select form-control" data-placeholder="Type to search cities" name="reference" >
                  <option selected><?php echo $result['reference']; ?></option>
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
                <option selected><?php echo $result['status']; ?></option>
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
              <select class="custom-select form-control" id="apiServer" name="apiServer"  >
                <option selected=""><?php echo $result['apiServer']; ?></option>
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
                  <?php
                  if($result['sendSms']==1){
                    echo '<input class="custom-control-input" type="checkbox" name="sendSms" checked value="yes">';
                  }else{
                    echo '<input class="custom-control-input" type="checkbox" name="sendSms">';
                  }
                  ?>
                  <span class="custom-control-indicator"></span> <span class="custom-control-description ml-0">SendSMS</span> </label>
                  <label class="inline custom-control custom-checkbox block">
                    <?php
                    if($result['sendEmail']==1){
                      echo '<input class="custom-control-input" type="checkbox" name="sendEmail" checked value="yes">';
                    }else{
                      echo '<input class="custom-control-input" type="checkbox" name="sendEmail">';
                    }
                    ?>
                    <span class="custom-control-indicator"></span> <span class="custom-control-description ml-0">SendEmail</span> </label>
                    <label class="inline custom-control custom-checkbox block">
                     <?php
                     if($result['printInvoice']==1){
                      echo '<input class="custom-control-input" type="checkbox" name="printInvoice" checked value="yes"> ';
                    }else{
                      echo '<input class="custom-control-input" type="checkbox" name="printInvoice">';
                    }
                    ?>
                    <span class="custom-control-indicator"></span> <span class="custom-control-description ml-0">PrintInvoice</span> </label>
                    <label class="inline custom-control custom-checkbox block">
                      <?php
                      if($result['apiEnabled']==1){
                        echo '<input class="custom-control-input" type="checkbox" name="apiEnabled" checked value="yes">';
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
          <button class="btn btn-info change_password" ><i class="fa fa-unlock-alt"></i> Change Password</button>
          <button class="btn btn-success" data-toggle="modal" data-target="#modal-send-sms"><i class="fa f fa-share-square-o"></i> Shift to left</button>
          <button class="btn btn-danger clear_data" ><i class="fa fa-trash"></i> Clear Data</button>

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

<div class="modal fade" id="modal-send-sms">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Shift Client</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="leftClientForm">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <div class="form-group">
                  <label for="exampleInputEmail1">Reason</label>
                  <input type="text" class="form-control" name="leftReason">
                </div>
              </div>
              <div class="col-md-6">
               <div class="form-group">
                <label for="exampleInputEmail1">Date</label>
                <input type="date" class="form-control" name="leftDate">
              </div>
            </div>
          </div>
          <!-- /.row -->
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" /> 
      </div>
    </div>
  </form>
  <!-- /.modal-content -->
</div>
<script>
  $(function () {
     var secondMobile = '<?php echo $result['mobile2']; ?>';
    // alert(secondMobile);
     // $('.second_mobile').hide();
     if(secondMobile==null || secondMobile==''){
      $('.second_mobile').hide();
     }else{
      $('.second_mobile').show();
     }
  
      $('.add_second_mobile').click(function(){
        $('.second_mobile').show();
      });
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
    // $(document).ready(function(){
    //   $('#enableAPi').change(function(){
    //     $('#apiServer').prop("disabled",false);
    //     $('#apiPackage').prop("disabled",false);
    //   });
    // });
  </script>
  <script>
    $(document).ready(function(){
      $('#conn_media').change(function(){
        alert("hell")
      });



      $(document).on('click', '.shift_client', function(){  
        var id = '<?php echo $result['id']; ?>'; 
        swal("Left Reason:", {
          content: "input",
        })
        .then((value) => {
        //swal(`You typed: ${value}`);
        var leftReason = value;
        if(leftReason == "" || leftReason==null){
          swal("Invalid Reason!", {
            icon: "warning",
          });
        }else{
          $.ajax({
            url:"action/shift-to-left.php",
            method:"POST",
            data:{id:id,leftReason:leftReason},
            success:function(data){
              swal("Shifted Successfully!", {
                icon: "success",
              });   
            }
          });
        } 
      });


      });  
      $(document).on('click', '.clear_data', function(){  
        var id = '<?php echo $id; ?>'; 
        swal({
          title: "Are you sure?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax({
              url:"action/clear-user-data.php",
              method:"POST",
              data:{id:id},
              success:function(data){
                swal("User Data Cleaned!!", {
                  icon: "success",
                });   
                $(location.reload());   
              }
            })
          } else {
            return false;
          }
        });
      });  
      $(document).on('click', '.change_password', function(){  
        var id = '<?php echo $id; ?>';  
        swal("Enter New Password", {
          content: "input",
        })
        .then((value) => {
          var new_pass = value;
          if(new_pass == "" || new_pass==null){
            swal("Password can't be empty!", {
              icon: "warning",
            });
          }else{
            $.ajax({
              url:"action/change-password.php",
              method:"POST",
              data:{id:id,new_pass:new_pass},
              success:function(data){
                swal("Password Changed Successfully!", {
                  icon: "success",
                });   
              }
            });
          } 
        });


      });  




    });
    $('#leftClientForm').on("submit", function(event){  
     event.preventDefault();  

    
      $.ajax({  
       url:"action/shift-to-left.php",  
       method:"POST",  
       data:$('#leftClientForm').serialize(),  
       beforeSend:function(){  
        $('#insert').val("Updating");  
      },  
      success:function(data){  
        $('#leftClientForm')[0].reset();  
        $('#modal-send-sms').modal('hide');  
        
      }  
    });  
      
  });

</script>

<!-- jQuery 3 --> 

</body>
</html>
