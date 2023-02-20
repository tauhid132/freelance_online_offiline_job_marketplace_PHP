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
  <title>Left Old Users | <?php echo $siteName; ?></title>
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
      <h1><i class="fa fa-user-times"></i> Left Users Management</h1>
      <ol class="breadcrumb">
       <button class="btn btn-info btn-sm" style="float: right;" id="add" data-toggle="modal" data-target="#add_data_Modal"><i class="fa fa-plus-circle"></i> Create New </button>
      </ol>
    </div>
    
    <!-- Main content -->
    <div class="content"> 
      <!-- Small boxes (Stat box) -->
      <div class="info-box">

        <div class="table-responsive">
          <table id="leftuser-table" class="table table-bordered table-striped">
            <thead>
              <tr>
               <th>No</th>
               <th>User-ID</th>
               <th>User Name</th>
               <th>Address</th>
               <th>Monthly Bill</th>
               <th>Left On</th>
               <th>Left Reason</th>
               <th>Mobile</th>

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
   $('#add').click(function(){  
     $('#insert').val("Insert");  
     $('#insert_form')[0].reset();  
   });  

   var dataTable = $('#leftuser-table').DataTable({
    "autoWidth"   : false,
    "processing":true,
    "serverSide":true,
    "order":[],
    "ajax":{
      url:"fetch/fetch-leftusers-all.php",
      type:"POST"
    },

  });

   $(document).on('click', '.edit_data', function(){  
     var id = $(this).attr("id");  
     $.ajax({  
      url:"fetch/fetch-leftuser-single.php",  
      method:"POST",  
      data:{id:id},  
      dataType:"json",  
      success:function(data){  
       $('#user_id').val(data.user_id);  
       $('#cus_name').val(data.cus_name);  
       $('#address').val(data.address);
       $('#mobile').val(data.mobile); 
       $('#left_on').val(data.left_on); 
       $('#monthly_bill').val(data.monthly_bill); 
       $('#id').val(data.id); 
       $("#testh4").html("Edit Left User Info");            
       $('#insert').val("Update");  
       $('#add_data_Modal').modal('show');  
     }  
   });  
   });  
   $(document).on('click', '.send_sms', function(){  
     var id = $(this).attr("id");  
     $.ajax({  
      url:"fetch/fetch-leftuser-single.php",  
      method:"POST",  
      data:{id:id},  
      dataType:"json",  
      success:function(data){  
       $('#cus_name2').val(data.cus_name);   
       $('#mobileno').val(data.mobile);      
       $('#id2').val(data.id);           
       $('#insert2').val("Send");  
       $('#send_sms_Modal').modal('show');  
     }  
   });  
   }); 

   $(document).on('click', '.delete_user', function(){  
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
          url:"action/delete-leftuser.php",
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
   $('#update_user').on("submit", function(event){  
    event.preventDefault();  
     $.ajax({  
       url:"action/update-leftuser-action.php",  
       method:"POST",  
       data:$('#update_user').serialize(),  
       beforeSend:function(){  
        $('#insert').val("Inserting");  
      },  
      success:function(data){  
        $('#update_user')[0].reset();  
        $('#add_data_Modal').modal('hide');  
        dataTable.ajax.reload();
      }  
    });  
   });  
    $('#send_sms').on("submit", function(event){  
    event.preventDefault();  
     $.ajax({  
       url:"action/single-sms.php",  
       method:"POST",  
       data:$('#send_sms').serialize(),  
       beforeSend:function(){  
        $('#insert2').val("Sending");  
      },  
      success:function(data){  
        $('#send_sms')[0].reset();  
        $('#send_sms_Modal').modal('hide');        
      }  
    });  
   });  
   
   
 });  
</script>
<!-- jQuery 3 --> 


<div id="add_data_Modal" class="modal fade">  
 <div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h4 id="testh4" class="modal-title"><b>Add New Left User</b></h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">

      <form method="post" id="update_user">  
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <input type="hidden" class="form-control" name="id" id="id">
                <label for="exampleInputEmail1">User ID</label>
                <input type="text" class="form-control" name="user_id" id="user_id">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Customer Name</label>
                <input type="text" class="form-control" name="cus_name" id="cus_name">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Mobile</label>
                <input type="text" class="form-control" name="mobile" id="mobile">
              </div>
              
              
              <!-- /.form-group -->
              
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputEmail1">Address</label>
                <input type="text" class="form-control" name="address" id="address">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label for="exampleInputEmail1">Left On</label>
                <input type="date" class="form-control" name="left_on"  id="left_on">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Monthly Bill</label>
                <input type="text" class="form-control" name="monthly_bill" id="monthly_bill" >
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

<div id="send_sms_Modal" class="modal fade">  
 <div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title"><b>Send SMS</b></h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">

      <form method="post" id="send_sms" >  
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
             <input type="hidden" class="form-control" name="id" id="id2">
             
             <div class="form-group">
              <label for="exampleInputEmail1">Customer Name</label>
              <input type="text" class="form-control" name="cus_name" id="cus_name2" readonly>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Mobile</label>
              <input type="text" class="form-control" name="mobile" id="mobileno" readonly>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">SMS Body</label>
              <textarea type="text" class="form-control" name="smsbody" ></textarea>
            </div>
            
            
            <!-- /.form-group -->
            
            <!-- /.form-group -->
          </div>
          <!-- /.col -->
          
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
       <input type="submit" name="submit" id="insert2" value="Send" class="btn btn-primary" /> 
     </div>
   </form>
 </div>
 <!-- /.row -->
</div>


</body>
</html>
