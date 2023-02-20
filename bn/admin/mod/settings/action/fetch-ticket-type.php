<?php  
 //fetch.php  
 include('../../../db/conn.php');
 if(isset($_POST["id"]))  
 {  
      $query = "SELECT * FROM ticket_type WHERE id = '".$_POST["id"]."'";  
      $result = mysqli_query($conn, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>