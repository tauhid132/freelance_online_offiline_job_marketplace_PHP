<?php  
include ('../../../db/conn.php');
 if(isset($_POST["employee_id"]))  
 {  
      $output = '';  
      $query1=mysqli_query($conn,"select * from `upstream` where id = '".$_POST["employee_id"]."'");
	  $result1=mysqli_fetch_array($query1);
	  $upstream_name=$result1['upstream'];
	  
	  
      $query = "SELECT * FROM upstream_bill WHERE upstream = '$upstream_name'";  
      $result = mysqli_query($conn, $query);  
      $output .= ' 
	
      <div class="table-responsive">  
           <table class="table table-bordered">
		             <thead class="text-black bg-info">
		             <td><label>Month</label></td>
                     <td><label>Monthly Bill</label></td>	
                     <td><label>Due Bill</label></td>
                     <td><label>Paid Monthly</label></td>
                    
                     
                     </thead>					 
		   ';  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= ' 		   
                <tr>  
                     				 
                     <td>'.$row["month"].'</td>  
					 <td>'.$row["bill"].'</td>
					 <td>'.$row["due"].'</td>
					 <td>'.$row["paid"].'</td>
					 
           
                </tr>  
                
                ';  
      }  
      $output .= "</table></div>";  
      echo $output;  
 }  
 ?>