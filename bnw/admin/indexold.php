<?php
session_start();
include('db/conn.php');
include('includes/calculate.php');
include('includes/functions.php');
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
  <title>Dashboard | <?php echo $siteName; ?></title>
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
      <h1>Dashboard</h1>
      <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><i class="fa fa-angle-right"></i> Dashboard</li>
      </ol>
    </div>
    
    <!-- Main content -->
    <div class="content"> 
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <div class="info-box"> <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
            <div class="info-box-content"> <span class="info-box-number"><?php echo $countusers[0]; ?></span> <span class="info-box-text">Total Users</span> </div>
            <!-- /.info-box-content --> 
          </div>
          <!-- /.info-box --> 
        </div>
        <!-- /.col -->
        <div class="col-lg-3 col-xs-6">
          <div class="info-box"> <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>
            <div class="info-box-content"> <span class="info-box-number"><?php echo countStatusWiseUsers("Active",$conn) ?></span> <span class="info-box-text">Active Users</span></div>
            <!-- /.info-box-content --> 
          </div>
          <!-- /.info-box --> 
        </div>
        <!-- /.col -->
        <div class="col-lg-3 col-xs-6">
          <div class="info-box"> <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>
            <div class="info-box-content"> <span class="info-box-number"><?php echo countStatusWiseUsers("Expired",$conn) ?></span> <span class="info-box-text">Expired Users</span></div>
            <!-- /.info-box-content --> 
          </div>
          <!-- /.info-box --> 
        </div>
        <!-- /.col -->
        <div class="col-lg-3 col-xs-6">
          <div class="info-box"> <span class="info-box-icon bg-red"><i class="fa fa-money"></i></span>
            <div class="info-box-content"> <span class="info-box-number">$<?php echo $totalBill ?></span> <span class="info-box-text">Total Monthly Bill</span></div>
            <!-- /.info-box-content --> 
          </div>
          <!-- /.info-box --> 
        </div>
        <!-- /.col --> 
      </div>
      <!-- /.row --> 
      <!-- Main row -->
      <div class="row">
        <div class="col-lg-7 col-xlg-9">
          <div class="info-box">
            <div class="d-flex flex-wrap">
              <div>
                <h4 class="text-black">New Users vs Left Users</h4>
              </div>
              <div class="ml-auto">
                <ul class="list-inline">
                  <li class="text-info"> <i class="fa fa-circle"></i> New</li> <li class="text-blue"> <i class="fa fa-circle"></i> Left</li>
                </ul>
              </div>
            </div>
            <div>
              <canvas id="new_left_chart"></canvas>
            </div>
          </div>
        </div>
        <div class="col-lg-5 col-xlg-3">
          <div class="info-box">
            <div class="d-flex flex-wrap">
              <div>
                <h4 class="text-black">Monthly Collected Bill</h4>
              </div>
            </div>
            <div class="m-t-2">
              <canvas id="layanan_subbagian" height="280"></canvas>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="info-box">
            <h4 class="m-b-2 text-black">Recent Tickets</h4>
            <?php
            $i=1;
            $sql = "SELECT * FROM tickets  ORDER BY id DESC LIMIT 4";
            if($result = mysqli_query($conn, $sql)){
              if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                  if($row['status']=='Active'){
                    echo '<div class="sl-item sl-primary">
                    <div class="sl-content"><small class="text-muted"><i class="fa fa-user position-left"></i> '.$row['create_time'].'</small>
                    <p>['.$row['user_id'].'] ['.$row['username'].']<br>['.$row['ticket_details'].']<br>[Assigned Person: '.$row['ass_person'].']</p>
                    </div>
                    </div>';
                  }else{
                    echo '<div class="sl-item sl-success">
                    <div class="sl-content"><small class="text-muted"><i class="fa fa-user position-left"></i> '.$row['create_time'].'</small>
                    <p>['.$row['user_id'].'] ['.$row['username'].']<br>['.$row['ticket_details'].']<br>[Assigned Person: '.$row['ass_person'].']</p>
                    </div>
                    </div>';
                  }


                  $i++;
                }
              }
            }
            ?>
            
          </div>
        </div>
        <div class="col-lg-4">
          <div class="info-box">
            <h4 class="m-b-2 text-black">Recent Tasks</h4>
            
            <?php
            $i=1;
            $sql = "SELECT * FROM tasks  ORDER BY id DESC LIMIT 4";
            if($result = mysqli_query($conn, $sql)){
              if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                  if($row['status']=='Active'){
                    echo '<div class="sl-item sl-primary">
                    <div class="sl-content"><small class="text-muted"><i class="fa fa-user position-left"></i> '.$row['create_time'].'</small>
                    <p>['.$row['assigned_person'].']<br>['.$row['description'].']</p>
                    </div>
                    </div>';
                  }else{
                   echo '<div class="sl-item sl-primary">
                   <div class="sl-content"><small class="text-muted"><i class="fa fa-user position-left"></i> '.$row['create_time'].'</small>
                   <p>['.$row['assigned_person'].']<br>['.$row['description'].']</p>
                   </div>
                   </div>';
                 }


                 $i++;
               }
             }
           }
           ?>
         </div>
       </div>
       <div class="col-lg-4 m-b-3">
        <div class="box box-info">
          <div class="box-header with-border p-t-1">
            <h4 class="box-title text-black">Stocks</h4>
            <!--  <div class="pull-right"> <a href="#">Invoice Summary <i class="fa fa-long-arrow-right"></i></a> </div> -->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table class="table no-margin">
                <thead>
                </thead>
                <tbody>
                  <tr>
                    <td><a href="#">SMS Balance</a></td>
                    <td> <?php echo getSmsBalance();?> Tk </td>
                  </tr>
                  <tr>
                    <td><a href="#">Fiber Cable</a></td>
                    <td> 0 Miter </td>
                  </tr>
                  <tr>
                    <td><a href="#">ONT / ONU</a></td>
                    <td> 0 Pcs </td>
                  </tr>

                </tbody>
              </table>
            </div>
            <!-- /.table-responsive --> 
          </div>
          <!-- /.box-body -->
          <div class="box-footer clearfix"> <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left"> <i class="fa fa-eye"> </i> View Other Stocks</a>  </div>
          <!-- /.box-footer --> 
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4">
        <div class="small-box bg-aqua">
          <div class="inner">
            <div class="text-left">
              <h2>Monthly Bill</h2>
              <h6><?php echo date("F-Y") ?></h6>
            </div>
            <div class="text-right m-t-2">
              <h1><sup>
                <?php
                $rate3 = 5;
                if($rate3 > monthlyBillRate($conn)){
                  echo '<i class="ti-arrow-up"></i>';

                }else{
                  echo '<i class="ti-arrow-down"></i>';
                 
                }
                ?>

              </sup> <?php echo countMonthlyBill(date('F-Y'),$conn); ?></h1>
            </div>
            <div class="m-b-2"><span class="text-white"><?php echo $rate3 ?>%</span>
              <div class="progress bg-lightblue">
                <div class="progress-bar bg-white" role="progressbar" style="width: <?php echo $rate3 ?>%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="small-box bg-darkblue text-white">
          <div class="inner">
            <div class="text-left">
              <h2>Monthly Expence</h2>
              <h6><?php echo date("F-Y") ?></h6>
            </div>
            <div class="text-right m-t-2">
              <h1><sup><i class="ti-arrow-up"></i></sup> $2500</h1>
            </div>
            <div class="m-b-2"><span class="text-white">55%</span>
              <div class="progress bg-lightblue">
                <div class="progress-bar bg-white" role="progressbar" style="width: 55%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="small-box bg-orange">
          <div class="inner">
            <div class="text-left">
              <h2>Total Profit</h2>
              <h6><?php echo date("F-Y") ?></h6>
            </div>
            <div class="text-right m-t-2">
              <h1><sup><i class="ti-arrow-up"></i></sup> <?php echo projectedProfit($conn);?></h1>
            </div>
            <div class="m-b-2"><span class="text-white">75%</span>
              <div class="progress bg-lightblue">
                <div class="progress-bar bg-white" role="progressbar" style="width: 75%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-8 m-b-3">
        <div class="box box-info">
          <div class="box-header with-border p-t-1">
            <h3 class="box-title text-black">New Connections of <?php echo date("F-Y") ?></h3>
            <!-- <div class="pull-right"> <a href="#">Invoice Summary <i class="fa fa-long-arrow-right"></i></a> </div> -->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table class="table no-margin">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>User ID</th>
                    <th>Customer Name</th>
                    <th>Monthly Bill</th>
                    <th>Activation Date</th>
                    <th>Ref</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i=1;         
                  $fromDate = date("Y-m") ;
                  $toDate = date("Y-m");
                  $sql = "SELECT * FROM users WHERE activation_date BETWEEN '$fromDate-01' AND '$toDate-30' ORDER BY activation_date DESC LIMIT 6";
                  if($result3 = mysqli_query($conn, $sql)){
                    if(mysqli_num_rows($result3) > 0){


                      while($row = mysqli_fetch_array($result3)){

                        echo "<tr>";
                        echo "<td>" . $i . "</td>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['cus_name'] . "</td>";
                        echo "<td>" . $row['monthly_bill'] . "</td>";
                        echo "<td>" . $row['activation_date'] . "</td>";
                        echo "<td>" . $row['reference'] . "</td>";

                        echo "</tr>";
                        $i++;

                      }

                    } 
                  } 



                  ?>
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive --> 
          </div>
          <!-- /.box-body -->
          <div class="box-footer clearfix"> <a href="<?php echo $url;?>/mod/users/new-users.php" class="btn btn-sm btn-info btn-flat pull-left"><i class="fa fa-eye"></i> View All New Users</a> </div>
          <!-- /.box-footer --> 
        </div>
      </div>
      <div class="col-lg-4 m-b-3">
        <div> 
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2"> 
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow">
              <h5><i class="fa fa-users"></i> Expired Users [To be Expired]</h5>

            </div>
            <ul class="products-list product-list-in-box">

             <?php
             $sql7 = "SELECT * FROM users where status='Expired' LIMIT  4";
             if($result7 = mysqli_query($conn, $sql7)){
              if(mysqli_num_rows($result7) > 0){
                while($row = mysqli_fetch_array($result7)){
                  echo '<li class="item">
                  <a href="#" class="product-title">'.$row['username'].' [EXP Date: '.$row['expireDate'].']</a> <span class="product-description"> <a href="#">'.$row['cus_name'].'</a> </span> 
                  </li>';
                }
              }
            } 
            ?>
            <!-- /.item -->
          </ul>
          <div class="box-footer clearfix"> <a href="<?php echo $url;?>/mod/users/expired-users.php" class="btn btn-sm btn-info btn-flat pull-left"><i class="fa fa-eye"></i> View All Expired Users</a> </div>
        </div>
        <!-- /.widget-user --> 
      </div>
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

