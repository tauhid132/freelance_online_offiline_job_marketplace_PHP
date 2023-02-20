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
  <title>General Query | <?php echo $siteName; ?></title>
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
      <h1>General Query</h1>
      <ol class="breadcrumb">
         
      <button class="btn btn-info btn-sm" style="float: right;" id="add" data-toggle="modal" data-target="#add_data_Modal"><i class="fa fa-plus"></i> Create New Query</button>

   
      </ol>
    </div>
    
    <!-- Main content -->
    <div class="content"> 
      <!-- Small boxes (Stat box) -->
      <div class="info-box">

        <div class="table-responsive">
          <table id="connection-table" class="table table-bordered table-striped">
            <thead>
              <tr>
               <th>No</th>
               <th>Status</th>
               <th>Action</th>
               <th>Full Name</th>
               <th>Address</th>
               <th>Mobile</th>
               <th>TimeStamp</th>
               <th>Executive</th>
               <th>Comment</th>
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

<div id="add_data_Modal" class="modal fade">  
 <div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h4 id="modalHeader" class="modal-title"><b>Create New Query</b></h4>
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
              <label for="exampleInputEmail1">Full Name</label>
              <input type="text" class="form-control" name="fullName" id="fullName">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Mobile Number</label>
              <input type="text" class="form-control" name="mobileNo" id="mobileNo">
            </div>
           
            <div class="form-group">
            <label for="exampleInputEmail1">Comment</label>
            <textarea type="text" class="form-control" name="comment" id="comment"></textarea>
          </div>
          



          <!-- /.form-group -->

          <!-- /.form-group -->
        </div>
        <!-- /.col -->
        <div class="col-md-6">
          <div class="form-group">
            <label for="exampleInputEmail1">Full Address</label>
            <textarea type="text" class="form-control" name="fullAddress" id="fullAddress"></textarea>
          </div>
          <!-- /.form-group -->
          <div class="form-group">
           <div class="form-group">
            <label>Reference</label>
            <select class="form-control" name="assignedExecutive" id="assignedExecutive"  style="width: 100%;">
              <option value="Online">Online</option>
              <?php
              $sql2 = "SELECT * FROM employee";
              if($result = mysqli_query($conn, $sql2)){
                if(mysqli_num_rows($result) > 0){

                  while($row = mysqli_fetch_array($result)){
                    echo"<option value=" . $row['username'] . ">" . $row['fullName'] . "</option>";

                  }

        // Free result set
                  mysqli_free_result($result);
                } else{
                  echo "No records matching your query were found.";
                }
              } else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
              }





              ?>
            </select>
          </div>

           <div class="form-group">
            <label>Status</label>
            <select class="form-control" name="status" id="status"  style="width: 100%;">
              <option value="0">Not Confirmed</option>
              <option value="1">Confirmed</option>
             
            </select>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Executive</label>
            <input type="text" class="form-control" name="created_by" value="<?php echo $_SESSION['username'];  ?>" readonly>
          </div>
           
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
       <input type="submit" name="insert" id="insert" value="Create Now" class="btn btn-primary" /> 
     </div>
   </form>
 </div>
 <!-- /.row -->
</div>

<script>
 
    var dataTable2 = $('#connection-table').DataTable({
    "autoWidth"   : false,
    "processing":true,
    "serverSide":true,
    "order":[],
    "ajax":{
      url:"fetch/fetch-general-query-all.php",
      type:"POST"
    },

  });
 
   $('#add').click(function(){  
   $('#insert').val("Insert");  
   $('#insert_form')[0].reset(); 
   $("#modalHeader").html("Create New Query"); 
 });  
 $(document).on('click', '.delete_request', function(){  
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
          url:"action/delete-general-query.php",
          method:"POST",
          data:{id:id},
          success:function(data){
            swal("Deleted Successfully!!", {
              icon: "success",
            });
            dataTable2.ajax.reload();
          }
        })
      } else {
        return false;
      }
    });
  });  

  $(document).on('click', '.edit_data', function(){  
   var id = $(this).attr("id");  
   $.ajax({  
    url:"fetch/fetch-general-single.php",  
    method:"POST",  
    data:{id:id},  
    dataType:"json",  
    success:function(data){  
     $('#fullName').val(data.fullName);  
     $('#address').val(data.address);  
     $('#mobileNo').val(data.mobileNo);
     $('#executive').val(data.executive); 
     $('#commment').val(data.commment); 
     $('#status').val(data.status); 
     $('#id').val(data.id); 
     $('#user_id').val(data.user_id);      
     $("#modalHeader").html("Update Query");  
     $('#insert').val("Update");  
     $('#add_data_Modal').modal('show');  
   }  
 });  
 });  
  $('#insert_form').on("submit", function(event){  
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
     url:"action/add-update-general-query.php",  
     method:"POST",  
     data:$('#insert_form').serialize(),  
     beforeSend:function(){  
      $('#insert').val("Inserting"); 
    },  
    success:function(data){  
      $('#insert_form')[0].reset();  
      $('#add_data_Modal').modal('hide');  
       dataTable2.ajax.reload();
    }  
  });  
  }  
});  
</script>
<!-- jQuery 3 --> 

</body>
</html>
