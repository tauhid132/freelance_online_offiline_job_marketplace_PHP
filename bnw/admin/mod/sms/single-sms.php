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
  <title>Single SMS | <?php echo $siteName; ?></title>
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
       <h1><i class="fa fa-paper-plane-o"></i> Single SMS Sender </h1>
      <ol class="breadcrumb">
        <li><a href="#">SMS</a></li>
        <li><i class="fa fa-angle-right"></i> Single SMS</li>
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
            <center><h5 class="text-black">Single Messege Sender</h5></center>
          </div>
          <div class="card-body">

            <div class="form-group row">
              <label class="control-label text-center col-md-2">Recipient Mobile</label>
              <div class="col-md-10">
                <input  class="form-control" name="mobile" id="mobileField" type="text">
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label text-center col-md-2">Message Body</label>
              <div class="col-md-10">
                <textarea  class="form-control" name="smsbody" id="msgBodyField" type="text"></textarea>
              </div>
            </div>


            
          </div>
          <div class="card-footer">
            <center><input type="submit" name="insert" id="btn1" value="Send Message" class="btn btn-info" /> </center>
          </div>
        </div>
      </form>
      <center><div class="loader"></div></center>



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
    url:"action/send-single-sms.php",  
    method:"POST",  
    data:$('#form1').serialize(), 
    beforeSend:function(){  
      $('.loader').css("visibility", "visible");
    },  
    success:function(data){  
      $('#selected_users').html(data); 
      $('.loader').css("visibility", "hidden");
      $('#mobileField').val("");
      $('#msgBodyField').val("");
      
    }  
  });  
 });




</script>



</body>
</html>
