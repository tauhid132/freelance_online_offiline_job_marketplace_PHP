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
  <title>Monthly Upstream Bill | <?php echo $siteName; ?></title>
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
       <h1><i class="fa fa-money"></i> Monthly Upstream Bill of <?php echo $month ?> </h1>
      <ol class="breadcrumb">
        <li><a href="#">Accounts</a></li>
        <li><i class="fa fa-angle-right"></i> Upstream Bill</li>
      </ol>
    </div>
     <div class="col-md-12">
      <form role="form" method="get" action="upstream-bill.php">
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
                <th>Upstream</th>
                <th>Bill</th>
                <th>Due</th>
                <th>Total</th>
                <th>Paid</th>
                <th>Date</th>
                <th>Remaining</th>

                <th>Action</th>
             </tr>
           </thead>
           <tbody>
          <?php
             $i=1;
             $sql = "SELECT * FROM upstream_bill WHERE month = '$month'";
             if($result = mysqli_query($conn, $sql)){
              if(mysqli_num_rows($result) > 0){

                while($row = mysqli_fetch_array($result)){

                 echo "<tr>";


                 echo "<td>" . $i . "</td>";
                 echo "<td>" . $row['upstream'] . "</td>";

                 echo "<td>" . $row['bill'] . "</td>";
                 echo "<td>" . $row['due'] . "</td>";
                 $total=$row['bill']+$row['due'];
                 echo "<td>" . $total . "</td>";
                 echo "<td>" . $row['paid'] . "</td>";
                 echo "<td>" . $row['date'] . "</td>";
                 $remaining=$total-$row['paid'];
                 echo "<td>" . $remaining . "</td>";

                 echo '<td><a>
                 <i class="fa fa-money edit_data" id="'. $row["id"].'" style="font-size:20px"></i>
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
        <input type="text" name="id" id="id" class="form-control" />  
        <br />  
        <label>Upstream Name</label>  
        <input type="text" name="upstream" id="upstream" class="form-control" />  
        <br />  
        <label>Bill</label>  
        <input type="text" name="bill" id="bill" class="form-control" />  
        <br />  
        <label>Due</label>  
        <input type="text" name="due" id="due" class="form-control" />  
        <br />  
        <label>Paid</label>  
        <input type="text" name="paid" id="paid" class="form-control" />  
        <br />  

        <label>Date</label>  
        <input type="date" name="date" id="date" class="form-control" />  
        <br /> 







        <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />  
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
  $('#upstream-table').DataTable();
  $('#add').click(function(){  
   $('#insert').val("Insert");  
   $('#insert_form')[0].reset();  
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
     $('#month').val(data.month);  
     $('#bill').val(data.bill);
     $('#due').val(data.due); 
     $('#paid').val(data.paid);
     $('#date').val(data.date); 

     $('#id').val(data.id);      

     $('#insert').val("Update");  
     $('#add_data_Modal').modal('show');  
   }  
 });  
 });  
  $('#insert_form').on("submit", function(event){  
   event.preventDefault();  
    $.ajax({  
     url:"action/update-upstream.php",  
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


});  
</script>
</div>
</body>
</html>
