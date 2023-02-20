<?php
// Initialize the session
session_start();
include('../../db/conn.php');
$month=$_GET['month'];


// Check if the user is logged in, if not then redirect him to login page
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
  <title>Monthly Billing | <?php echo $siteName; ?></title>
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
      <h1><i class="fa fa-money"></i> Monthly Billing of <?php echo $month ?> </h1>
      <ol class="breadcrumb">
        <li><a href="#">Users</a></li>
        <li><i class="fa fa-angle-right"></i> All Users</li>
      </ol>
    </div>
    <div class="col-md-12">
      <form role="form" method="get" action="monthly-bill.php">
        <div class="input-group">
         <select class="custom-select form-control" data-placeholder="Type to search cities" name="month" >

          <?php
          for($j=0; $j<12; $j++){
            //echo "'".date('F-Y', strtotime("-$j Months"))."'";
            echo '<option value="'.date('F-Y', strtotime("-$j Months")).'"><h1>'.date('F-Y', strtotime("-$j Months")).'</h1></option>';
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
        <table id="billing-table" class="table table-bordered table-striped">
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

<div id="add_data_Modal" class="modal fade">  
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><b>Bill Payment</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="post" id="insert_form">  
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
               <input type="hidden" name="id" id="id" class="form-control" readonly />  
               <div class="form-group">
                <label for="exampleInputEmail1">User-ID</label>
                <input type="text" class="form-control" name="user_id" id="user_id" readonly>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Monthly Bill</label>
                <input type="text" class="form-control" name="monthly_bill" id="monthly_bill" readonly>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Due Bill</label>
                <input type="text" class="form-control" name="pre_due" id="pre_due" readonly>
              </div>
              <div class="form-group">
                <label>Payment Method</label>
                <select class="form-control" name="pay_method" id="pay_method" >
                  <option value="">Select Payment Method</option>
                  <option value="Cash">Cash</option>
                  <option value="Bkash">Bkash</option>
                  <option value="Nogod">Nogod</option>
                  <!--  <option value="Rocket">Rocket</option> -->
                  <option value="Bank">Bank</option>

                </select>
              </div> 
              <div class="form-group">
                <label for="exampleInputEmail1">Send Confirmation SMS</label>
                <input type="checkbox" name="sendsms" value="yes"</td>
              </div>

              <!-- /.form-group -->

              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
             <div class="form-group">
              <label for="exampleInputEmail1">Customer Name</label>
              <input type="text" class="form-control" name="cus_name" id="cus_name" readonly>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Paid Monthly Bill</label>
              <input type="text" class="form-control" name="paid_bill" id="paid_bill">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Paid Due Bill</label>
              <input type="text" class="form-control" name="paid_due" id="paid_due">
            </div>
            <!-- /.form-group -->


            <div class="form-group">
              <label for="exampleInputEmail1">Payment Date</label>
              <input type="date" class="form-control" name="pay_date" id="pay_date">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Send Confirmation Email</label>
              <input type="checkbox" name="sendemail" value="yes"</td>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.card-body -->

        <div class="form-group trx">
          <label for="exampleInputEmail1">TRX / Transection ID</label>
          <input type="text" class="form-control" name="trxid" id="trxid">
        </div>

        <div class="card-footer">
         <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" /> 

       </div>


     </form>
   </div>
   <!-- /.row -->
 </div>

 <!-- /.card -->
</div>

<!-- /.card -->
</div>
<!-- /.col -->
</div>
</div>  
</div>  
<div id="dataModal" class="modal fade">  
  <div class="modal-dialog modal-lg">
   <div class="modal-content">  
     <div class="modal-header">
      <h4 class="modal-title">Billing History</h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
   </div> 
   <div class="modal-body" id="billing_history">  
   </div>  
   <div class="modal-footer">  
     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
   </div>  
 </div>  
</div>  
</div>  








<!-- /.card -->
</div>  
<script>  
 $(document).ready(function(){ 

   var dataTable = $('#billing-table').DataTable({
    "autoWidth"   : false,
    "processing": true,
    "serverSide": true,
    "order":[],
    "ajax": {
      "url": "fetch/fetch-bill-all.php",
      "type": "POST",
      "data": function(d){
       d.month = '<?php echo $month; ?>';
     }
   }

 });

 var userType =  '<?php echo $_SESSION['role'];?>';
 //alert(userType);
 // if(userType == 'admin'){
 //  alert("admin");
 // }

   $('#add').click(function(){  
     $('#insert').val("Insert");  
     $('#insert_form')[0].reset();  
   });  
   $(document).on('click', '.edit_data', function(){
      if(userType == 'admin'){
     var id = $(this).attr("id");  
     $.ajax({  
      url:"action/fetch-bill.php",  
      method:"POST",  
      data:{id:id},  
      dataType:"json",  
      success:function(data){  
       $('#user_id').val(data.user_id);  
       $('#cus_name').val(data.cus_name);  
       $('#monthly_bill').val(data.monthly_bill);
       $('#pre_due').val(data.pre_due); 
       $('#paid_bill').val(data.paid_bill); 
       $('#paid_due').val(data.paid_due);
       $('#pay_date').val(data.pay_date);
       $('#pay_method').val(data.pay_method);
       $('#trxid').val(data.trxid);
       $('#id').val(data.id);      
       
       $('#insert').val("Update Payment");  
       $('#add_data_Modal').modal('show');  
       $('.trx').hide();
     }  
   });  
   }else{
    swal("Not Permitted!!")
   }
   });  

   $(document).on('click', '.view_data', function(){
     var employee_id = $(this).attr("id");  
     $.ajax({  
      url:"action/fetch-bill-history.php",  
      method:"post",  
      data:{employee_id:employee_id},  
      success:function(data){  
       $('#billing_history').html(data);  
       $('#dataModal').modal("show");  
     }  
   });  
   });  

   $(document).on('click', '.edit_bill', function(){  
    if(userType == 'admin'){
     var id = $(this).attr("id");  
     $.ajax({  
      url:"action/fetch-bill.php",  
      method:"POST",  
      data:{id:id},  
      dataType:"json",  
      success:function(data){  
       $('#user_id2').val(data.user_id);  
       $('#cus_name2').val(data.cus_name);  
       $('#monthly_bill2').val(data.monthly_bill);
       $('#pre_due2').val(data.pre_due); 
       $('#id2').val(data.id);
       $('#insert').val("Update Bill");  
       $('#edit_bill_Modal').modal('show');  
     }  
   });  
   }else{
    swal("Not Permitted!!")
   }
   });  

   $(document).on('click', '.delete_bill', function(){  
    if(userType == 'admin'){
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
          url:"action/delete-bill.php",
          method:"POST",
          data:{id:id},
          success:function(data){
            swal("Deleted Successfully!!", {
              icon: "success",
            });
            dataTable.ajax.reload();
          }
        })
      } else {
        return false;
      }
    });
  }else{
    swal("Not Permitted!!")
  }
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
      return false;
    }
  });
   });  

   $('#insert_form').on("submit", function(event){  
     event.preventDefault();  

     if($('#pay_method').val() == '')  
     {  
      alert("Please Select payment method!");  
    }


    else  
    {  
      $.ajax({  
       url:"action/bill-payment.php",  
       method:"POST",  
       data:$('#insert_form').serialize(),  
       beforeSend:function(){  
        $('#insert').val("Updating");  
      },  
      success:function(data){  
        $('#insert_form')[0].reset();  
        $('#add_data_Modal').modal('hide');  
        dataTable.ajax.reload();
      }  
    });  
    }  
  });

   $('#insert_form2').on("submit", function(event){  
     event.preventDefault();   
     $.ajax({  
       url:"action/update-bill.php",  
       method:"POST",  
       data:$('#insert_form2').serialize(),  
       beforeSend:function(){  
        $('#insert2').val("Updating");  
      },  
      success:function(data){  
        $('#insert_form2')[0].reset();  
        $('#edit_bill_Modal').modal('hide');  
        $('#insert2').val("Update");

        dataTable.ajax.reload();  
      }  
    });  

   }); 

   $(document).ready(function(){
    $('#pay_method').change(function(){
      if($('#pay_method').val() == 'Bkash'){
        $('.trx').show();
      }else if($('#pay_method').val() == 'Bank'){
        $('.trx').show();
      }else{
        $('.trx').hide();
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

 });  
</script>
<!-- jQuery 3 --> 
<div id="edit_bill_Modal" class="modal fade">  
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><b>Edit Bill</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="post" id="insert_form2">  
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
               <input type="hidden" name="id" id="id2" class="form-control" readonly />  
               <div class="form-group">
                <label for="exampleInputEmail1">User-ID</label>
                <input type="text" class="form-control" name="user_id" id="user_id2">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Monthly Bill</label>
                <input type="text" class="form-control" name="monthly_bill" id="monthly_bill2">
              </div>
              


              <!-- /.form-group -->

              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
             <div class="form-group">
              <label for="exampleInputEmail1">Customer Name</label>
              <input type="text" class="form-control" name="cus_name" id="cus_name2">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Previous Due</label>
              <input type="text" class="form-control" name="pre_due" id="pre_due2">
            </div>
            
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
         <input type="submit" name="insert2" id="insert2" value="Update" class="btn btn-success" /> 
       </div>
     </form>
   </div>
   <!-- /.row -->
 </div>

 <!-- /.card -->
</div>
</body>
</html>
