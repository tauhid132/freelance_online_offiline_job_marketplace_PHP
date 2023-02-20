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
  <title>Tasks | <?php echo $siteName; ?></title>
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
      <h1><i class="fa fa-tasks"></i> Tasks & Workorders Management </h1>
      <ol class="breadcrumb">
       <button class="btn btn-info btn-sm" style="float: right;" id="add" data-toggle="modal" data-target="#add_task_Modal"><i class="fa fa-plus"></i> Create New Task</button>
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
              <th>Status</th>
              <th>Action</th>

              <th>Description</th>
              <th>Create Time</th>
              <th>Created By</th>
              <th>Assigned Person</th>
              <th>Finish Timestamp</th>
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
     $('#modalTitle').html("Create New Task");  
   });  
    $(document).on('click', '.edit_data', function(){  
     var id = $(this).attr("id");  
     $.ajax({  
      url:"fetch/fetch-tasks-single.php",  
      method:"POST",  
      data:{id:id},  
      dataType:"json",  
      success:function(data){  
       $('#description').val(data.description);  
       $('#create_time').val(data.create_time);
       $('#created_by').val(data.created_by); 
       $('#assigned_person').val(data.assigned_person);
       $('#status').val(data.status);
       $('#id').val(data.id);      
       $('#insert').val("Update");  
       $('#add_task_Modal').modal('show');
       $('#modalTitle').html("Update Task");  
      }  
     });  
   });  

    $(document).on('click', '.delete_task', function(){  
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
            url:"action/delete-tasks.php",
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
    $(document).on('click', '.close_task', function(){  
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
            url:"action/close-tasks.php",
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
       url:"action/update-task.php",  
       method:"POST",  
       data:$('#insert_form').serialize(),  
       beforeSend:function(){  
        $('#insert').val("Inserting");  
      },  
      success:function(data){  
        $('#insert_form')[0].reset();  
        $('#add_task_Modal').modal('hide');  
        dataTable.ajax.reload();

        //$(location.reload());  
      }  
    });  
    }  
  });  



  });  
</script>
<div id="add_task_Modal" class="modal fade">  
 <div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h4 id="modalTitle" class="modal-title"><b>Create New Ticket</b></h4>
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
              <label>Assigned Executive</label>
              <select class="form-control" name="assigned_person" id="assigned_person"  style="width: 100%;">
                <option value="Not Assigned">Select One</option>
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
              <label for="exampleInputEmail1">Send SMS</label>
              <input type="checkbox" name="sendsms" id="sendsms" value="yes">
            </div>

            <!-- /.form-group -->

            <!-- /.form-group -->
          </div>
          <!-- /.col -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="exampleInputEmail1">Task Description</label>
              <textarea type="text" class="form-control" name="description" id="description"></textarea>
            </div>
            <!-- /.form-group -->


            <div class="form-group">
              <label for="exampleInputEmail1">Created By</label>
              <input type="text" class="form-control" name="created_by" value="<?php echo $_SESSION['username'];  ?>" readonly>
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
