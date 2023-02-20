<?php
session_start();
include('../../db/conn.php');
include('../../includes/functions.php');

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login");
  exit;
}
$id=$_GET['id'];
$query=mysqli_query($conn,"select * from `employee` where id='$id'");
$result=mysqli_fetch_array($query);
$username=$result['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>View Employee | <?php echo $siteName; ?></title>
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
  <style type="text/css">
        .image2 {
          height: 100px;
          overflow: hidden;
          position: relative;
          width: 100px;
        }



        .label2 {
          background: rgba(0, 0, 0, 0.5) none repeat scroll 0 0;
          bottom: -20px;
          color: #fff;
          left: 0;
          margin: 0;
          position: absolute;
          right: 0;
          text-align: center;
          transition:0.1s all;
        }

        .image2:hover .label2 {
          bottom: 0px;
        }
      </style>
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
      <h1>View Employee Information</h1>
      <ol class="breadcrumb">
        <li><a href="#">HRM</a></li>
        <li><i class="fa fa-angle-right"></i> Employee</li>
      </ol>
    </div>
    <div class="content"> 
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3"> 

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-profile"> <img class="profile-user-img img-responsive img-circle" src="<?php echo $url;?>/<?php echo $result['img_link'];?>" alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo $result['fullName']; ?></h3>
              <p class="text-muted text-center"><?php echo $result['role']; ?></p>
              <ul class="nav nav-stacked sty1">
                <li><a href="#">Mobile No: <span class="pull-right"><?php echo $result['mobile']; ?></span></a></li>
                <li><a href="#">Email: <span class="pull-right"><?php echo $result['email']; ?></span></a></li>
                <!-- <li><a href="#">Role <span class="pull-right"><?php echo $result['role']; ?></span></a></li> -->
                <li><a href="#">Salary: <span class="pull-right"><?php echo $result['salary']; ?></span></a></li>
                <li><a href="#">Account: <span class="pull-right"><?php echo $result['account']; ?></span></a></li>
              </ul>
              <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-add-ticket"><i class="fa fa-edit"></i> Change Profile Picture</a> </div>
              <!-- /.box-body --> 
            </div>
            <!-- /.box --> 
          </div>
          <!-- /.col -->
          <div class="col-lg-9">
            <div class="info-box">
              <div class="box-body">
                <div class="right-page-header">
                <!-- <div class="d-flex">
                  <div class="align-self-center">
                    <h4 class="text-black m-b-1">Contacts / Employee List </h4>
                  </div>
                </div> -->
              </div>

              <!-- <h4 class="card-title text-black">Default Tab</h4>
                <h6 class="card-subtitle m-b-2">Use default tab with class <code>nav-tabs & tabcontent-border </code></h6> -->
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Sale Per Month</span></a> </li>
                  <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Ticket Solved</span></a> </li>
                  <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Tasks Completed</span></a> </li>
                  <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#convence" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Convence Per Month</span></a> </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content tabcontent-border">
                  <div class="tab-pane active" id="home" role="tabpanel">
                    <div class="pad-20">
                      <div style="height:320px;">
                        <canvas id="layanan_subbagian10"></canvas>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane  p-20" id="profile" role="tabpanel">
                    <div class="pad-20">
                      <div style="height:320px;">
                        <canvas id="ticketpermonth"></canvas>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane p-20" id="messages" role="tabpanel">
                    <div class="pad-20">
                      <div style="height:240px;">
                        <canvas id="tasksperperson"></canvas>
                      </div>
                    </div>
                  </div>
                   <div class="tab-pane p-20" id="convence" role="tabpanel">
                    <div class="pad-20">
                      <div style="height:240px;">
                        <canvas id="convenceperperson"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>
         <div class="card">
        <div class="card-body">
          <center>
          <button class="btn btn-info " data-toggle="modal" data-target="#modal-lg" ><i class="fa fa-eye"></i> View Salary Report</button>
          <button class="btn btn-success " data-toggle="modal" data-target="#modal-lg2"><i class="fa fa-eye"></i> View Attendance Report</button>
          <button class="btn btn-danger" data-toggle="modal" data-target="#modal-send-sms" ><i class="fa fa-envelope-o"></i> Send SMS</button>
         
        </center>
        </div>
      </div>

        <!-- /.col --> 
      </div>

      <!-- Main row --> 
    </div>

    <!-- /.content-wrapper -->
    <?php include('../../includes/footer.php') ?>
  </div>
  <!-- ./wrapper --> 
  <?php include('../../includes/js.php') ?>
  <script>
    $(function () {


     var ctx_5 = document.getElementById("layanan_subbagian10").getContext('2d');
     var data_5 = {
      datasets: [{
        data: [
        <?php 
        for($j=11; $j>=0; $j--){
          $month_select = date('Y-m', strtotime("-$j Months"));
          echo sumSalePerMonth($month_select,$username,$conn);
          echo ",";
        }
        ?>
        
        
        ],
        backgroundColor: [
        <?php 
        for($i=1; $i<=12; $i++){
          echo "'#3c8dbc'";
          echo ",";
        }
        ?>
        ],
      }],
      labels: [
      <?php
      for($j=11; $j>=0; $j--){
        echo "'".date('F-Y', strtotime("-$j Months"))."'";
        echo ",";
      }
      ?>

      ]
    };
    var myDoughnutChart_5 = new Chart(ctx_5, {
      type: 'bar',
      data: data_5,
      options: {
        maintainAspectRatio: false,
        legend: {
          position: 'bottom',
          labels: {
            boxWidth: 12
          }
        }
      }
    });

    var ctx_6 = document.getElementById("ticketpermonth").getContext('2d');
    var data_6 = {
      datasets: [{
        data: [
        <?php 
        for($j=11; $j>=0; $j--){
          $month_select2 = date('Y-m', strtotime("-$j Months"));
          echo countSolvedTicket($month_select2,$username,$conn);
          echo ",";
        }
        ?>
        
        
        ],
        backgroundColor: [
        <?php 
        for($i=1; $i<=12; $i++){
          echo "'#3c8dbc'";
          echo ",";
        }
        ?>
        ],
      }],
      labels: [
      <?php
      for($j=11; $j>=0; $j--){
        echo "'".date('F-Y', strtotime("-$j Months"))."'";
        echo ",";
      }
      ?>

      ]
    };
    var myDoughnutChart_6 = new Chart(ctx_6, {
      type: 'bar',
      data: data_6,
      options: {
        maintainAspectRatio: false,
        legend: {
          position: 'bottom',
          labels: {
            boxWidth: 12
          }
        }
      }
    });

    var ctx_7 = document.getElementById("tasksperperson").getContext('2d');
    var data_7 = {
      datasets: [{
        data: [
        <?php 
        for($j=11; $j>=0; $j--){
          $month_select3 = date('Y-m', strtotime("-$j Months"));
          echo countTasks($month_select3,$username,$conn);
          echo ",";
        }
        ?>
        
        
        ],
        backgroundColor: [
        <?php 
        for($i=1; $i<=12; $i++){
          echo "'#3c8dbc'";
          echo ",";
        }
        ?>
        ],
      }],
      labels: [
      <?php
      for($j=11; $j>=0; $j--){
        echo "'".date('F-Y', strtotime("-$j Months"))."'";
        echo ",";
      }
      ?>

      ]
    };
    var myDoughnutChart_7 = new Chart(ctx_7, {
      type: 'bar',
      data: data_7,
      options: {
        maintainAspectRatio: false,
        legend: {
          position: 'bottom',
          labels: {
            boxWidth: 12
          }
        }
      }
    });

    var ctx_8 = document.getElementById("convenceperperson").getContext('2d');
    var data_8 = {
      datasets: [{
        data: [
        <?php 
        for($j=11; $j>=0; $j--){
          $month_select5 = date('F-Y', strtotime("-$j Months"));
          echo sumConvencePerMonth($month_select5,$username,$conn);
          echo ",";
        }
        ?>
        
        
        ],
        backgroundColor: [
        <?php 
        for($i=1; $i<=12; $i++){
          echo "'#3c8dbc'";
          echo ",";
        }
        ?>
        ],
      }],
      labels: [
      <?php
      for($j=11; $j>=0; $j--){
        echo "'".date('F-Y', strtotime("-$j Months"))."'";
        echo ",";
      }
      ?>

      ]
    };
    var myDoughnutChart_8 = new Chart(ctx_8, {
      type: 'bar',
      data: data_8,
      options: {
        maintainAspectRatio: false,
        legend: {
          position: 'bottom',
          labels: {
            boxWidth: 12
          }
        }
      }
    });
    
  });













</script>


<div class="modal fade" id="modal-send-sms">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Send SMS</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" method="POST" action="action/single-sms.php">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <input type="hidden" name="mobile" value="<?php echo $result['mobile']; ?>">
                <div class="form-group">
                  <label for="exampleInputEmail1">Text / Messege Body</label>
                  <textarea type="text" class="form-control" name="smsbody"></textarea>
                </div>
              </div>
            </div>
            <!-- /.row -->
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" name="add" class="btn btn-primary"><i class="fa fa-paper-plane"></i>Send</button>
        </div>
      </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
</div>




<div class="modal fade" id="modal-add-ticket">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-body">


        <div class="card">
          <div class="card-header">
            <h5>File Upload</h5>
          </div>
          <div class="card-block">
            <form id="uploadForm" action="upload.php" method="post">
              <div class="fallback">
                <input name="userImage" type="file" />
              </div>
              <input type="hidden" name="id" value="<?php echo $id ?>">
              <div class="text-center m-t-20">
                <button type="submit" value="Submit" class="btn btn-primary">Upload Now</button>
              </div>
            </div>
          </div>


        </form>
      </div>
      <!-- /.row -->
    </div>

    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>

<script type="text/javascript">
  $(document).ready(function (e) {
    $("#uploadForm").on('submit',(function(e) {
      e.preventDefault();
      $.ajax({
        url: "upload.php",
        type: "POST",
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        success: function(data)
        {
      //$("#targetLayer").html(data);
      //alert('Image uploaded successfully!');
      $('#modal-add-ticket').modal('hide');
      $(location.reload());  
    },
    error: function() 
    {
    }           
  });
    }));
  });
</script>

<!-- MODAL TO VIEW SALARY HISTORY -->
<div class="modal fade" id="modal-lg">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Salary History</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table id="example1" class="table table-bordered table-striped">
         <thead class="text-black bg-info">
          <tr>
            <th>No</th>
            <th>Employee Name</th>
            <th>Month</th>
            <th>Amount</th>
            <th>Date</th>

          </tr>
        </thead>
        <tbody>
          <?php
          $j=1;
          $username=$result['username'];
          $sql = "SELECT * FROM salary WHERE emp_id='$username'";
          if($result = mysqli_query($conn, $sql)){
            if(mysqli_num_rows($result) > 0){

              while($row = mysqli_fetch_array($result)){

                echo "<tr>";
                echo "<td>" . $j . "</td>";
                echo "<td>" . $row['emp_name'] . "</td>";
                echo "<td>" . $row['month'] . "</td>";
                echo "<td>" . $row['paid'] . "</td>";
                echo "<td>" . $row['date'] . "</td>";

                echo "</tr>";
                $j++;

              }


        // Free result set
              mysqli_free_result($result);
            } else{
              echo "No records matching your query were found.";
            }
          } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
          }


// Close connection
//mysqli_close($conn);



          ?>
        </tbody>
      </table>
    </div>
    <div class="modal-footer justify-content-between">
      <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

    </div>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>




<div class="modal fade" id="modal-lg2">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Attandance History</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead class="text-black bg-info">
            <tr>
              <th>No</th>
              <th>Date</th>
              <th>Status</th>


            </tr>
          </thead>
          <tbody>
            <?php

            $sql2 = "SELECT * FROM attendance WHERE username = '$username'";
            if($result = mysqli_query($conn, $sql2)){
              if(mysqli_num_rows($result) > 0){

                while($row = mysqli_fetch_array($result)){

                  echo "<tr>";
                  echo "<td>" . $row['id'] . "</td>";
                  echo "<td>" . $row['attendance_date'] . "</td>";
                  echo "<td>" . $row['attendance_status'] . "</td>";


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


// Close connection
//mysqli_close($conn);



            ?>
          </tbody>
        </table>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>





</div>
</div>
</body>
</html>
