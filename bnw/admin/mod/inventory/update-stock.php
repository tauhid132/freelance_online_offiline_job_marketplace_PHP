<?php
	include('../../db/conn.php');
	 session_start();
	$admin=$_SESSION['username'];
	 $id = mysqli_real_escape_string($conn, $_POST["id"]);
	 $name = mysqli_real_escape_string($conn, $_POST["name"]);
     
	 
	 
	 $stock = mysqli_real_escape_string($conn, $_POST["stock"]);
	 $new_stock = mysqli_real_escape_string($conn, $_POST["new_stock"]);
	 $total_stock=$stock + $new_stock;
	
	 
	
	mysqli_query($conn,"update `products` set stock='$total_stock' where id='$id'");
	if($new_stock>0){
	mysqli_query($conn,"insert into `log` (action,module,action_by) values ('New stock added on $name by $new_stock.','Inventory','$admin')");
	}else if($new_stock<0){
	mysqli_query($conn,"insert into `log` (action,module,action_by) values ('Stock removed on $name by $new_stock.','Inventory','$admin')");	
	}
	
	
	
	
	
	
	
?>