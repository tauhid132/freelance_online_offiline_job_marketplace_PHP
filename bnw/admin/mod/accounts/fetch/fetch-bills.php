<?php  
include ('../../../db/conn.php');
  
      $output = '';  
      $output .= ' 
     
      
                <thead class="text-white bg-c-blue">
                 <tr>
                  <th>No</th>
                  <th>User-ID</th>
                  
                  <th>Monthly Bill</th>
                  <th>Due Bill</th>
                  <th>Paid Monthly</th>
                  <th>Paid Due</th>
                  <th>Action</th>
                </tr>
              </thead>					 
		   ';  
	  
	  
      $i=1;
             $sql = "SELECT * FROM billing ";
             if($result = mysqli_query($conn, $sql)){
              if(mysqli_num_rows($result) > 0){

                while($row = mysqli_fetch_array($result)){
                $output .='<tr>  
                     				 
                     <td>'.$row["id"].'</td> 			
                     <td>'.$row["user_id"].'</td>					 
					 <td>'.$row["monthly_bill"].'</td>
					 <td>'.$row["pre_due"].'</td>
					 <td>'.$row["paid_bill"].'</td>
					 <td>'.$row["paid_due"].'</td>
					 <td>'.$row["pay_date"].'</td>
                </tr>'; 
                 
				}
			  }
			 }
      $output .= "</div>";  
      echo $output;  
   
 ?>