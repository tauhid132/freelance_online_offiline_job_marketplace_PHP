<?php
session_start();
include('../../db/conn.php');

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: ../../login");
  exit;
}
$month=$_GET['month'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Online Payments | <?php echo $siteName; ?></title>
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
      <h1><i class="fa fa-credit-card"></i> Online Payments of <?php echo $month ?> </h1>
      <ol class="breadcrumb">
        <li><a href="#">Accounts</a></li>
        <li><i class="fa fa-angle-right"></i> Online Payment</li>
      </ol>
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
                <th>User-ID</th>
                <th>Customer Name</th>
                <th>Paid Bill</th>
                <th>Paid Due</th>
                <th>Pay Method</th>
                <th>TRX ID</th>
                <th>Date</th>
             </tr>
           </thead>
           <tbody>
            <?php
             $i=1;
             $sql = "SELECT * FROM billing WHERE billing_month = '$month' && (pay_method='bkash' || pay_method='Bank' || pay_method='Nogod' || pay_method='Rocket' )";
             if($result = mysqli_query($conn, $sql)){
              if(mysqli_num_rows($result) > 0){

                while($row = mysqli_fetch_array($result)){

                 echo "<tr>";


                 echo "<td>" . $i . "</td>";


                 echo "<td>" . $row['user_id'] . "</td>";
                 echo "<td>" . $row['cus_name'] . "</td>";
                 echo "<td>" . $row['paid_bill'] . "</td>";
                 echo "<td>" . $row['paid_due'] . "</td>";
                 echo "<td>" . $row['pay_method'] . "</td>";
                 echo "<td>" . $row['trxid'] . "</td>";
                 echo "<td>" . $row['pay_date'] . "</td>";



                 echo "</tr>";
                 $i++;
               }

        // Free result set
               mysqli_free_result($result);
             } else{

             }
           } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
          }
          $sql2 = "SELECT * FROM otc_others WHERE month = '$month' && pay_method='bkash'";
          if($result = mysqli_query($conn, $sql2)){
            if(mysqli_num_rows($result) > 0){

              while($row = mysqli_fetch_array($result)){

               echo "<tr>";


               echo "<td>" . $i . "</td>";


               echo "<td>" . $row['user_id'] . "</td>";
               echo "<td>" . $row['cus_name'] . "</td>";
               echo "<td>" . $row['on_account'] . "</td>";
               echo "<td>" . $row['paid'] . "</td>";
               echo "<td>" . $row['pay_method'] . "</td>";
               echo "<td> ------ </td>";
               echo "<td>" . $row['pay_date'] . "</td>";




               echo "</tr>";
               $i++;
             }

        // Free result set
             mysqli_free_result($result);
           } else{

           }
         } else{
          echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
        }

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


</body>
</html>
