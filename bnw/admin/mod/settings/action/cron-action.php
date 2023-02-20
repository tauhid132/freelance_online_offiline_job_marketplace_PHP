<?php
include('../../../db/conn.php');
$today = date("d");

$sql = "SELECT * FROM cron WHERE executeOn = '$today'  ";
if($result = mysqli_query($conn, $sql)){
	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_array($result)){

			$filePath= $row['filePath'];
			include($filePath);
			
		}
	}
}




?>