<?php  
 //fetch.php  
 include('../../../db/conn.php');
 if(isset($_POST["username"]))  
 {  
      $query = "SELECT * FROM users WHERE username = '".$_POST["username"]."'";  
      $result = mysqli_query($conn, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>