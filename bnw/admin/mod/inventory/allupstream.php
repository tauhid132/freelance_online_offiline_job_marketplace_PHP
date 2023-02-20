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
  <title>Upstreams | <?php echo $siteName; ?></title>
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
      <h1><i class="fa fa-sitemap"></i> Upstream & Downstream Management </h1>
      <ol class="breadcrumb">
       <button class="btn btn-info btn-sm" style="float: right;" id="add" data-toggle="modal" data-target="#add_data_Modal"><i class="fa fa-plus-circle"></i> Add New Upstream</button>
      </ol>
    </div>
    
    <!-- Main content -->
    <div class="content"> 
      <!-- Small boxes (Stat box) -->
      <div class="info-box">

        <div class="table-responsive">
          <table id="upstream-table" class="table table-bordered table-striped">
            <thead>
              <tr>
               <th>No</th>
               <th>Upstream Name</th>
               <th>Usage</th>
               <th>Monthly Bill</th>
               <th>Account</th>
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


<div id="dataModal" class="modal fade">  
  <div class="modal-dialog modal-lg">
   <div class="modal-content">  
     <div class="modal-header">
      <h4 class="modal-title">Payment History</h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
   </div> 
   <div class="modal-body" id="billing_history">  
   </div>  
   <div class="modal-footer">  
     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
   </div>  
 </div>  
</div>  
</div>  
<script>
 var dataTable = $('#upstream-table').DataTable({
    "autoWidth"   : false,
    "processing":true,
    "serverSide":true,
    "order":[],
    "ajax":{
      url:"fetch/fetch-upstream-all.php",
      type:"POST"
    },

  });
</script>
<script>
   $(document).on('click', '.view_data', function(){
     var employee_id = $(this).attr("id");
     $.ajax({  
      url:"fetch/fetch-bill-history.php",  
      method:"post",  
      data:{employee_id:employee_id},  
      success:function(data){  
       $('#billing_history').html(data);  
       $('#dataModal').modal("show");  
     }  
   });  
   });  
  $(document).on('click', '.delete_upstream', function(){  
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
            url:"action/delete-upstream.php",
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
  </script>
  <!-- jQuery 3 --> 
  <div id="add_data_Modal" class="modal fade">  
   <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 id="modalTitle" class="modal-title"><b>Add New Upstream</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="post" id="update_user">  
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
               <input type="hidden" class="form-control" name="id" id="id">
               <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" class="form-control" name="upstream" id="upstream">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Usage</label>
                <input type="text" class="form-control" name="usages" id="usages">
              </div>



              <!-- /.form-group -->

              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputEmail1">Monthly Bill</label>
                <input type="text" class="form-control" name="bill" id="bill" >
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="exampleInputEmail1">Due (If any)</label>
                <input type="text" class="form-control" name="account" id="account" >
              </div>

              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
         <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-primary" /> 
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



<script>  
 $(document).ready(function(){  
  $('#add').click(function(){  
   $('#insert').val("Insert");  
   $('#insert_form')[0].reset();
   $('#modalTitle').html("Add New Upstream")  
 });  
  $(document).on('click', '.edit_data', function(){  
   var id = $(this).attr("id");  
   $.ajax({  
    url:"fetch/fetch-upstream-single.php",  
    method:"POST",  
    data:{id:id},  
    dataType:"json",  
    success:function(data){  
     $('#upstream').val(data.upstream);  
     $('#usages').val(data.usages);  
     $('#bill').val(data.bill);
     $('#account').val(data.account); 
     
     $('#id').val(data.id);      
     
     $('#insert').val("Update");  
     $('#add_data_Modal').modal('show'); 
     $('#modalTitle').html("Update Upstream") 
   }  
 });  
 });  
  
  $('#update_user').on("submit", function(event){  
   event.preventDefault();  
   if($('#paid_bill').val() == "")  
   {  
    alert("Name is required");  
  }  
  
  else if($('#role').val() == '')  
  {  
    alert("Designation is required");  
  }  
  
  else  
  {  
    $.ajax({  
     url:"action/add-update-upstream-action.php",  
     method:"POST",  
     data:$('#update_user').serialize(),  
     beforeSend:function(){  
      $('#insert').val("Inserting");  
    },  
    success:function(data){  
      $('#update_user')[0].reset();  
      $('#add_data_Modal').modal('hide');  
      
      $(location.reload());  
    }  
  });  
  }  
});  
  
  
});  
</script>



    
  </body>
  </html>
