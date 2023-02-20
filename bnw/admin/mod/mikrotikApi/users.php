<?php
// Initialize the session
session_start();
include('../../db/conn.php');




//$ARRAY = array_merge($moniServer,$testServer,);
//array_push($ARRAY, $moniServer->comm("/ppp/active/print"));
           // $ARRAY2 = $API2->comm("/ppp/active/print");       

// Check if the user is logged in, if not then redirect him to login page
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
  <title>API Users | <?php echo $siteName; ?></title>
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
       <h1><i class="fa fa-users"></i> API Enabled Users </h1>
      <ol class="breadcrumb">
        <li><a href="#">Users</a></li>
        <li><i class="fa fa-angle-right"></i> API Users</li>
      </ol>
    </div>
    
    <!-- Main content -->
    <div class="content"> 
      <!-- Small boxes (Stat box) -->
      <div class="info-box">

        <div class="table-responsive">
          <table id="online-table" class="table table-bordered table-striped">
            <thead>
              <tr>
               <th>No</th>
               <th>User-ID</th>
               <th>User Name</th>
               <th>Area</th>
               <th>Uptime</th>
               <th>IP</th>
               <th>Status</th>
               <th>A/C</th>
               <th>Action</th>
             </tr>
           </thead>

         </table>
       </div>
     </div>
     
   </div>
   <center><div class="loader"></div></center>
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
  $(document).ready( function () {
    $('#table_user').DataTable();
  });
  var dataTable = $('#online-table').DataTable({
    "autoWidth"   : false,
    "processing" :true,
    "serverSide":true,
    "order":[],
    "ajax":{
      url:"fetch/fetch-users-all.php",
      type:"POST"
    },

  });
  setInterval( function () {
    dataTable.ajax.reload();
  }, 600000 );
  $(document).on('click', '.disable_user', function(){  
    var id = $(this).attr("id");  
      //console.log(id); 
      swal({
        title: "Are you sure?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            url:"api_action/disable-user.php",
            method:"POST",
            data:{id:id},
            beforeSend:function(){  
       
             $('.loader').css("visibility", "visible");
            },  
            success:function(data){
              swal("Disabled Successfully!!!!", {
                icon: "success",
              }); 
              $('.loader').css("visibility", "hidden");
              dataTable.ajax.reload();
            }
          })
        } else {
          return false;
        }
      });
    });  
  $(document).on('click', '.enable_user', function(){  
    var id = $(this).attr("id");  
      //console.log(id); 
      swal({
        title: "Are you sure?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            url:"api_action/enable-user.php",
            method:"POST",
            data:{id:id},
            success:function(data){
              swal("Enabled Successfully!!!!", {
                icon: "success",
              }); 
              dataTable.ajax.reload();
            }
          })
        } else {
          return false;
        }
      });
    });  
  </script>
  <!-- jQuery 3 --> 

</body>
</html>
