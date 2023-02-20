<?php
// Initialize the session
session_start();
include('../../db/conn.php');

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
}
$username = $_SESSION['username'];
$query=mysqli_query($conn,"select * from `admin` where username='$username'");
$result=mysqli_fetch_array($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>View Profile | <?php echo $siteName; ?></title>
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
      <h1>Messages</h1>
      <ol class="breadcrumb">
        <li><a href="#">Tools</a></li>
        <li><i class="fa fa-angle-right"></i> Messages</li>
      </ol>
    </div>
    <div class="content"> 
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3"> 

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-profile"> 
              <div class="box-header">
                <center><h5>Online Users</h5></center>
              </div>

              <ul class="nav nav-stacked sty1">
               <?php
               $sql7 = "SELECT * FROM admin";
               if($result7 = mysqli_query($conn, $sql7)){
                if(mysqli_num_rows($result7) > 0){
                  while($row = mysqli_fetch_array($result7)){
                    $senderUser = $row["username"];
                    $countUnseen = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM messages WHERE receiverName = '$username' && senderName='$senderUser' && ifSeen='0' "));
                    //echo $countUnseen[0];
                    echo ' <li><a href="#" class="openchat" id="'. $row["username"].'">'.$row['full_name'].'<span class="pull-right badge badge-success">'. $countUnseen[0].'</span></a></li>';
                    
                  }
                }
              } 
              ?>




            </ul>
          </div>
          <!-- /.box-body --> 
        </div>
        <!-- /.box --> 
      </div>
      <!-- /.col -->
      <div class="col-lg-9">
        <div class="info-box">
          <div class="box-body">
           <div class="col-lg-12" >
            <div class="info-box">
              <div class="box box-warning direct-chat direct-chat-warning">
                <div class="box-body"> 
                  <!-- Conversations are loaded here -->
                  <div class="direct-chat-messages">
                    <form id="send_msg" method="post">
                      <div id="load-mess"></div>





                    </div>
                  </div>
                  <div class="box-footer">

                    <div class="input-group">
                      <input type="text" name="message" id="message" placeholder="Type Message ..." class="form-control">

                      <span class="input-group-btn">
                        <button type="submit"  class="btn btn-warning btn-flat send_sms ">Send</button>
                      </span> </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
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





<!-- <script type="text/javascript">
  $(document).ready(function (e) {
   $.ajax({  
    url:"load.php",  
    method:"post",  
    success:function(data){  
     $('#load-mess').html(data);  

       //$('#dataModal').modal("show");  
     }  
   });  
 });
</script> -->
<script type="text/javascript">
  $(document).ready(function(){

    var sender = '<?php echo $result['username']; ?>';

    $(".openchat").on('click', function() {

     var receiver = $(this).attr("id");
     // console.log(sender);
      //console.log(receiver);
      $.ajax({  
        url:"load.php",  
        method:"post", 
        data:{sender:sender,receiver:receiver}, 
        success:function(data){  
         $('#load-mess').html(data);  

       //$('#dataModal').modal("show");  
     }  
   });  


      function fetchdata(){

       $.ajax({  
        url:"load.php",  
        method:"post", 
        data:{sender:sender,receiver:receiver}, 
        success:function(data){  
         $('#load-mess').html(data);  

       //$('#dataModal').modal("show");  
     }  
   });  
     }


     setInterval(fetchdata,5000);

     $.ajax({  
      url:"action/seen-action.php",  
      method:"post", 
      data:{sender:sender,receiver:receiver}, 
      success:function(data){  

      }  
    });  

   });


    $('#send_msg').on("submit", function(event){

     event.preventDefault(); 
     var message = $('#message').val(); 
     var receiver2 = $('#receiver').val(); 
     //alert("gg") 
     $.ajax({  
       url:"action/send-msg.php",  
       method:"POST",  
       data:{sender:sender,receiver2:receiver2,message:message}, 
       beforeSend:function(){  
        //console.log(sender)
      },  
      success:function(data){  
        // $('#insert_form2')[0].reset();  
        // $('#edit_bill_Modal').modal('hide');  
        $('input[name=message').val('');
        $.ajax({  
          url:"load.php",  
          method:"post", 
          data:{sender:sender,receiver:receiver2}, 
          success:function(data){  
           $('#load-mess').html(data);  

       //$('#dataModal').modal("show");  
     }  
   });  


      }  
    });  
   });
  });
</script>
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
              <input type="hidden" name="username" value="<?php echo $result['username'];?>">
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
</div>
</div>



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
         <thead class="text-white bg-c-blue">
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
          $username=$result['username'];
          $sql = "SELECT * FROM salary WHERE emp_id='$username'";
          if($result = mysqli_query($conn, $sql)){
            if(mysqli_num_rows($result) > 0){

              while($row = mysqli_fetch_array($result)){

                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['emp_name'] . "</td>";
                echo "<td>" . $row['month'] . "</td>";
                echo "<td>" . $row['paid'] . "</td>";
                echo "<td>" . $row['date'] . "</td>";

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
          <thead>
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

</body>
</html>