<script type="text/javascript">
  var ctx_2 = document.getElementById("layanan_subbagian").getContext('2d');
  var data_2 = {
    datasets: [{
      data: [ <?php echo $sum_col_monthly_bill;?>, <?php echo $rem_monthly_bill;?>],
      backgroundColor: [
      '#009900',
      '#ff4d4d',

      ],
    }],
    labels: [
    'Collected Bill',
    'Remaining Bill',

    ]
  };
  var myDoughnutChart_2 = new Chart(ctx_2, {
    type: 'doughnut',
    data: data_2,
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
  var ctx = document.getElementById('new_left_chart').getContext('2d');
  var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
      labels: [<?php
        for($j=11; $j>=0; $j--){
          echo "'".date('F-Y', strtotime("-$j Months"))."'";
          echo ",";
        }
        ?>],
        datasets: [{
         label: "New Users",
            //backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(0, 153, 51)',
            data: [<?php 
              for($j=11; $j>=0; $j--){
                $fromDate = date('Y-m', strtotime("-$j Months"));

                echo countNewUsers($fromDate,$conn);
                echo ",";
              }
              ?>],
              fill: false,
            }, {
              label: "Left Users",
            //backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 51, 0)',
            data: [<?php 
              for($j=11; $j>=0; $j--){
                $fromDate = date('Y-m', strtotime("-$j Months"));

                echo countLeftUsers($fromDate,$conn);
                echo ",";
              }
              ?>],
            }]
          },
          options: {
            responsive: true
          }
        });
      </script>
      <!-- jQuery 3 --> 

    </body>
    </html>
