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
  <title>Users Settings | <?php echo $siteName; ?></title>
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
     <h1><i class="fa fa-cog"></i> Users setting Management </h1>
      <ol class="breadcrumb">
        <li><a href="#">Users</a></li>
        <li><i class="fa fa-angle-right"></i> User Setting</li>
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
               <th>Status</th>
               <!--  -->
               <th>User Name</th>
               <th>SendSMS</th>
               <th>SendEmail</th>
               <th>Enable Api</th>
               <th>Auto Disconnect</th>
               <th>Print Invoice</th>
             </tr>
           </thead>
           <tbody>
            <?php

// Attempt select query execution
            $sql = "SELECT * FROM users";
            if($result = mysqli_query($conn, $sql)){
              if(mysqli_num_rows($result) > 0){

                while($row = mysqli_fetch_array($result)){

                  echo "<tr>";
                  echo "<td>" . $row['id'] . "</td>";
                  echo "<td>" . $row['username'] . "</td>";
                  if($row['status']=='Active')
                    echo '<td><span class="badge badge-success">Active</span></td>'; 
                  else if($row['status']=='Inactive')
                    echo '<td><span class="badge badge-danger">Inactive</span></td>';
                  else if($row['status']=='Expired')
                    echo '<td><span class="badge badge-warning">Expired</span></td>';

                  echo "<td>" . $row['cus_name'] . "</td>";
                  if($row['sendSms']==1){
                    echo '<td><input class="sms_setting" id="'. $row["id"].'" type="checkbox" checked="yes" ></td>';
                  }else if($row['sendSms']==0){
                    echo '<td><input class="sms_setting" id="'. $row["id"].'" type="checkbox" data-size="xs"></td>';
                  }
                  if($row['sendEmail']==1){
                    echo '<td><input class="email_setting" id="'. $row["id"].'" type="checkbox"   checked="yes" data-size="xs"></td>';
                  }else if($row['sendEmail']==0){
                    echo '<td><input class="email_setting" id="'. $row["id"].'" type="checkbox"  data-size="xs"></td>';
                  }
                  if($row['apiEnabled']==1){
                    echo '<td><input class="api_setting" id="'. $row["id"].'" type="checkbox"   checked="yes" data-size="xs"></td>';
                  }else if($row['apiEnabled']==0){
                    echo '<td><input class="api_setting" id="'. $row["id"].'" type="checkbox" data-size="xs"></td>';
                  }
                  if($row['autoDisconnect']==1){
                    echo '<td><input class="auto_disconnect" id="'. $row["id"].'" type="checkbox"   checked="yes" data-size="xs"></td>';
                  }else if($row['autoDisconnect']==0){
                    echo '<td><input class="auto_disconnect" id="'. $row["id"].'" type="checkbox" data-size="xs"></td>';
                  }
                  if($row['printInvoice']==1){
                    echo '<td><input class="invoice_setting" id="'. $row["id"].'" type="checkbox"   checked="yes" data-size="xs"></td>';
                  }else{
                    echo '<td><input class="invoice_setting" id="'. $row["id"].'" type="checkbox" data-size="xs"></td>';
                  }
                                // echo "<td>" . $row['due'] . "</td>";



        //echo "<td>" . $row['due'] . "</td>";









                  echo "</tr>";

                }

       
              } else{
                echo "No records matching your query were found.";
              }
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
<script>
  $(document).ready( function () {
    $('#table_user').DataTable();
    $(document).on('click', '.sms_setting', function(){  
      var id = $(this).attr("id");
      $.ajax({
        url:"action/enable-disable-smsoption.php",
        method:"POST",
        data:{id:id},
        success:function(data){
          swal(data, {
            icon: "success",
          }); 
        }
      })

    }); 
    $(document).on('click', '.email_setting', function(){  
      var id = $(this).attr("id");
      $.ajax({
        url:"action/enable-disable-emailoption.php",
        method:"POST",
        data:{id:id},
        success:function(data){
          swal(data, {
            icon: "success",
          }); 
        }
      })

    }); 
    $(document).on('click', '.api_setting', function(){  
      var id = $(this).attr("id");
      $.ajax({
        url:"action/enable-disable-apioption.php",
        method:"POST",
        data:{id:id},
        success:function(data){
          swal(data, {
            icon: "success",
          }); 
        }
      })

    }); 
     $(document).on('click', '.auto_disconnect', function(){  
      var id = $(this).attr("id");
      $.ajax({
        url:"action/enable-disable-autodisconnect.php",
        method:"POST",
        data:{id:id},
        success:function(data){
          swal(data, {
            //icon: "success",
          }); 
        }
      })

    }); 
    $(document).on('click', '.invoice_setting', function(){  
      var id = $(this).attr("id");
      $.ajax({
        url:"action/enable-disable-invoiceoption.php",
        method:"POST",
        data:{id:id},
        success:function(data){
          swal(data, {
            icon: "success",
          }); 
        }
      })

    }); 
    function test(){
      alert("hh");
    }
  });

</script>

</body>
</html>
