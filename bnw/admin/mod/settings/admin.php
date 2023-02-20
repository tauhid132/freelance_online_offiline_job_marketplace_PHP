<?php
session_start();
include('../../db/conn.php');

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: ../../login");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | <?php echo $siteName; ?></title>
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
       <h1><i class="fa fa fa-user-o"></i> Admin Management </h1>
      <ol class="breadcrumb">
         <button class="btn btn-info btn-sm" style="float: right;" id="add" data-toggle="modal" data-target="#add_data_Modal"><i class="fa fa-plus"></i> Create New Admin</button>
      </ol>
    </div>
    
    <!-- Main content -->
   

    <div class="content"> 
      <!-- Small boxes (Stat box) -->

      <div class="info-box">


        <div class="table-responsive">
          <table id="admin-table" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width="3%">No</th>
                <th width="7%">Username</th>
                <th width="20%">Full Name</th>
                <th width="7%">Username</th>
                <th width="7%">Role</th>
                <th width="7%">Status</th>
                <th width="7%">Action</th>
              </tr>
            </thead>

          </table>
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
   $(document).on('click', '.enableAdmin', function(){  
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
          url:"action/enable-disable-user.php",
          method:"POST",
          data:{id:id},
          success:function(data){
            swal(data, {
              icon: "success",
            }); 
            //$("#service_area_div").load(location.href + " #service_area_div");  
          }
        })
      } else {
        return false;
      }
    });

  }); 
   var dataTable = $('#admin-table').DataTable({
    "autoWidth"   : false,
    "processing":true,
    "serverSide":true,
    "order":[],
    "ajax":{
      url:"fetch/fetch-admin-all.php",
      type:"POST"

    },

  });
   $('#add').click(function(){  
   $('#insert').val("Insert");  
   $('#insert_form')[0].reset();
    $('#modalTitle').html("Create New Admin");  
   });  

   $(document).on('click', '.delete_admin', function(){  
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
          url:"action/delete-admin.php",
          method:"POST",
          data:{id:id},
          success:function(data){
            swal("Deleted Successfully!!!!", {
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
   
   

   $('#add').click(function(){  
     $('#insert').val("Insert");  
     $('#insert_form')[0].reset();  
   });  
   $(document).on('click', '.edit_data', function(){  
     var id = $(this).attr("id");  
     $.ajax({  
      url:"fetch.php",  
      method:"POST",  
      data:{id:id},  
      dataType:"json",  
      success:function(data){  
       $('#username').val(data.username);  
       $('#email').val(data.email);  
       $('#role').val(data.role);
       $('#full_name').val(data.full_name); 
       $('#id').val(data.id);      

       $('#insert').val("Update");  
       $('#add_data_Modal').modal('show');
       $('#modalTitle').html("Update Admin"); 
     }  
   });  
   });  
   $('#insert_form').on("submit", function(event){  
     event.preventDefault();  
     if($('#full_name').val() == "")  
     {  
      swal("Name is required!!");  
    }  
    else if($('#username').val() == '')  
    {  
      swal("Username id required!!") 
    }  
    else if($('#role').val() == '')  
    {  
      swal("Role is required!!");  
    }
    else if($('#password').val() == '')  
    {  
      swal("Password is required!!");  
    }    

    else  
    {  
      $.ajax({  
       url:"action/add-update-admin.php",  
       method:"POST",  
       data:$('#insert_form').serialize(),  
       beforeSend:function(){  
        $('#insert').val("Inserting");  
      },  
      success:function(data){  
        $('#insert_form')[0].reset();  
        dataTable.ajax.reload();  
      }  
    });  
    }  
  });  


 });  
</script>
<div id="add_data_Modal" class="modal fade">  
  <div class="modal-dialog">  
   <div class="modal-content">  
    <div class="modal-header">  
      <h4 id="modalTitle" class="modal-title">Add New Admin</h4>  
      <button type="button" class="close" data-dismiss="modal">&times;</button>  

    </div>  
    <div class="modal-body">  
     <form method="post" id="insert_form">  

      <input type="hidden" name="id" id="id" class="form-control" />  

      <label>Full Name</label>  
      <input type="text" name="full_name" id="full_name" class="form-control" />  
      <br />  
      <label>User Name</label>  
      <input type="text" name="username" id="username" class="form-control" />  
      <br />  
      <label>Password</label>  
      <input type="text" name="password" id="password" class="form-control" />  
      <br />  
      <label>Email</label>  
      <input type="text" name="email" id="email" class="form-control" />  
      <br />                


      <div class="form-group">
        <label>Role</label>
        <select class="form-control" name="role" id="role"  >
          <option value="">Select Role</option>
          <option value="admin">Admin</option>
          <option value="accountant">Accountant</option>
          <option value="support">Support</option>

        </select>
      </div> 
      <br />  



      <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />  
    </form>  
  </div>  
  <div class="modal-footer">  
   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
 </div>  
</div>  
</div>  
</div> 
</div>
</body>
</html>
