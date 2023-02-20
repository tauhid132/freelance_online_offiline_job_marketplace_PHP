<?php
// Initialize the session
session_start();
include('../../db/conn.php');


// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
}
$month=$_GET['month'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Monthly Salary | <?php echo $siteName; ?></title>
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
       <h1><i class="fa fa-money"></i> Monthly Salary Sheet of <?php echo $month ?> </h1>
      <ol class="breadcrumb">
        <li><a href="#">Accounts</a></li>
        <li><i class="fa fa-angle-right"></i> salary</li>
      </ol>
    </div>
     <div class="col-md-12">
      <form role="form" method="get" action="salary.php">
        <div class="input-group">
         <select class="custom-select form-control" data-placeholder="Type to search cities" name="month" >
         
          <?php
          for($j=0; $j<=11; $j++){
            //echo "'".date('F-Y', strtotime("-$j Months"))."'";
            echo '<option value="'.date('F-Y', strtotime("-$j Months")).'">'.date('F-Y', strtotime("-$j Months")).'</option>';
          }
          ?>
        </select>
        <div class="input-group-append">
          <button class="btn btn-outline-secondary" type="submit">Search</button>
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
            <thead>
              <tr>
              <th>No</th>
                <th>Employee Name</th>

                <th>Salary</th>
                <th>Pre Advance</th>
                <th>Meal</th>
                <th>Commission</th>
                <th>Payable</th>
                <th>Paid</th>
                <th>Date</th>
                <th>Remaining</th>
                <th>Action</th>
             </tr>
           </thead>
           <tbody>
          <?php
             $i=1;
             $sql = "SELECT * FROM salary WHERE month = '$month'";
             if($result = mysqli_query($conn, $sql)){
              if(mysqli_num_rows($result) > 0){

                while($row = mysqli_fetch_array($result)){

                 echo "<tr>";


                 echo "<td>" . $i . "</td>";
                 echo "<td>" . $row['emp_name'] . "</td>";


                 echo "<td>" . $row['salary'] . "</td>";
                 echo "<td>" . $row['pre_advance'] . "</td>";
                 echo "<td>" . $row['meal'] . "</td>";
                 echo "<td>" . $row['commission'] . "</td>";
                 $payable=$row['salary']+$row['commission']-$row['meal']-(-$row['pre_advance']);
                 echo "<td>" . $payable . "</td>";
                 echo "<td>" . $row['paid'] . "</td>";
                 echo "<td>" . $row['date'] . "</td>";
                 $remaining=$payable-$row['paid'];
                 echo "<td>" . $remaining . "</td>";
                 echo '<td><a>
                 <i class="fa fa-money text-info pay_salary" id="'. $row["id"].'" style="font-size:20px"></i>
                 <i class="fa fa-edit text-success edit_data" id="'. $row["id"].'" style="font-size:20px"></i>
                 </a>

                 </td></form>';


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

<div id="add_data_Modal" class="modal fade">  
  <div class="modal-dialog">  
   <div class="modal-content">  
    <div class="modal-header">  
     <h4 class="modal-title">Bill Payment</h4>
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">  
     </div>  
     <div class="modal-body">  
       <form method="post" id="insert_form">  
        <label>No</label>  
        <input type="hidden" name="id" id="id" class="form-control" />  
        <br />  
        <label>EMP Name</label>  
        <input type="text" name="emp_name" id="emp_name" class="form-control" />  
        <br />  
        <label>Salary</label>  
        <input type="text" name="salary" id="salary" class="form-control" />  
        <br />  
        <label>Pre Advance</label>  
        <input type="text" name="pre_advance" id="pre_advance" class="form-control" />  
        <br />  
        <label>Meal</label>  
        <input type="text" name="meal" id="meal" class="form-control" />  
        <br />  
        <label>Commission</label>  
        <input type="text" name="commission" id="commission" class="form-control" />  
        <br />  
        
        <input type="hidden" name="paid" id="paid" class="form-control" />  
        <br /> 
        <!-- <label>Date</label>   -->
        <input type="hidden" name="date" id="date" class="form-control" />  
        
        <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />  
      </form>  
    </div>  
    <div class="modal-footer">  
     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
   </div>  
 </div>  
</div>  
</div>  
<div id="pay_salary_modal" class="modal fade">  
  <div class="modal-dialog">  
   <div class="modal-content">  
    <div class="modal-header">  
     <h4 class="modal-title">Salary Payment</h4>
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">  
     </div>  
     <div class="modal-body">  
       <form method="post" id="insert_form2">  
        <input type="hidden" name="id" id="id2" class="form-control" />  
        <br />  
        <label>EMP Name</label>  
        <input type="text" name="emp_name" id="emp_name2" class="form-control" />  
        <br />  
        <!-- <label>Salary</label>   -->
        <input type="hidden" name="salary" id="salary2" class="form-control" />  
        <!-- <br />   -->
       
        <input type="hidden" name="pre_advance" id="pre_advance2" class="form-control" />  
        
        
        <input type="hidden" name="meal" id="meal2" class="form-control" />  
        
       
        <input type="hidden" name="commission" id="commission2" class="form-control" />  
       
        <label>Paid</label>  
        <input type="text" name="paid" id="paid2" class="form-control" />  
        <br /> 
        <label>Date</label>  
        <input type="date" name="date" id="date2" class="form-control" />  
        <br /> 
        <input type="submit" name="insert" id="insert2" value="Pay Salary" class="btn btn-success" />  
      </form>  
    </div>  
    <div class="modal-footer">  
     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
   </div>  
 </div>  
</div>  
</div>  
<script>  
 $(document).ready(function(){  
  $('#salary-table').DataTable();
  $('#add').click(function(){  
   $('#insert').val("Insert");  
   $('#insert_form')[0].reset();  
 });  
  $(document).on('click', '.edit_data', function(){  
   var id = $(this).attr("id");  
   $.ajax({  
    url:"fetch/fetch-salary.php",  
    method:"POST",  
    data:{id:id},  
    dataType:"json",  
    success:function(data){  
     $('#emp_name').val(data.emp_name);  
     $('#username').val(data.username);  
     $('#salary').val(data.salary);
     $('#meal').val(data.meal); 
     $('#pre_advance').val(data.pre_advance);
     $('#commission').val(data.commission); 
     $('#paid').val(data.paid);
     $('#date').val(data.date);
     $('#id').val(data.id);      

     $('#insert').val("Update");  
     $('#add_data_Modal').modal('show');  
   }  
 });  
 });  
  $(document).on('click', '.pay_salary', function(){  
   var id = $(this).attr("id");  
   $.ajax({  
    url:"fetch/fetch-salary.php",  
    method:"POST",  
    data:{id:id},  
    dataType:"json",  
    success:function(data){  
     $('#emp_name2').val(data.emp_name);  
     $('#username2').val(data.username);  
     $('#salary2').val(data.salary);
     $('#meal2').val(data.meal); 
     $('#pre_advance2').val(data.pre_advance);
     $('#commission2').val(data.commission); 
     $('#paid2').val(data.paid);
     $('#date2').val(data.date);
     $('#id2').val(data.id);      

     $('#insert').val("Update");  
     $('#pay_salary_modal').modal('show');  
   }  
 });  
 });  
  $('#insert_form').on("submit", function(event){  
   event.preventDefault();  
   
    $.ajax({  
     url:"action/update-salary.php",  
     method:"POST",  
     data:$('#insert_form').serialize(),  
     beforeSend:function(){  
      $('#insert').val("Inserting");  
    },  
    success:function(data){  
      $('#insert_form')[0].reset();  
      $('#add_data_Modal').modal('hide');  
      $('#employee_table').html(data);
      $(location.reload());  
    }  
  });   
});  

  $('#insert_form2').on("submit", function(event){  
   event.preventDefault();  

   
    $.ajax({  
     url:"action/pay-salary.php",  
     method:"POST",  
     data:$('#insert_form2').serialize(),  
     beforeSend:function(){  
      $('#insert').val("Inserting");  
    },  
    success:function(data){  
      $('#insert_form2')[0].reset();  
      $('#pay_salary_modal').modal('hide');  
      $(location.reload());  
    }  
  });   
});  


});  
</script>
</div>
</body>
</html>
