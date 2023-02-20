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
  <title>ONU List | <?php echo $siteName; ?></title>
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
      <h1>ONT / ONU List</h1>
      <ol class="breadcrumb">
        <button class="btn btn-info btn-sm" style="float: right;" id="add" data-toggle="modal" data-target="#add_data_Modal"><i class="fa fa-plus-circle"></i> Add New Device</button>
      </ol>
    </div>
    
    <!-- Main content -->
    <div class="content"> 
      <!-- Small boxes (Stat box) -->
      <div class="info-box">

        <div class="table-responsive">
          <table id="onu-table" class="table table-bordered table-striped">
            <thead>
              <tr>
               <th>No</th>
               <th>Type</th>
               <th>SL No</th>
               <th>Mac Address</th>
               <th>Vendor</th>
               <th>Status</th>
               <th>Used In</th>

               <th>Action</th>
             </tr>
          
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
 var dataTable = $('#onu-table').DataTable({
    "autoWidth"   : false,
    "processing":true,
    "serverSide":true,
    "order":[],
    "ajax":{
      url:"fetch/fetch-onu-all.php",
      type:"POST"
    },

  });
  $('#add').click(function(){  
   $('#insert2').val("Insert");  
   $('#insert_form2')[0].reset();
   $('#id').val(null);
   $('#modalTitle').html("Add New ONU");  
 });  
</script>
<script>
  $(document).ready( function () {
    $('#table_user').DataTable();
  });
  $(document).on('click', '.delete_equip', function(){  
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
            url:"action/delete-equip.php",
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

  <div id="add_data_Modal" class="modal fade">  
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 id="modalTitle" class="modal-title"><b>Add New ONU</b></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form method="post" id="insert_form">  
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                 <input type="hidden" name="id" id="id" class="form-control"  />  




                 <div class="form-group">
                  <label for="exampleInputEmail1">Equip Type</label>
                  <input type="text" class="form-control" name="equip_type" id="equip_type">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Vendor</label>
                  <input type="text" class="form-control" name="vendor" id="vendor">
                </div>
                <div class="form-group">
                  <label>Status</label>
                  <select class="form-control" name="status" id="status"  >
                    <option value="Unused">Unused</option>
                    <option value="Used">Used</option>
                    <option value="Damaged">Damaged</option>


                  </select>
                </div> 


                <!-- /.form-group -->

                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
               <div class="form-group">
                <label for="exampleInputEmail1">Serial No</label>
                <input type="text" class="form-control" name="sl_no" id="sl_no">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">MAC Address</label>
                <input type="text" class="form-control" name="mac" id="mac">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Used In</label>
                <input type="text" class="form-control" name="used_in" id="used_in">
              </div>

              <!-- /.form-group -->



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
 <!-- /.col -->
</div>
</div>  
</div>  
<script>  
 $(document).ready(function(){  
  $('#add').click(function(){  
   $('#insert').val("Insert");  
   $('#insert_form')[0].reset();  
 });  
  $(document).on('click', '.edit_data', function(){  
   var id = $(this).attr("id");  
   $.ajax({  
    url:"fetch/fetch-onu-single.php",  
    method:"POST",  
    data:{id:id},  
    dataType:"json",  
    success:function(data){  

     $('#id').val(data.id);     
     $('#equip_type').val(data.equip_type);  
     $('#vendor').val(data.vendor);
     $('#sl_no').val(data.sl_no); 
     $('#mac').val(data.mac); 
     $('#status').val(data.status);
     $('#used_in').val(data.used_in);

     $('#modalTitle').html("Add New ONU"); 
     $('#insert').val("Update");  
     $('#add_data_Modal').modal('show');  
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
     url:"action/add-update-onu.php",  
     method:"POST",  
     data:$('#insert_form').serialize(),  
     beforeSend:function(){  
      $('#insert').val("Updating");  
    },  
    success:function(data){  
      $('#insert_form')[0].reset();  
      $('#add_data_Modal').modal('hide');  
      $('#employee_table').html(data);
      dataTable.ajax.reload();  
    }  
  });  
  }  
});  


});  
</script>


<div class="modal fade" id="modal-add-equipment">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><b>Add Equipment</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form role="form" method="POST" action="action/add-equipment-action.php">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Product Type</label>
                  <select class="form-control select2bs4" name="equip_type" id="equip_type" style="width: 100%;">
                    <option value=""></option>
                    <option value="ONU">ONU</option>
                    <option value="Switch">Switch</option>

                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">SL No</label>
                  <input type="text" class="form-control" name="sl_no" placeholder="Enter User-ID">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">MAC Address</label>
                  <input type="text" class="form-control" name="mac" placeholder="Enter Mac Address">
                </div>


                <!-- /.form-group -->
                
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Vendor</label>
                  <input type="text" class="form-control" name="vendor" placeholder="Enter Vendor Name">
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Status</label>
                  <select class="form-control select2bs4" name="status" id="status" style="width: 100%;">
                    <option value=""></option>
                    <option value="Used">Used</option>
                    <option value="Unused">Unused</option>
                    <option value="Damaged">Damaged</option>

                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Used In</label>
                  <input type="text" class="form-control" name="used_in" placeholder="Enter Where it used">
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" name="add" class="btn btn-primary">Add</button>
          </div>
        </form>
      </div>
      <!-- /.row -->
    </div>
    <!-- jQuery 3 --> 

  </body>
  </html>
