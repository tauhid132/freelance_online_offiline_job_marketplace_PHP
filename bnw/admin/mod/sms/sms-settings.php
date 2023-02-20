<?php
session_start();
include('../../db/conn.php');
include('../../includes/functions.php');

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
  <title>SMS Settings | <?php echo $siteName; ?></title>
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
       <h1><i class="fa fa-cogs"></i> SMS Settings </h1>
      <ol class="breadcrumb">
        <li><a href="#">SMS</a></li>
        <li><i class="fa fa-angle-right"></i> Settings</li>
      </ol>
    </div>

    <style>
      .loader {
        visibility: hidden;
        position: fixed;
        border: 16px solid #f3f3f3;
        z-index: +100 !important;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        width: 120px;
        height: 120px;
        margin-left: 35%;
        -webkit-animation: spin 2s linear infinite; /* Safari */
        animation: spin 2s linear infinite;
      }

      /* Safari */
      @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
      }

      @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
      }
    </style>
    
    <!-- Main content -->
    <div class="content">
      <form method="post" id="form1"> 
        <div class="card">
          <div class="card-header">
            <center><h5 class="text-black">SMS Settings</h5></center>
          </div>
          <div class="card-body">
            <div class="row">
             <div class="col-md-2">
               <label class="text-black"><h4>Balance: </h4></label>
               <h5><?php echo getSmsBalance();?> Tk.</h5>
             </div>
             <div class="col-md-4">
              <label class="text-black"><h4>API Key</h4></label>
              <h5>C2006488600af9e92648e2.93379022</h5>
            </div>
            <div class="col-md-4">
              <label class="text-black"><h4>URL</h4></label>
              <h5>https://esms.mimsms.com/smsapi</h5>
            </div> 
            <div class="col-md-2">
              <label class="text-black"><h4>Sender ID</h4></label>
              <h5>8809612446205</h5>
            </div> 
            
          </div>
        </div>
        <div class="card-footer">
          <center><button class="btn btn-info"><i class="fa fa-edit"></i> Edit Settings</button></center>
        </div>
      </div>
    </form>
    <!-- <center><div class="loader"></div></center> -->
    <form method="post" id="form2">
      <div class="card mt-2">
        <div class="card-header">
          <center><h5 class="text-black">SMS Report</h5></center>
        </div>
        <div class="card-body">
         <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Timestamp</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i=1;
                $sql = "SELECT * FROM log WHERE module='SMS' ORDER BY id DESC";
                if($result = mysqli_query($conn, $sql)){
                  if(mysqli_num_rows($result) > 0){

                    while($row = mysqli_fetch_array($result)){

                      echo "<tr>";
                      echo "<td>" . $i . "</td>";
                      echo "<td>" . $row['timestamp'] . "</td>";
                      echo "<td>" . $row['action'] . "</td>";
                      $i++;


                      echo "</tr>";

                    }

        // Free result set
                    mysqli_free_result($result);
                  } 
                } else{
                  echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
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
    </form>



    <!-- /.content --> 
  </div>
</div>
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
<script type="text/javascript">
  $('#form1').on("submit", function(event){  
   event.preventDefault(); 
   $.ajax({  
    url:"fetch/fetch-users-reminder.php",  
    method:"POST",  
    data:$('#form1').serialize(), 

    beforeSend:function(){  
      //$('#btn1').val("Updating");  
      $('.loader').css("visibility", "visible");
    },  
    success:function(data){  
      $('#selected_users').html(data); 
      //$('#form1')[0].reset(); 
     // $('#btn1').val("Get Users");
     $('.loader').css("visibility", "hidden");
      //var smstext2 = data.smstext;
      
      //$('#add_data_Modal').modal('hide');  
      //$('#employee_table').html(data);
      //$(location.reload());  
    }  
  });  
 });

  $('#form2').on("submit", function(event){  
   event.preventDefault(); 
   if($('#sms_type').val() == 'custom'){
    var sms_text = $('#sms_cus').val();
  }else{
    var sms_text = $('#sms_type').val();
  } 
  var selectedUsers = [];
  $("input[name='selectedUsers']:checked").each(function(){
    selectedUsers.push(this.value);
  });
  

  $.ajax({  
    url:"action/send.php",  
    method:"POST",  
    data:{selectedUsers:selectedUsers,sms_text:sms_text},
    beforeSend:function(){  
      //$('#btn2').val("Updating");  
      $('.loader').css("visibility", "visible");
    },  
    success:function(data){  
      $('#form1')[0].reset(); 
      $('#form2')[0].reset(); 
      //$('#btn2').val("Get Users");
      $('.loader').css("visibility", "hidden");
      
    }  
  }); 
  
});
  $(document).ready(function(){
    //$('.ajax-loader').css("visibility", "visible");
    $('#sms_cus').hide();
    $('#sms_type').change(function(){
      if($('#sms_type').val() == 'custom'){
        $('#sms_cus').show();
      }else{
        $('#sms_cus').hide();
      }
    });
  });

</script>



</body>
</html>
