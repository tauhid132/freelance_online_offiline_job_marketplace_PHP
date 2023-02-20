<?php
session_start();
include ('../database/dbconnect.php');
// include('includes/calculate.php');
// include('includes/functions.php');
$username = $_SESSION['username'];
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
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
      <h1 class="text-blue"><i class="fa fa-dashboard"></i> My Dashboard</h1>
      <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><i class="fa fa-angle-right"></i> My Dashboard</li>
      </ol>
    </div>
    
    <!-- Main content -->
    <div class="content"> 
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <div class="info-box"> <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
            <div class="info-box-content"> <span class="info-box-number">0></span> <span class="info-box-text">Total Users</span> </div>
            <!-- /.info-box-content --> 
          </div>
          <!-- /.info-box --> 
        </div>
        <!-- /.col -->
        <div class="col-lg-3 col-xs-6">
          <div class="info-box"> <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>
            <div class="info-box-content"> <span class="info-box-number">0</span> <span class="info-box-text">Active Users</span></div>
            <!-- /.info-box-content --> 
          </div>
          <!-- /.info-box --> 
        </div>
        <!-- /.col -->
        <div class="col-lg-3 col-xs-6">
          <div class="info-box"> <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>
            <div class="info-box-content"> <span class="info-box-number">0</span> <span class="info-box-text">Expired Users</span></div>
            <!-- /.info-box-content --> 
          </div>
          <!-- /.info-box --> 
        </div>
        <!-- /.col -->
        <div class="col-lg-3 col-xs-6">
          <div class="info-box"> <span class="info-box-icon bg-red"><i class="fa fa-money"></i></span>
            <div class="info-box-content"> <span class="info-box-number">0</span> <span class="info-box-text">Total Monthly Bill</span></div>
            <!-- /.info-box-content --> 
          </div>
          <!-- /.info-box --> 
        </div>
        <!-- /.col --> 
      </div>
      <!-- /.row --> 
      <!-- Main row -->
      <div class="row">
        <div class="col-12">
          <div class="info-box">
            <div class="row">
              <div class="col-lg-3 col-sm-6 col-xs-12">
                <div> <i class="fa fa-user-plus f-20 text-blue"></i>
                  <div class="info-box-content">
                    <h1 class="f-25 text-black">0</h1>
                    <span class="progress-description">New Users</span> </div>
                    <div class="progress">
                      <div class="progress-bar bg-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:100%; height:6px;"> <span class="sr-only">40% Complete</span> </div>
                    </div>
                  </div>
                  <!-- /.info-box --> 
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-12">
                  <div> <i class="fa fa-user-times f-20 text-danger"></i>
                    <div class="info-box-content">
                      <h1 class="f-25 text-black">0</h1>
                      <span class="progress-description">Left Users</span> </div>
                      <div class="progress">
                        <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:100%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
                      </div>
                    </div>
                    <!-- /.info-box --> 
                  </div>
                  <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div> <i class="fa fa-users f-20 text-info"></i>
                      <div class="info-box-content">
                        <h1 class="f-25 text-black">0</h1>
                        <span class="progress-description">Total Employee</span> </div>
                        <div class="progress">
                          <div class="progress-bar bg-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:100%; height:6px;"> <span class="sr-only">65% Complete</span> </div>
                        </div>
                      </div>
                      <!-- /.info-box --> 
                    </div>
                    <div class="col-lg-3 col-sm-6 col-xs-12">
                      <div> <i class="ti-wallet f-20 text-green"></i>
                        <div class="info-box-content">
                          <h1 class="f-25 text-black">0</h1>
                          <span class="progress-description">Total Salary</span> </div>
                          <div class="progress">
                            <div class="progress-bar bg-green" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:100%; height:6px;"> <span class="sr-only">85% Complete</span> </div>
                          </div>
                        </div>
                        <!-- /.info-box --> 
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
        <!-- <div class="col-lg-7 col-xlg-9">
          <div class="info-box">
            <div class="d-flex flex-wrap">
              <div>
                <h4 class="text-black">Monthly Growth</h4>
              </div>
              <div class="ml-auto">
                <ul class="list-inline">
                  <li class="text-success"> <i class="fa fa-circle"></i> Monthly Bill</li> <li class="text-danger"> <i class="fa fa-circle"></i> Monthly Expense</li>
                </ul>
              </div>
            </div>
            <div>
              <canvas id="new_left_chart"></canvas>
            </div>
          </div>
        </div> -->
      <!--   <div class="col-lg-5 col-xlg-3">
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
        </div> -->
        <div class="col-lg-8">
          <div class="info-box" >
           <div id="tododiv2">
             <div class="box-header bg-blue ">
              <h5 class="text-white"><i class="fa fa-calendar"></i>  Service Areas</h5>

            </div>
            <div class="card-body" style="height:300px; overflow-y: scroll;">
             <ul class="list-group">
              <?php  
              $sql = "SELECT * FROM operation_area";
              if($result = mysqli_query($conn,$sql)){
                if(mysqli_num_rows($result)>0){
                  while($row = mysqli_fetch_array($result)){
                    echo ' <li class="list-group-item  justify-content-between "> '.$row['policeStation'].','.$row['city'].' <span class="float-right"><i class="fa fa-edit text-green edit_service_area" id="'. $row["id"].'"></i><i class="fa fa-trash ml-1 text-red delete_service_area" id="'. $row["id"].'"></i></span> </li>';
                  }
                }
              }
              ?>

            </ul>
          </div>
          <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#service-area-modal"><i class="fa fa-plus"></i> Add New Category</button>
        </div>

      </div>
    </div>


    <div class="col-lg-4">
      <div class="info-box" >
       <div id="tododiv">
         <div class="box-header bg-blue ">
          <h5 class="text-white"><i class="fa fa-calendar"></i>  Service Category</h5>

        </div>
        <div class="card-body" style="height:300px; overflow-y: scroll;">
         <ul class="list-group">
          <?php  
          $sql = "SELECT * FROM service_categories";
          if($result = mysqli_query($conn,$sql)){
            if(mysqli_num_rows($result)>0){
              while($row = mysqli_fetch_array($result)){
                echo ' <li class="list-group-item  justify-content-between "> '.$row['catName'].' <span class="float-right"><i class="fa fa-edit text-green edit_service_cat" id="'. $row["id"].'"></i><i class="fa fa-trash ml-1 text-red delete_service_cat" id="'. $row["id"].'"></i></span> </li>';
              }
            }
          }
          ?>

        </ul>
      </div>
      <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#add_data_Modal3"><i class="fa fa-plus"></i> Add New Category</button>
    </div>

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

