<?php
// Initialize the session
session_start();
include('../../db/conn.php');

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
}
$username = $_SESSION['username'];
$query=mysqli_query($conn,"select * from `admin` where username='$username'");
$result=mysqli_fetch_array($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>View Profile | <?php echo $siteName; ?></title>
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
  <style type="text/css">
    .image2 {
      height: 100px;
      overflow: hidden;
      position: relative;
      width: 100px;
    }



    .label2 {
      background: rgba(0, 0, 0, 0.5) none repeat scroll 0 0;
      bottom: -20px;
      color: #fff;
      left: 0;
      margin: 0;
      position: absolute;
      right: 0;
      text-align: center;
      transition:0.1s all;
    }

    .image2:hover .label2 {
      bottom: 0px;
    }
  </style>
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
      <h1><i class="fa fa-user"></i></i> View User Profile</h1>
      <ol class="breadcrumb">
        <li><a href="#">Settings</a></li>
        <li><i class="fa fa-angle-right"></i> Profile</li>
      </ol>
    </div>
    <div class="content"> 
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3"> 

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-profile"> <img class="profile-user-img img-responsive img-circle" src="<?php echo $url;?>/<?php echo $result['image'];?>" alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo $result['full_name']; ?></h3>
              <p class="text-muted text-center"><?php echo $result['role']; ?></p>
              <ul class="nav nav-stacked sty1">
                <li><a href="#">A/C Status: <span class="pull-right"><?php if($result['status']=='1') {echo '<span class="badge badge-success">Active</span>';}else {echo '<span class="badge badge-danger">Inactive</span>';}  ?></span></a></li>
                <li><a href="#">Username: <span class="pull-right"><?php echo $result['username']; ?></span></a></li>
                <li><a href="#">Role <span class="pull-right"><?php echo $result['role']; ?></span></a></li>
                <li><a href="#">Email: <span class="pull-right"><?php echo $result['email']; ?></span></a></li>
                <li><a href="#">Mobile: <span class="pull-right"><?php echo $result['mobile']; ?></span></a></li>
              </ul>
              <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-add-ticket"><i class="fa fa-edit"></i> Change Profile Picture</a> </div>
              <!-- /.box-body --> 
            </div>
            <!-- /.box --> 
          </div>
          <!-- /.col -->
          <div class="col-lg-9">
            <div class="info-box">
              <div class="box-body">
                <div class="right-page-header">
                <!-- <div class="d-flex">
                  <div class="align-self-center">
                    <h4 class="text-black m-b-1">Contacts / Employee List </h4>
                  </div>
                </div> -->
              </div>

              <!-- <h4 class="card-title text-black">Default Tab</h4>
                <h6 class="card-subtitle m-b-2">Use default tab with class <code>nav-tabs & tabcontent-border </code></h6> -->
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Notices</span></a> </li>
                  <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Profile Info</span></a> </li>
                  <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Change Password</span></a> </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content tabcontent-border">
                  <div class="tab-pane active" id="home" role="tabpanel">
                    <div class="pad-20">

                      <div class="col-lg-12" >
                        <div class="info-box">
                        </div>
                      </div>


                    </div>
                  </div>
                  <div class="tab-pane  p-20" id="profile" role="tabpanel">
                    <div class="pad-20">
                     <div class="row m-t-1">
                      <div class="col-lg-12">
                        <div class="card">
                          <div class="card-body">
                            <form action="#" class="form-horizontal form-bordered">
                              <div class="form-body">
                                <div class="form-group row">
                                  <label class="control-label text-right col-md-3">Full Name</label>
                                  <div class="col-md-9">
                                    <input placeholder="First Name" class="form-control" type="text">
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="control-label text-right col-md-3">User Name</label>
                                  <div class="col-md-9">
                                    <input placeholder="Last Name" class="form-control" type="text">
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="control-label text-right col-md-3">Email</label>
                                  <div class="col-md-9">
                                    <input placeholder="Last Name" class="form-control" type="text">
                                  </div>
                                </div>

                                <div class="form-group row">
                                  <label class="control-label text-right col-md-3">Mobile</label>
                                  <div class="col-md-9">
                                    <input class="form-control" type="text">
                                  </div>
                                </div> 
                              </div>
                              <div class="form-actions">
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="row">
                                      <div class="offset-sm-3 col-md-9">
                                        <button type="submit" class="btn btn-success"> Submit</button>
                                        <button type="button" class="btn btn-inverse">Cancel</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane p-20" id="messages" role="tabpanel">
                  <div class="pad-20">
                    <div class="row m-t-1">
                      <div class="col-lg-12">
                        <div class="card">
                          <div class="card-body">
                            <form role="form" method="POST" id="cng_pass" class="form-horizontal form-bordered">
                              <div class="form-body">
                                <input type="hidden" name="username" class="form-control form-control-normal" value="<?php echo $_SESSION['username'];?>">
                                <div class="form-group row">
                                  <label class="control-label text-right col-md-3">Password</label>
                                  <div class="col-md-9">
                                    <input placeholder="Enter New Password" id="pass1" name="new_pass" class="form-control" type="text">
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="control-label text-right col-md-3">Confirm Password</label>
                                  <div class="col-md-9">
                                    <input placeholder="Enter Confirm Password" id="pass2" class="form-control" type="text">
                                  </div>
                                </div>

                                <div class="form-actions">
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="row">
                                        <div class="offset-sm-3 col-md-9">
                                          <button type="submit" class="btn btn-success"> Submit</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>


        <!-- /.col --> 
      </div>

      <!-- Main row --> 
    </div>

    <!-- /.content-wrapper -->
    <?php include('../../includes/footer.php') ?>
  </div>
  <!-- ./wrapper --> 
  <?php include('../../includes/js.php') ?>





  <script type="text/javascript">
    $(document).ready(function (e) {
      $("#uploadForm").on('submit',(function(e) {
        e.preventDefault();
        $.ajax({
          url: "upload.php",
          type: "POST",
          data:  new FormData(this),
          contentType: false,
          cache: false,
          processData:false,
          success: function(data)
          {
      //$("#targetLayer").html(data);
      //alert('Image uploaded successfully!');
      $('#modal-add-ticket').modal('hide');
      $(location.reload());  
    },
    error: function() 
    {
    }           
  });
      }));
    });
  </script>

  <script>  
  $(document).ready(function(){  
    $('#cng_pass').on("submit", function(event){  
      event.preventDefault();  
      
      if($('#pass1').val() != $('#pass2').val())  
      {  
        swal('Password do not match!!');   
      }else if($('#pass1').val() == '' && $('#pass2').val() == '')  
      {  
        swal('Password cannot be empty!!');   
      }  
      else  
      {  
        $.ajax({  
          url:"action/cng-pass.php",  
          method:"POST",  
          data:$('#cng_pass').serialize(),  
          beforeSend:function(){  
            
          },  
          success:function(data){  
            $('#cng_pass')[0].reset();  
            
            swal('Password Changed Successfully!'); 
            
          }  
        });  
      }  
    });  
    
  });  
</script>     

  <div class="modal fade" id="modal-add-ticket">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-body">


          <div class="card">
            <div class="card-header">
              <h5>File Upload</h5>
            </div>
            <div class="card-block">
              <form id="uploadForm" action="upload.php" method="post">
                <div class="fallback">
                  <input name="userImage" type="file" />
                </div>
                <input type="hidden" name="username" value="<?php echo $result['username'];?>">
                <div class="text-center m-t-20">
                  <button type="submit" value="Submit" class="btn btn-primary">Upload Now</button>
                </div>
              </div>
            </div>


          </form>
        </div>
        <!-- /.row -->
      </div>

      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
</div>
</div>





</body>
</html>
