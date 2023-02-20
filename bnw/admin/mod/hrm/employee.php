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
  <title>Employee | <?php echo $siteName; ?></title>
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
      <h1><i class="fa fa-users"></i> Employee Management </h1>
      <ol class="breadcrumb">
        <button class="btn btn-info btn-sm" style="float: right;" id="add" data-toggle="modal" data-target="#modal-add-employee"><i class="fa fa-plus-circle"></i> Create New Employee</button>
      </ol>
    </div>
    <!-- Main content -->
    <div class="content"> 
      <!-- Small boxes (Stat box) -->
      <div class="info-box">

        <div class="table-responsive">
          <table id="emp-table" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>
                  No
                </th>
                <!-- <th>
                  Image
                </th> -->
                <th>
                  Full Name
                </th>
                <th>
                  Employee ID
                </th>
                <th>
                  Role
                </th>

                <th>
                  Salary
                </th>
                <th>
                  Cur.Account
                </th>
                <th>
                 Action
               </th>
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
  var dataTable = $('#emp-table').DataTable({
    "autoWidth"   : false,
    "processing":true,
    "serverSide":true,
    "order":[],
    "ajax":{
      url:"fetch/fetch-emp-all.php",
      type:"POST"
    },

  });
</script>
<div class="modal fade" id="modal-add-employee">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 id="modalTitle" class="modal-title"><b>Add / Update Employee</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" id="insert_form" method="POST">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
               <input type="hidden" name="id" id="id">
               <div class="form-group">
                <label for="exampleInputEmail1">User Name</label>
                <input type="text" class="form-control" name="username" id="username">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Full Name</label>
                <input type="text" class="form-control" name="fullName" id="fullName">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Role/Degignation</label>
                <input type="text" class="form-control" name="role" id="role">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="text" class="form-control" name="email" id="email">
              </div>


              <!-- /.form-group -->

              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputEmail1">Joining Dare</label>
                <input type="date" class="form-control" id="datepicker"name="joining_date" id="joining_date">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="exampleInputEmail1">Salary</label>
                <input type="text" class="form-control" name="salary"id="salary">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Mobile No</label>
                <input type="text" class="form-control" name="mobile"id="mobile">
              </div>

              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.card-body -->


      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" /> 
      </div>
    </form>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>


<script>  
 $(document).ready(function(){  
  $('#employee-table').DataTable();
  $('#add').click(function(){  
   $('#insert').val("Insert");  
   $('#insert_form')[0].reset();
   $('#id').val(null);
   $('#modalTitle').html("Add New Employee")  
 });  
  $(document).on('click', '.edit_emp', function(){  
   var id = $(this).attr("id");  
   $.ajax({  
    url:"action/fetch-emp.php",  
    method:"POST",  
    data:{id:id},  
    dataType:"json",  
    success:function(data){    
     $('#username').val(data.username); 
     $('#fullName').val(data.fullName);  
     $('#role').val(data.role);
     $('#joining_date').val(data.joining_date); 
     $('#salary').val(data.salary); 
     $('#mobile').val(data.mobile); 
     $('#email').val(data.email); 
     $('#id').val(data.id);      

     $('#insert').val("Update");  
     $('#modal-add-employee').modal('show');
     $('#modalTitle').html("Update Employee")  
   }  
 });  
 });  

  $(document).on('click', '.delete_emp', function(){  
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
          url:"action/delete-emp.php",
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

   if($('#pay_method').val() == '')  
   {  
    alert("Please Select payment method!");  
  }  


  else  
  {  
    $.ajax({  
     url:"action/add-employee.php",  
     method:"POST",  
     data:$('#insert_form').serialize(),  
     beforeSend:function(){  
      $('#insert').val("Updating");  
    },  
    success:function(data){  
      $('#insert_form')[0].reset();  
      $('#modal-add-employee').modal('hide');  
      $(location.reload());  
    }  
  });  
  }  
});  


});  
</script>

</body>
</html>
