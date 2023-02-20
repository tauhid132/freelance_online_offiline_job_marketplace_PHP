<?php
session_start();
include('../../db/conn.php');
$month=$_GET['month'];

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
  <title>Unpaid Users | <?php echo $siteName; ?></title>
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
     <h1><i class="fa fa-users"></i> Unpaid Users of <?php echo date("F-Y") ?></h1>
     <ol class="breadcrumb">
       <a href="../pdf/unpaidusers.php"><button class="btn btn-info btn-sm ml-3" style="float: right;" id="add" ><i class="fa fa-file-pdf-o"></i> Download PDF </button></a>
       <a href="../sms/reminder-sms.php"><button class="btn btn-warning btn-sm ml-3" style="float: right;" id="add" ><i class="fa fa fa-send"></i> Send Reminder </button></a>
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
             <th>User Name</th>
             <th>Monthly Bill</th>
             <th>Due Bill</th>
             <th>Paid Monthly</th>
             <th>Paid Due</th>
             <th>Comment</th>
             <th>Action</th>
           </tr>
         </thead>
         <tbody>
           <?php

// Attempt select query execution
           $i=1;
           $sql = "SELECT * FROM billing WHERE billing_month = '$month' && paid_bill=0 && paid_due=0";
           if($result = mysqli_query($conn, $sql)){
            if(mysqli_num_rows($result) > 0){

              while($row = mysqli_fetch_array($result)){

                echo "<tr>";
                echo "<td>" . $i . "</td>";
                if(($row['paid_bill']==$row['monthly_bill']) && ($row['paid_due']==$row['pre_due'])) 
                  echo '<td><span class="badge badge-success">'.$row['user_id'].'</span></td>'; 
                else if(($row['paid_bill']==0) && ($row['paid_due']==0))
                  echo '<td><span class="badge badge-danger">'.$row['user_id'].'</span></td>'; 
                else echo '<td><span class="badge badge-warning">'.$row['user_id'].'</span></td>';
                echo "<td>" . $row['cus_name'] . "</td>";
                echo "<td>" . $row['monthly_bill'] . "</td>";
                echo "<td>" . $row['pre_due'] . "</td>";
                echo "<td>" . $row['paid_bill'] . "</td>";
                echo "<td>" . $row['paid_due'] . "</td>";
                echo "<td>" . $row['comment'] . "</td>";
                echo '<td>
                <a class="send_reminder" id="'. $row["id"].'" >
                <i class="fa fa-send text-info" style="font-size:20px"></i>
                </a>
                <i class="fa fa-comments-o f-w-600 f-16 text-red add_comment" id="'. $row["id"].'"  style="font-size:20px"></i>

                </td></form>';
                $i++;

                echo "</tr>";

              }

        // Free result set
              mysqli_free_result($result);
            } 
          } else

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
  });
  $(document).on('click', '.send_reminder', function(){  
   var id = $(this).attr("id");  


   swal({
    title: "Are you sure?",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
   .then((willDelete) => {
    if (willDelete) {


      //$('.send_reminder').attr("href", "reminder.php?id="+id);
      $.ajax({
        url:"action/send-reminder.php",
        method:"POST",
        data:{id:id},
        success:function(data){
          swal("SMS Sent Successfully!!", {
            icon: "success",
          });
        }
      })
    } else {
      swal("Your imaginary file is safe!");
      return false;
    }
  });
 });  

   $(document).on('click', '.add_comment', function(){  
        var id = $(this).attr("id");
        swal("Comment", {
          content: "input",
        })
        .then((value) => {
        //swal(`You typed: ${value}`);
        var comment = value;
          $.ajax({
            url:"action/add-comment.php",
            method:"POST",
            data:{id:id,comment:comment},
            success:function(data){

              dataTable.ajax.reload(); 
            }
          });
       
      });


      });
</script>

<!-- jQuery 3 --> 

</body>
</html>