<div id="add_data_Modal3" class="modal fade">  
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><b>Add / Update Category</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="post" id="category_form" enctype='multipart/form-data'>  
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <input type="hidden" name="id" id="id" class="form-control"  />  
                <div class="form-group">
                  <label for="exampleInputEmail1">Category Name</label>
                  <input type="text" class="form-control" name="catName" id="catName">
                </div>

              </div>
              <div class="col-md-6">
               <div class="form-group">
                <label for="exampleInputEmail1">Description</label>
                <input name="userImage" type="file" />
              </div>

            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
           <input type="submit" name="insert2" id="insert2" value="Insert" class="btn btn-success" /> 
         </div>
       </form>
     </div>
     <!-- /.row -->
   </div>

   <!-- /.card -->
 </div>
 <!-- /.col -->
</div>

</div>

<div id="service-area-modal" class="modal fade">  
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><b>Add / Update Service Area</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="post" id="area_form">  
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <input type="hidden" name="id" id="id2" class="form-control"  />  
                <div class="form-group">
                  <label for="exampleInputEmail1">Area / Thana</label>
                  <input type="text" class="form-control" name="policeStation" id="policeStation">
                </div>

              </div>
              <div class="col-md-6">
               <div class="form-group">
                <label for="exampleInputEmail1">City</label>
                <input type="text" class="form-control" name="city" id="city">
              </div>

            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
           <input type="submit" name="insert2" id="insert2" value="Insert" class="btn btn-success" /> 
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
  $(document).on('click', '.edit_service_cat', function(){ 
    var id = $(this).attr("id");  
    $.ajax({  
      url:"fetch/fetch-service-cat.php",  
      method:"POST",  
      data:{id:id},  
      dataType:"json",  
      success:function(data){  
        $('#catName').val(data.catName); 
        $('#description').val(data.description); 
        $('#imageLink').val(data.imageLink); 
        $('#id').val(data.id); 
        $('#insert2').val("Add Plans");  
        $('#add_data_Modal3').modal('show');  
      }  
    });      
  });  

  $('#category_form').on("submit", function(event){  
   event.preventDefault();  
   $.ajax({  
     url:"action/update-service-cat.php",  
     type: "POST",
     data:  new FormData(this),
     contentType: false,
     cache: false,
     processData:false, 
     beforeSend:function(){  
      $('#insert').val("Updating");  
    },  
    success:function(data){  
      $('#category_form')[0].reset();  
      $('#add_data_Modal3').modal('hide');  
      $("#tododiv").load(location.href + " #tododiv"); 
    }  
  });  
 }); 

  $(document).on('click', '.delete_service_cat', function(){  
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
          url:"action/delete-service-cat.php",
          method:"POST",
          data:{id:id},
          success:function(data){
            swal("Deleted Successfully!!!!", {
              icon: "success",
            }); 
            $("#tododiv").load(location.href + " #tododiv");  
          }
        })
      } else {
        return false;
      }
    });
  });  



  $(document).on('click', '.edit_service_area', function(){ 
    var id = $(this).attr("id");  
    $.ajax({  
      url:"fetch/fetch-service-area.php",  
      method:"POST",  
      data:{id:id},  
      dataType:"json",  
      success:function(data){  
        $('#policeStation').val(data.policeStation); 
        $('#city').val(data.city); 
        $('#id2').val(data.id); 
        $('#insert2').val("Add Plans");  
        $('#service-area-modal').modal('show');  
      }  
    });      
  });  

  $('#area_form').on("submit", function(event){  
   event.preventDefault();  
   $.ajax({  
     url:"action/update-service-area.php",  
     method:"POST",  
     data:$('#area_form').serialize(),  
     beforeSend:function(){  
      $('#insert').val("Updating");  
    },  
    success:function(data){  
      $('#area_form')[0].reset();  
      $('#service-area-modal').modal('hide');  
      $("#tododiv2").load(location.href + " #tododiv2"); 
    }  
  });  
 }); 

  $(document).on('click', '.delete_service_area', function(){  
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
          url:"action/delete-service-area.php",
          method:"POST",
          data:{id:id},
          success:function(data){
            swal("Deleted Successfully!!!!", {
              icon: "success",
            }); 
            $("#tododiv2").load(location.href + " #tododiv2");  
          }
        })
      } else {
        return false;
      }
    });
  });  
