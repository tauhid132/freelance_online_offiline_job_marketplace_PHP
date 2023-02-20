<?php
session_start();
include('../../db/conn.php');

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
  <title>SMS Templates | <?php echo $siteName; ?></title>
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
         <h1><i class="fa fa-paper-plane-o"></i> SMS Templates </h1>
        <ol class="breadcrumb">
         <button class="btn btn-info btn-sm" style="float: right;" id="add" data-toggle="modal" data-target="#add_task_Modal"><i class="fa fa-plus-circle"></i> Create New Template</button>
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
                  <th>Template Name</th>
                  <th>Template Text</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>

                <?php
                $i=1;
                $sql = "SELECT * FROM sms_template ORDER BY id DESC";
                if($result = mysqli_query($conn, $sql)){
                  if(mysqli_num_rows($result) > 0){

                    while($row = mysqli_fetch_array($result)){

                     echo "<tr>";
                     echo "<td>" . $i . "</td>";
                     echo "<td>" . $row['sms_name'] . "</td>";
                     echo "<td>" . $row['text'] . "</td>";
                     echo '<td>
                     <i class="fa fa-edit text-green edit_data" id="'. $row["id"].'"  style="font-size:20px"></i>
                     </a>
                     <a href="action/delete-sms-template.php?id=' . $row['id'] . '">
                     <i class="fa fa-trash text-red" style="font-size:20px"></i>
                     </a>
                     </td>';
                     echo "</tr>";
                     $i++;
                   }
                   mysqli_free_result($result);
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

<div id="add_task_Modal" class="modal fade">  
 <div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h4 id="modalTitle" class="modal-title"><b>Create New Template</b></h4>
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
              <label for="exampleInputEmail1">SMS Name</label>
              <input type="text" class="form-control" name="sms_name" id="sms_name"></input>
            </div>

            

            <!-- /.form-group -->

            <!-- /.form-group -->
          </div>
          <!-- /.col -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="exampleInputEmail1">SMS Body</label>
              <textarea type="text" class="form-control" name="text" id="text"></textarea>
            </div>
            <!-- /.form-group -->


            
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
         <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" /> 
       </div>
     </form>
   </div>
   <!-- /.row -->
 </div>

 <!-- /.card -->
</div>
<!-- /.col -->

<script>  
 $(document).ready(function(){  
  $('#add').click(function(){  
   $('#insert').val("Insert");  
   $('#insert_form')[0].reset();
   $('#modalTitle').html("Create New Template");  
 });  
  $(document).on('click', '.edit_data', function(){  
   var id = $(this).attr("id");  
   $.ajax({  
    url:"fetch/fetch-sms-templates.php",  
    method:"POST",  
    data:{id:id},  
    dataType:"json",  
    success:function(data){  
      $('#sms_name').val(data.sms_name);  
      $('#text').val(data.text);
      $('#id').val(data.id);   
      $('#insert').val("Update");  
      $('#add_task_Modal').modal('show'); 
      $('#modalTitle').html("Update Template"); 
    }  
  });  
 });  
  $('#insert_form').on("submit", function(event){  
   event.preventDefault();  
   if($('#sms_name').val() == "")  
   {  
    swal("SMS Name is required!");  
  }  

  else if($('#text').val() == '')  
  {  
    swal("SMS Body is required!");  
  }  

  else  
  {  
    $.ajax({  
     url:"action/sms-template-action.php",  
     method:"POST",  
     data:$('#insert_form').serialize(),  
     beforeSend:function(){  
      $('#insert').val("Inserting");  
    },  
    success:function(data){  
      $('#insert_form')[0].reset();  
      $('#add_task_Modal').modal('hide');  

      $(location.reload());  
      //$("#here").load(window.location.href + " #dom-jqry" );
    }  
  });  
  }  
});  


});  


</script>
</body>
</html>
