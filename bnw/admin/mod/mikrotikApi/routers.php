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
  <title>Routers | <?php echo $siteName; ?></title>
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
      <h1><i class="fa fa-sitemap"></i> Mikrotik Routers</h1>
      <ol class="breadcrumb">
        <button class="btn btn-success btn-sm" style="float: right;" id="add" data-toggle="modal" data-target="#add_router_Modal"><i class="fa fa-plus"></i> Add New Router</button>
      </ol>
    </div>
    
    
    <!-- Main content -->
    <div class="content"> 
      <!-- Small boxes (Stat box) -->
      <div class="info-box">

        <div class="table-responsive">
          <table id="task-table" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Router Name</th>
                <th>IP Address</th>

                <th>Username</th>
                <th>Username</th>

                <th>Action</th>
              </tr>
            </thead>

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
  $(document).ready(function(){  

    var dataTable = $('#task-table').DataTable({
      "autoWidth"   : false,
      "processing":true,
      "serverSide":true,
      "order":[],
      "ajax":{
        url:"fetch/fetch-tasks-all.php",
        type:"POST"
      },

    });
    $('#add').click(function(){  
     $('#insert').val("Insert");  
     $('#insert_form')[0].reset();
     $('#id').val(null);
     $('$modalTitle').html("Add New Router");   
   });  
    $(document).on('click', '.edit_data', function(){  
     var id = $(this).attr("id");  
     $.ajax({  
      url:"fetch/fetch-router-single.php",  
      method:"POST",  
      data:{id:id},  
      dataType:"json",  
      success:function(data){  
       $('#serverName').val(data.serverName);  
       $('#ipAddress').val(data.ipAddress);
       $('#username').val(data.username); 
       $('#password').val(data.password);
       $('#id').val(data.id);
       $('#insert').val("Update");  
       $('#add_router_Modal').modal('show'); 
       $('$modalTitle').html("Update Router"); 
     }  
   });  
   });  

    $(document).on('click', '.delete_router', function(){  
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
            url:"action/delete-router.php",
            method:"POST",
            data:{id:id},
            success:function(data){
              swal("Deleted Successfully!!", {
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
    
    $('#insert_form').on("submit", function(event){  
     event.preventDefault();  
     if($('#serverName').val() == "")  
     {  
      swal("Servername is required");  
    }  

    else if($('#ipAddress').val() == '')  
    {  
      swal("IP Address is required");  
    }  
    else if($('#username').val() == '')  
    {  
      swal("Username is required");  
    }  
    else if($('#password').val() == '')  
    {  
      swal("Password is required");  
    }  

    else  
    {  
      $.ajax({  
       url:"action/add-update-router.php",  
       method:"POST",  
       data:$('#insert_form').serialize(),  
       beforeSend:function(){  
        $('#insert').val("Inserting");  
      },  
      success:function(data){  
        $('#insert_form')[0].reset();  
        $('#add_router_Modal').modal('hide');  
        dataTable.ajax.reload();

        //$(location.reload());  
      }  
    });  
    }  
  });  



  });  
</script>
<!-- jQuery 3 --> 
<div id="add_router_Modal" class="modal fade">  
 <div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h4 id="modalTitle" class="modal-title"><b>Add New Router</b></h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">

      <form method="post" id="insert_form">  
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
             <input type="hidden" name="id" id="id" class="form-control" readonly />  
             
             <div class="form-group">
              <label for="exampleInputEmail1">Router Name (*)</label>
              <input type="text" class="form-control" name="serverName" id="serverName" >
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Username (*)</label>
              <input type="text" class="form-control" name="username" id="username" >
            </div>

            <!-- /.form-group -->

            <!-- /.form-group -->
          </div>
          <!-- /.col -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="exampleInputEmail1">IP Address (*)</label>
              <input type="text" class="form-control" name="ipAddress" id="ipAddress" >
            </div>
            <!-- /.form-group -->


            <div class="form-group">
              <label for="exampleInputEmail1">Password (*)</label>
              <input type="text" class="form-control" name="password" id="password" >
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
         <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" /> 
       </div>
     </form>
   </div>
   <!-- /.row -->
 </div>

 <!-- /.card -->
</div>
</body>
</html>