</script>




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
         label: "Monthly Bill",
            //backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(0, 153, 51)',
            data: [<?php 
              for($j=11; $j>=0; $j--){
                $month_chart = date('F-Y', strtotime("-$j Months"));
          //$toDate = date('Y-m', strtotime("-$j Months"));
                echo sumCollectedBill($month_chart,$conn);
                echo ",";
              }
              ?>],
              fill: false,
            }, {
              label: "Monthly Expense",
            //backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 51, 0)',
            data: [<?php 
              for($j=11; $j>=0; $j--){
                $month_chart = date('F-Y', strtotime("-$j Months"));
          //$toDate = date('Y-m', strtotime("-$j Months"));
                echo sumTotalExp($month_chart,$conn);
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
    </body>
    </html>
    <script type="text/javascript">
      $(document).on('click', '.newToDo', function(){  
        var createdBy = '<?php echo $_SESSION['username']; ?>'; 
        swal("TO-DO Name", {
          content: "input",
        })
        .then((value) => {
        //swal(`You typed: ${value}`);
        var todoName = value;
        if(todoName == "" || todoName==null){
          swal("Invalid TODO!", {
            icon: "warning",
          });
        }else{
          $.ajax({
            url:"tools/create-todo.php",
            method:"POST",
            data:{createdBy:createdBy,todoName:todoName},
            success:function(data){

              $("#tododiv").load(location.href + " #tododiv"); 
            }
          });
        } 
      });


      });
      $(document).on('click', '.delete_todo', function(){  
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
              url:"tools/delete-todo.php",
              method:"POST",
              data:{id:id},
              success:function(data){
                $("#tododiv").load(location.href + " #tododiv"); 
              }
            })
          } else {
            return false;
          }
        });
      });    
      $(document).on('click', '.close_todo', function(){  
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
              url:"tools/close-todo.php",
              method:"POST",
              data:{id:id},
              success:function(data){

                $("#tododiv").load(location.href + " #tododiv"); 
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

       $('#api_setting').change(function(){
        swal({
          title: "Are you sure?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax({
              url:"action/change-api-setting.php",
              method:"POST",
              success:function(data){
                swal(data, {
                  icon: "success",
                }); 
            //$("#service_area_div").load(location.href + " #service_area_div");  
          }
        })
          } else {
            return false;
          }
        });

      }); 

       $('#auto_user').change(function(){
        swal({
          title: "Are you sure?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax({
              url:"action/change-autouser-setting.php",
              method:"POST",
              success:function(data){
                swal(data, {
                  icon: "success",
                }); 
            //$("#service_area_div").load(location.href + " #service_area_div");  
          }
        })
          } else {
            return false;
          }
        });

      }); 


       function test(){
        alert("hh");
      }


      $('#add').click(function(){  
       $('#insert').val("Insert");  
       $('#insert_form')[0].reset(); 
       $('#insert_form2')[0].reset();  
     });  
      $(document).on('click', '.edit_area', function(){  
       var id = $(this).attr("id");  
       $.ajax({  
        url:"action/fetch-area.php",  
        method:"POST",  
        data:{id:id},  
        dataType:"json",  
        success:function(data){  
          $('#area_name').val(data.area_name);  
          $('#area_code').val(data.area_code);
          $('#comment').val(data.comment); 
          $('#id').val(data.id); 
          $('#insert').val("Add Area");  
          $('#add_data_Modal').modal('show');  
        }  
      });  
     });  

      $(document).on('click', '.edit_ticket_type', function(){  
       var id = $(this).attr("id");  
       $.ajax({  
        url:"action/fetch-ticket-type.php",  
        method:"POST",  
        data:{id:id},  
        dataType:"json",  
        success:function(data){  
          $('#type_name').val(data.type_name); 
          $('#id2').val(data.id); 
          $('#insert2').val("Add Area");  
          $('#add_data_Modal2').modal('show');  
        }  
      });  
     });  
      $(document).on('click', '.edit_monthly_plans', function(){ 
        alert("hh"); 

      });  
      $(document).on('click', '.delete_area', function(){  
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
              url:"action/deletearea.php",
              method:"POST",
              data:{id:id},
              success:function(data){
                swal("Deleted Successfully!!!!", {
                  icon: "success",
                }); 
                $("#service_area_div").load(location.href + " #service_area_div");  
              }
            })
          } else {
            return false;
          }
        });
      });  
      $(document).on('click', '.delete_ticket_type', function(){  
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
              url:"action/deletetickettype.php",
              method:"POST",
              data:{id:id},
              success:function(data){
                swal("Deleted Successfully!!!!", {
                  icon: "success",
                }); 
                $("#ticket_type_div").load(location.href + " #ticket_type_div");  
              }
            })
          } else {
            return false;
          }
        });
      });  
      $(document).on('click', '.delete_plans', function(){  
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
              url:"action/delete-plans.php",
              method:"POST",
              data:{id:id},
              success:function(data){
                swal("Deleted Successfully!!!!", {
                  icon: "success",
                }); 
                $("#plans_div").load(location.href + " #plans_div");  
                $("#dedicated_plans_div").load(location.href + " #dedicated_plans_div");
              }
            })
          } else {
            return false;
          }
        });
      });  

      $(document).on('click', '.edit_siteName', function(){  
        swal("Enter New Name", {
          content: "input",
        })
        .then((value) => {
          var new_name = value;
          if(new_name == "" || new_name == null){
            swal("Site Name can't be empty!", {
              icon: "warning",
            });
          }else{
            $.ajax({
              url:"action/update-siteName.php",
              method:"POST",
              data:{new_name:new_name},
              success:function(data){
                swal("Name Changed Successfully!", {
                  icon: "success",
                });   
                $(".siteName_div").load(location.href + " .siteName_div");  
              }
            });
          } 
        });
      });


      $('#insert_form').on("submit", function(event){  
       event.preventDefault();  
       $.ajax({  
         url:"action/update-area.php",  
         method:"POST",  
         data:$('#insert_form').serialize(),  
         beforeSend:function(){  
          $('#insert').val("Updating");  
        },  
        success:function(data){  
          $('#insert_form')[0].reset();  
          $('#add_data_Modal').modal('hide');  
          $("#service_area_div").load(location.href + " #service_area_div");
        }  
      });  

     });  
      $('#insert_form2').on("submit", function(event){  
       event.preventDefault();  
       $.ajax({  
         url:"action/update-ticket-type.php",  
         method:"POST",  
         data:$('#insert_form2').serialize(),  
         beforeSend:function(){  
          $('#insert').val("Updating");  
        },  
        success:function(data){  
          $('#insert_form2')[0].reset();  
          $('#add_data_Modal2').modal('hide');  
          $("#ticket_type_div").load(location.href + " #ticket_type_div"); 
        }  
      });  

     });  
      $('#insert_form3').on("submit", function(event){  
       event.preventDefault();  
       $.ajax({  
         url:"action/update-plans.php",  
         method:"POST",  
         data:$('#insert_form3').serialize(),  
         beforeSend:function(){  
          $('#insert').val("Updating");  
        },  
        success:function(data){  
          $('#insert_form3')[0].reset();  
          $('#add_data_Modal3').modal('hide');  
          $("#plans_div").load(location.href + " #plans_div"); 
          $("#dedicated_plans_div").load(location.href + " #dedicated_plans_div"); 
        }  
      });  

     });  


    });  
  </script>

