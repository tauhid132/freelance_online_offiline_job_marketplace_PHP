<?php
session_start();
include('../../db/conn.php');

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: ../../login.php");
  exit;
}
//count ONU
$countONU = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM equipments WHERE equip_type='ONU'"));
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>All Products | <?php echo $siteName; ?></title>
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
      <h1><i class="fa fa-shopping-cart"></i> Products & Stock Management </h1>
      <ol class="breadcrumb">
        <button class="btn btn-info btn-sm" style="float: right;" id="add" data-toggle="modal" data-target="#modal-add-equipment"><i class="fa fa-plus-circle"></i> Create New Product Category</button>
      </ol>
    </div>
    <!-- Main content -->
    <div class="content"> 
      <!-- Small boxes (Stat box) -->
      <div class="info-box">

        <div class="table-responsive">
          <table id="product-table" class="table table-bordered table-striped">
            <thead>
              <tr>
               <th>No</th>
               <th>Product Name</th>
               <th>Description</th>
               <th>Stock</th>
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
 var dataTable = $('#product-table').DataTable({
    "autoWidth"   : false,
    "processing":true,
    "serverSide":true,
    "order":[],
    "ajax":{
      url:"fetch/fetch-product-all.php",
      type:"POST"
    },

  });
</script>
<script>
  $(document).ready( function () {
    $('#table_user').DataTable();
  });
  $(document).on('click', '.delete_cat', function(){  
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
            url:"action/deleteProCat.php",
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
          <h4 class="modal-title"><b>Add Stock</b></h4>
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
                  <label for="exampleInputEmail1">Product Name</label>
                  <input type="text" class="form-control" name="name" id="name">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                  <input type="text" class="form-control" name="description" id="description">
                </div>



                <!-- /.form-group -->

                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
               <div class="form-group">
                <label for="exampleInputEmail1">Current Stock</label>
                <input type="text" class="form-control" name="stock" id="stock">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">New Stock</label>
                <input type="text" class="form-control" name="new_stock" id="new_stock">
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
   $('#insert2').val("Insert");  
   $('#insert_form2')[0].reset();
   $('#modalTitle').html("Create New Product Category");  
 });  
  $(document).on('click', '.add_stock', function(){  
   var id = $(this).attr("id");  
   $.ajax({  
    url:"fetch/fetch-product-single.php",  
    method:"POST",  
    data:{id:id},  
    dataType:"json",  
    success:function(data){  

     $('#id').val(data.id);     
     $('#name').val(data.name);  
     $('#description').val(data.description);
     $('#stock').val(data.stock); 
     $('#insert').val("Update Stock");  
     $('#add_data_Modal').modal('show');  
   }  
 });  
 });
  $(document).on('click', '.edit_cat', function(){  
   var id = $(this).attr("id");  
   $.ajax({  
    url:"fetch/fetch-product-single.php",  
    method:"POST",  
    data:{id:id},  
    dataType:"json",  
    success:function(data){  

     $('#id2').val(data.id);     
     $('#name2').val(data.name);  
     $('#description2').val(data.description);
     $('#stock2').val(data.stock); 
     $('#insert').val("Update Stock");  
     $('#modal-add-equipment').modal('show'); 
     $('#modalTitle').html("Update Product Category"); 
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
     url:"update-stock.php",  
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


$('#insert_form2').on("submit", function(event){  
   event.preventDefault();  
    $.ajax({  
     url:"action/add-update-productCat-action.php",  
     method:"POST",  
     data:$('#insert_form2').serialize(),  
     beforeSend:function(){  
      $('#insert2').val("Updating");  
    },  
    success:function(data){  
      $('#insert_form2')[0].reset();  
      $('#modal-add-equipment').modal('hide');  
       dataTable.ajax.reload();  
    }  
  });    
});  

});  
</script>



<div class="modal fade" id="modal-add-equipment">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 id="modalTitle" class="modal-title"><b>Add Product Category</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="post" id="insert_form2">  
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <input type="hidden" name="id" id="id2" class="form-control"  />
                <div class="form-group">
                  <label for="exampleInputEmail1">Product Name</label>
                  <input type="text" class="form-control" name="name" id="name2">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Product Description</label>
                  <input type="text" class="form-control" name="description" id="description2">
                </div>


                <!-- /.form-group -->
                
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Current Stock</label>
                  <input type="text" class="form-control" name="stock" id="stock2" >
                </div>
                <!-- /.form-group -->
                

                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
           <div class="card-footer">
           <input type="submit" name="insert" id="insert2" value="Insert" class="btn btn-success" /> 
         </div>
        </form>
      </div>
      <!-- /.row -->
    </div>

  </body>
  </html>
