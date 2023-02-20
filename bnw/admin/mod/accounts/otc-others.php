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
  <title>Monthly OTC | <?php echo $siteName; ?></title>
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
     <h1><i class="fa fa-money"></i> OTC & Others Payment of <?php echo $month ?> </h1>
     <ol class="breadcrumb">
      <li><a href="#">Accounts</a></li>
      <li><i class="fa fa-angle-right"></i> otc</li>
    </ol>
  </div>
  <div class="col-md-12">
    <form role="form" method="get" action="otc-others.php">
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
           <th>User ID</th>
           <th>Customer Name</th>
           <th>On Account Of</th>
           <th>Amount</th>
           <th>Paid</th>
           <th>Date</th>
           <th>Action</th>
         </tr>
       </thead>
       <tbody>
         <?php
         $i=1;
         $sql = "SELECT * FROM otc_others WHERE month = '$month'";
         if($result = mysqli_query($conn, $sql)){
          if(mysqli_num_rows($result) > 0){

            while($row = mysqli_fetch_array($result)){

             echo "<tr>";


             echo "<td>" . $i . "</td>";
             echo "<td>" . $row['user_id'] . "</td>";

             echo "<td>" . $row['cus_name'] . "</td>";
             echo "<td>" . $row['on_account'] . "</td>";
             echo "<td>" . $row['amount'] . "</td>";
             echo "<td>" . $row['paid'] . "</td>";
             echo "<td>" . $row['pay_date'] . "</td>";
             echo '<td><a>
             <i class="fa fa-money text-success edit_data" id="'. $row["id"].'" style="font-size:20px"></i>
             <i class="fa fa-edit text-info edit_item" id="'. $row["id"].'" style="font-size:20px"></i>
             <i class="fa fa-trash text-danger delete_item" id="'. $row["id"].'" style="font-size:20px"></i>
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
</div>
<!-- /.content --> 

<!-- /.content-wrapper -->
<?php include('../../includes/footer.php') ?>
</div>
<!-- ./wrapper --> 
<?php include('../../includes/js.php') ?>
<script>
  $(function () {
    $('#example1').DataTable()

  })
</script>

<div id="add_data_Modal" class="modal fade">  
  <div class="modal-dialog">  
   <div class="modal-content">  
    <div class="modal-header">  
     <h4 id="modalTitle" class="modal-title">OTC / Others Payment</h4>
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">  
     </div>  
     <div class="modal-body">  
       <form method="post" id="insert_form">  

        <input type="hidden" name="id" id="id" class="form-control" />  
        <br />
        <label>Payable Amount</label>  
        <input type="text" name="amount" id="amount" class="form-control" />  
        <br />    

        <label>Paid Amount</label>  
        <input type="text" name="paid" id="paid" class="form-control" />  
        <br />  
        <div class="form-group">
          <label>Payment Method</label>
          <select class="form-control" name="pay_method" id="pay_method">
            <option value="">Select Payment Method</option>
            <option value="Cash">Cash</option>
            <option value="Bkash">Bkash</option>
            <option value="Nogod">Nogod</option>
            <option value="Bank">Bank</option>

          </select>
        </div> 
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
  $('#otc-table').DataTable();
  $('#add').click(function(){  
   $('#insert').val("Insert");  
   $('#insert_form')[0].reset();  
 });  
  $(document).on('click', '.edit_data', function(){  
   var id = $(this).attr("id");  
   $.ajax({  
    url:"fetch/fetch-otc.php",  
    method:"POST",  
    data:{id:id},  
    dataType:"json",  
    success:function(data){  
     $('#paid').val(data.paid);
     $('#date').val(data.date);
     $('#amount').val(data.amount);
     $('#pay_method').val(data.pay_method);  
     $('#id').val(data.id);      
     $('#insert').val("Update");  
     $('#add_data_Modal').modal('show');
     $('#modalTitle').html("Add Payment");  
   }  
 });  
 });
  $(document).on('click', '.edit_item', function(){  
   var id = $(this).attr("id");  
   $.ajax({  
    url:"fetch/fetch-otc.php",  
    method:"POST",  
    data:{id:id},  
    dataType:"json",  
    success:function(data){  
     $('#paid').val(data.paid);
     $('#date').val(data.date);
     $('#amount').val(data.amount);   
     $('#id').val(data.id);      
     $('#insert').val("Update");  
     $('#add_data_Modal').modal('show');
     $('#modalTitle').html("Update Item");  
   }  
 });  
 });
  $(document).on('click', '.delete_item', function(){  
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
          url:"action/delete-otc.php",
          method:"POST",
          data:{id:id},
          success:function(data){
            swal("Deleted Successfully!!", {
              icon: "success",
            });
            $(location.reload());
          }
        })
      } else {
        return false;
      }
    });
  });    
  $('#insert_form').on("submit", function(event){  
   event.preventDefault();  
   
   $.ajax({  
     url:"action/update-otc.php",  
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
