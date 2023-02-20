<?php  
include ('../../../db/conn.php');
 if(isset($_POST["employee_id"]))  
 {  
      $output = '';  
      $query1=mysqli_query($conn,"select * from `billing` where id = '".$_POST["employee_id"]."'");
	  $result1=mysqli_fetch_array($query1);
	  $user_id=$result1['user_id'];
	  
	  
      $query = "SELECT * FROM billing WHERE user_id = '$user_id'";  
      $result = mysqli_query($conn, $query);  
      $output .= ' 
	
      <div class="table-responsive">  
           <table class="table table-bordered">
		             <thead class="text-black bg-info">
		             <td><label>Month</label></td>
                     <td><label>M.Bill</label></td>	
                     <td><label>D.Bill</label></td>
                     <td><label>Paid Monthly</label></td>
                     <td><label>Paid Due</label></td>	
                     <td><label>Date</label></td>
                     <td><label>P.Method</label></td>
                     </thead>					 
		   ';  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= ' 		   
                <tr>  
                     				 
                     <td>'.$row["billing_month"].'</td>  
					 <td>'.$row["monthly_bill"].'</td>
					 <td>'.$row["pre_due"].'</td>
					 <td>'.$row["paid_bill"].'</td>
					 <td>'.$row["paid_due"].'</td>
					 <td>'.$row["pay_date"].'</td>
           <td>'.$row["pay_method"].'</td>
                </tr>  
                
                ';  
      }  
      $output .= "</table></div>";  
      echo $output;  
 }  
 ?>