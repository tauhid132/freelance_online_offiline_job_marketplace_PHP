<?php
// Initialize the session
session_start();
include('../../db/conn.php');


// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
	header("location: ../../login.php");
	exit;
}
$month=$_GET['month'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Monthly Expenses | <?php echo $siteName; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1" />

  <?php include('../../includes/stylesheet.php') ?>


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
      <h1><i class="fa fa-money"></i> Monthly Expenses of <?php echo $month ?> </h1>
      <ol class="breadcrumb">
       <button class="btn btn-info btn-sm" style="float: right;" id="add" data-toggle="modal" data-target="#modal-add-expences"><i class="fa fa-plus"></i> Add Expense</button>
     </ol>
   </div>
  <div class="col-md-12">
    <form role="form" method="get" action="view-expence.php">
      <div class="input-group">
       <select class="custom-select form-control" data-placeholder="Type to search cities" name="month" >
        <option><?php echo $month;  ?></option>
        <?php
        for($j=0; $j<=11; $j++){
            //echo "'".date('F-Y', strtotime("-$j Months"))."'";
          echo '<option value="'.date('F-Y', strtotime("-$j Months")).'">'.date('F-Y', strtotime("-$j Months")).'</option>';
        }
        ?>
      </select>
      <div class="input-group-append">
        <button class="btn btn-outline-info" type="submit">Search</button>
      </div>
    </div>
  </form>
</div>




<!-- Main content -->
<div class="content"> 

  <!-- Small boxes (Stat box) -->
  <div class="info-box">

    <div class="table-responsive">
      <table id="example1" class="table table-bordered table-striped">
        <thead style="background-color: #0099ff;">
          <tr>
           <th>Exp No</th>
           <th>Expence Type</th>
           <th>Description</th>
           <th>Amount</th>
           <th>Date</th>
           <th>By</th>
           <th>Action</th>
         </tr>
       </thead>
       <tbody>
         <?php
         $i=1;
         $sql = "SELECT * FROM expences WHERE month = '$month'";
         if($result = mysqli_query($conn, $sql)){
          if(mysqli_num_rows($result) > 0){

            while($row = mysqli_fetch_array($result)){

             echo "<tr>";


             echo "<td>" . $i . "</td>";
             echo "<td>" . $row['exp_type'] . "</td>";

             echo "<td>" . $row['description'] . "</td>";
             echo "<td>" . $row['amount'] . "</td>";
             echo "<td>" . $row['date'] . "</td>";
             echo "<td>" . $row['exp_by'] . "</td>";
             echo '<td>

             <i class="fa fa-edit text-info edit_exp" id=' . $row['id'] . ' style="font-size:20px"></i>
             <i class="fa fa-trash text-danger delete_exp" id=' . $row['id'] . ' style="font-size:20px"></i>
             
             </td>';



             echo "</tr>";
             $i++;
           }

        // Free result set
           mysqli_free_result($result);
         } else{

         }
       } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
      }


// Close connection

      ?>
    </tbody>
    <tfoot>

    </tfoot>
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
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<script>
  $(document).ready( function () {
    $('#table_user').DataTable();
  });
  $(document).on('click', '.delete_exp', function(){  
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
            url:"action/delete-exp.php",
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
  <script>  
   $(document).ready(function(){  
    $('#exp-table').DataTable();
    $('#add').click(function(){  
     $('#insert').val("Insert");  
     $('#insert_form')[0].reset();
     $('#id').val(null);
     $('#modalTitle').html("Add New Expense"); 
   });  
    $(document).on('click', '.edit_exp', function(){  
     var id = $(this).attr("id");  
     $.ajax({  
      url:"action/fetch-exp.php",  
      method:"POST",  
      data:{id:id},  
      dataType:"json",  
      success:function(data){    
       $('#exp_type').val(data.exp_type); 
       $('#description').val(data.description);  
       $('#amount').val(data.amount);
       $('#date').val(data.date); 
       $('#exp_by').val(data.exp_by); 
       $('#id').val(data.id);      

       $('#insert').val("Update");  
       $('#modal-add-expences').modal('show');
       $('#modalTitle').html("Update Expense");  
     }  
   });  
   });  






    $('#insert_form').on("submit", function(event){  
     event.preventDefault();  

     if($('#description').val() == '')  
     {  
      swal("Please Enter Description!");  
    } else if($('#amount').val() == ''){
     swal("Please Enter Amount!");
   } 


   else  
   {  
    $.ajax({  
     url:"action/add-expense.php",  
     method:"POST",  
     data:$('#insert_form').serialize(),  
     beforeSend:function(){  
      $('#insert').val("Updating");  
    },  
    success:function(data){  
      $('#insert_form')[0].reset();  
      $('#modal-add-expences').modal('hide');  
      $(location.reload());  
    }  
  });  
  }  
});  


  });  
</script>
<!-- jQuery 3 --> 
<div class="modal fade" id="modal-add-expences">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 id="modalTitle" class="modal-title"><b>Add/Update Expence</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" id="insert_form" method="POST">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <input type="hidden" name="id" id="id">
                  <label>Expense Type</label>
                  <select class="form-control select2bs4" name="exp_type" id="exp_type" style="width: 100%;">
                    <option value="Others">Select One</option>
                    <option value="Convence">Convence</option>
                    <option value="Utilities">Utilities</option>
                    <option value="Networking">Networking</option>
                    <option value="Meal">Meal</option>
                    <option value="Others">Others</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                  <input type="text" class="form-control" name="description" id="description">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Amount</label>
                  <input type="text" class="form-control" name="amount" id="amount">
                </div>


                <!-- /.form-group -->
                
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Date</label>
                  <input type="date" class="form-control" id="date" name="date">
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                 <div class="form-group">
                  <label>BY</label>
                  <select class="form-control select2bs4" name="exp_by" id="exp_by" style="width: 100%;">
                    <option value=""></option>
                    <?php
                    $sql2 = "SELECT * FROM employee";
                    if($result = mysqli_query($conn, $sql2)){
                      if(mysqli_num_rows($result) > 0){

                        while($row = mysqli_fetch_array($result)){
                          echo"<option value=" . $row['username'] . ">" . $row['username'] . "</option>";

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
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Month</label>
                <input type="text" class="form-control" name="month" Value="<?php echo date("F-Y") ?>">
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
</body>
</html>
