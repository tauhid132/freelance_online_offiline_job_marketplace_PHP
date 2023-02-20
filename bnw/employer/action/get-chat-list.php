<?php
include ('../../database/dbconnect.php');
session_start();
$email = $_SESSION['email'];
$output = ''; 
$sql7 = "SELECT * FROM employee";
if($result7 = mysqli_query($conn, $sql7)){
	if(mysqli_num_rows($result7) > 0){
		while($row = mysqli_fetch_array($result7)){
			$output .='
			<a href="#" class="openchat" id="'.$row['emailAddress'].'">
				<div class="usr-msg-details" style="margin-top:25px">
					<div class="usr-ms-img">
						<img src="'.$url.'/'.$row['imageLink'].'" alt="">
						<span class="msg-status"></span>
					</div>
					<div class="usr-mg-info">
						<h3 >'.$row['fullName'].'</h3>
						<p>Thanks</p>
					</div>
					<span class="posted_time">1:55 PM</span>
				</div>
			</a>';
			
		}
	}
} 
echo $output;
?>