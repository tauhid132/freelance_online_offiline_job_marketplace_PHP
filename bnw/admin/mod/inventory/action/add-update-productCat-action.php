<?php
include('../../../db/conn.php');
session_start();
$admin=$_SESSION['username'];
$name=$_POST['name'];
$description=$_POST['description'];
$stock=$_POST['stock'];

if($_POST['id']!=""){
	$id=$_POST['id'];
	mysqli_query($conn,"update `products` set name='$name',description='$description',stock='$stock' where id='$id'");
	mysqli_query($conn,"insert into `log` (action,module,action_by) values ('Product Category No: $id Updated.','Inventory','$admin')");

}else{
	mysqli_query($conn,"insert into `products` (name,description,stock) values ('$name','$description','$stock')"); 
	mysqli_query($conn,"insert into `log` (action,module,action_by) values ('New Product Category Created.','Inventory','$admin')");
}


?>