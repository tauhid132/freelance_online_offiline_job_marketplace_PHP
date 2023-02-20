<?php
include('../db/conn.php');
session_start();
$admin=$_SESSION['username'];
	//$id = mysqli_real_escape_string($conn, $_POST["id"]);
$catName = mysqli_real_escape_string($conn, $_POST["catName"]);	 
$description = '';


if($_POST['id']!=""){
	$id=$_POST['id'];
	if(is_array($_FILES)) {
		if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
			$sourcePath = $_FILES['userImage']['tmp_name'];
			$targetPath = "../../upload/cat-image/".$_FILES['userImage']['name'];
			$img_link = "upload/cat-image/".$_FILES['userImage']['name'];
			if(move_uploaded_file($sourcePath,$targetPath)) {
			}
		}
	}
	mysqli_query($conn,"update `service_categories` set catName='$catName',description='$description', imageLink = '$img_link' where id='$id'");

}else{
	mysqli_query($conn,"insert into `service_categories` (catName, description) values ('$catName','$description')");
		//mysqli_query($conn,"insert into `log` (action,module,action_by) values ('Zone/Area: $area_name added.','Settings','$admin')");


}














?>