<?php	
//include('../../../db/conn.php');

	//Fetch mikrotik
$i=1;
$test = 500;
$sql = "SELECT * FROM mikrotiklist";
if($result = mysqli_query($conn, $sql)){
	if(mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_array($result)){
			//Creating Object
			${$row['serverName']} = new routeros_api();
			$ip = $row['ipAddress'];
			$user = $row['username'];
			$pass = $row['password'];
			// if(${$row['serverName']}->connect($ip, $user, $pass)){
				
			// }
			${$row['serverName']}->connect($ip, $user, $pass);
			$i++;
		}
	}
}

?>