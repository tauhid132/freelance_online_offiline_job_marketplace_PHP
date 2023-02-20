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
  <title>Tickets | <?php echo $siteName; ?></title>
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
      <h1><i class="fa fa-ticket"></i> Support Ticket Management </h1>
      <ol class="breadcrumb">
        <button class="btn btn-info btn-sm" style="float: right;" id="add" data-toggle="modal" data-target="#add_data_Modal"><i class="fa fa-plus-circle"></i> Create New Ticket</button>
      </ol>
    </div>
   
    <!-- Main content -->
    <div class="content"> 
      <!-- Small boxes (Stat box) -->
      <div class="info-box">

        <div class="table-responsive">
          <table id="ticket-table" class="table table-bordered table-striped">
            <thead class="bg-info">
              <tr>
                <th>No</th>
                <th>Tkt ID</th>
                <th>Status</th>
                <th>Action</th>
                <th>UserID</th>
                <th>Ticket Type</th>
                <th>Ticket Details</th>
                <th>Create Timestamp</th>

                <th>Close Timestamp</th>
                <!-- <th>Review</th> -->
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
   $('#modalTitle').html("Create New Ticket");  
 });  
  var dataTable = $('#ticket-table').DataTable({
    "autoWidth"   : false,
    "processing":true,
    "serverSide":true,
    "order":[],
    "ajax":{
      url:"fetch/fetch-tickets-all.php",
      type:"POST"
    },

  });
  $(document).on('click', '.delete_ticket', function(){  
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
          url:"action/delete-ticket.php",
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
  $(document).on('click', '.close_ticket', function(){  
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
          url:"action/close-ticket.php",
          method:"POST",
          data:{id:id},
          success:function(data){
            swal(" Task No: " + id +" is Closed Successfully!!", {
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



  $(document).on('click', '.edit_data', function(){  
   var id = $(this).attr("id");  
   $.ajax({  
    url:"fetch/fetch-ticket-single.php",  
    method:"POST",  
    data:{id:id},  
    dataType:"json",  
    success:function(data){  
     $('#user_id').val(data.user_id);  
     $('#username').val(data.username);  
     $('#ticket_type').val(data.ticket_type);
     $('#ticket_details').val(data.ticket_details); 
     $('#ass_person').val(data.ass_person); 
     $('#review').val(data.review); 
     $('#id').val(data.id);      

     $('#insert').val("Update");  
     $('#add_data_Modal').modal('show');
     $('#modalTitle').html("Update Ticket");  
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
     url:"action/update-ticket.php",  
     method:"POST",  
     data:$('#insert_form').serialize(),  
     beforeSend:function(){  
      $('#insert').val("Inserting");  
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


$(document).on('click', '.fetch_data', function(){  
   var username = $('#user_id').val();
   //alert(username);  
   $.ajax({  
    url:"fetch/fetch-user-data.php",  
    method:"POST",  
    data:{username:username},  
    dataType:"json",  
    success:function(data){  
      if(data == null){
        swal("User not found!");
      }else{
       $('#username2').val(data.cus_name);  
      }
     
   }  
 }); 
 });   
</script>


<div id="add_data_Modal" class="modal fade">  
 <div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h4 id="modalTitle" class="modal-title"><b>Update Ticket</b></h4>
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
              <label for="exampleInputEmail1">User-ID </label><i class="fa fa-refresh text-green fetch_data" style="float:right;"> Fetch User Data</i>
              <input type="text" class="form-control" name="user_id" id="user_id">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Customer Name</label>
              <input type="text" class="form-control" name="username" id="username2">
            </div>
            <div class="form-group">
              <label>Ticket Type</label>
              <select class="form-control" name="ticket_type" id="ticket_type"  >
                <option value="">Select Ticket type</option>
                <?php
                $sql5 = "SELECT * FROM ticket_type";
                if($result5 = mysqli_query($conn, $sql5)){
                  if(mysqli_num_rows($result5) > 0){
                   while($row = mysqli_fetch_array($result5)){
                    echo '<option value="'. $row['type_name'] .'">' . $row['type_name'] . '</option>';
                  }
                }
              } 
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Send SMS to User</label>
            <input type="checkbox" id="sendsms" name="sendsms" value="yes">
          </div>



          <!-- /.form-group -->

          <!-- /.form-group -->
        </div>
        <!-- /.col -->
        <div class="col-md-6">
          <div class="form-group">
            <label for="exampleInputEmail1">Ticket Details</label>
            <textarea type="text" class="form-control" name="ticket_details" id="ticket_details"></textarea>
          </div>
          <!-- /.form-group -->
          <div class="form-group">
           <div class="form-group">
            <label>Assigned Executive</label>
            <select multiple class="form-control" name="ass_person[]" id="ass_person"  style="width: 100%;">
             <!--  <option value="<?php echo $_SESSION['username'];?>"><?php echo $_SESSION['full_name'];?></option> -->
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
            <label for="exampleInputEmail1">Created By</label>
            <input type="text" class="form-control" name="created_by" value="<?php echo $_SESSION['username'];  ?>" readonly>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Send Email to User</label>
            <input type="checkbox" id="sendemail" name="sendemail" value="yes">
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
     <!--  <div class="col-md-12">
        <div class="form-group">
          <label for="exampleInputEmail1">Review / Comment</label>
          <textarea type="text" class="form-control" name="review" id="review"></textarea>
        </div>
      </div> -->
      <!-- /.card-body -->
      <div class="card-footer">
       <input type="submit" name="insert" id="insert" value="Insert Ticket" class="btn btn-primary" /> 
     </div>
   </form>
 </div>
 <!-- /.row -->
</div>
  <!-- jQuery 3 --> 

</body>
</html>
