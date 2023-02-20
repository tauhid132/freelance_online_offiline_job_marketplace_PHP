<?php
session_start();
include ('../database/dbconnect.php');

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
  <title>All Users | <?php echo $siteName; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1" />

  <?php include('includes/stylesheet.php') ?>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper boxed-wrapper">
   <?php include('includes/header.php') ?>
   <!-- Left side column. contains the logo and sidebar -->
   <aside class="main-sidebar"> 
    <!-- sidebar: style can be found in sidebar.less -->
    <?php include('includes/sidebar.php') ?>
    <!-- /.sidebar --> 
  </aside>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <div class="content-header sty-one">
       <h1><i class="fa fa-users"></i> Users Management</h1>
      <ol class="breadcrumb">
        <li><a href="#">Users</a></li>
        <li><i class="fa fa-angle-right"></i> All Users</li>
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
               <th>Email</th>
               <th>Full Name</th>
               <th>Join Date</th>
               <th>Status</th>
               <th>Action</th>
             </tr>
           </thead>
           <tbody>
            <?php

// Attempt select query execution
            $sql = "SELECT * FROM employer";
            if($result = mysqli_query($conn, $sql)){
              if(mysqli_num_rows($result) > 0){

                while($row = mysqli_fetch_array($result)){

                  echo "<tr>";
                  echo "<td>" . $row['id'] . "</td>";
                  echo "<td>" . $row['emailAddress'] . "</td>";
                  echo "<td>" . $row['fullName'] . "</td>";
                  echo "<td>" . $row['joinDate'] . "</td>";
                  if($row['acStatus']==0)
                    echo '<td><span class="label label-success">Active</span></td>'; 
                  else if($row['acStatus']==1)
                    echo '<td><span class="label label-danger">Inactive</span></td>';
                  
                  
                 
                  
                    echo '<td>
                  <a href="view-user.php?id=' . $row['id'] . '">
                  <i class="fa fa-eye text-info " style="font-size:20px"></i>
                  </a>
                  <a href="edit-user.php?id=' . $row['id'] . '">
                  <i class="fa fa-edit " style="font-size:20px"></i>
                  </a>

                  <i class="fa fa-trash text-danger delete_user" id=' . $row['id'] . ' style="font-size:20px"></i>

                  </td>';
                
                  
                 



        //echo "<td>" . $row['due'] . "</td>";









                  echo "</tr>";

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
<?php include('includes/footer.php') ?>
</div>
<!-- ./wrapper --> 
<?php include('includes/js.php') ?>
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

  var userType =  '<?php echo $_SESSION['role'];?>';
  $(document).on('click', '.delete_user', function(){  
      if(userType == 'admin'){
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
            url:"action/deleteuser.php",
            method:"POST",
            data:{id:id},
            success:function(data){
              swal("Shifted Successfully!!!!", {
                icon: "success",
              }); 
              $(location.reload()); 
            }
          })
        } else {
          return false;
        }
      });
    }else{
      swal("Not Permitted!")
    }
    });  
</script>
<!-- jQuery 3 --> 

</body>
</html>
