<?php
include('../../../db/conn.php');
include('../includes/routeros_api.class.php');     
include('../includes/connapi.php');


$sql = "SELECT * FROM mikrotiklist";
if($result22 = mysqli_query($conn, $sql)){
	if(mysqli_num_rows($result22)>0){
		while($row = mysqli_fetch_array($result22)){
			${$row['serverName']} = ${$row['serverName']}->comm("/ppp/active/print");			
		}
	}
}

//$moniServer = $moniServer->comm("/ppp/active/print");
//$testServer = $testServer->comm("/ppp/active/print");

function get_total_all_records()
{
	include('../../../db/conn.php');
	$statement = $connect->prepare("SELECT * FROM users WHERE apiEnabled='1' && apiServer != '' ");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}
$query = '';
$output = array();
$query .= "SELECT * FROM users WHERE apiEnabled='1' && apiServer!=''  ";
if(isset($_POST["search"]["value"]))
{
	$query .= 'AND (username LIKE "%'.$_POST["search"]["value"].'%" ' ;
	$query .= 'OR cus_name LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR area LIKE "%'.$_POST["search"]["value"].'%") ';
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY id ASC ';
}
if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
$k=1;
foreach($result as $row)
{
	
	
	$sub_array = array();
	$sub_array[] = $k;
	
	// if($row['status']=='Active')
 //                              $sub_array[] = '<td><span class="badge badge-success">Active</span></td>'; 
 //                             else 
 //                              $sub_array[] = '<td><span class="badge badge-danger">Closed</span></td>';
	
	
	$sub_array[] = $row["username"];
	$sub_array[] = $row["cus_name"];
	$sub_array[] = $row["area"];


	$clientServer = $row['apiServer'];
	$num =count(${$clientServer});  
	for($i=0; $i<$num; $i++){
		if(${$clientServer}[$i]['name']==strtolower($row['username'])){
			$isOnline='yes';
			$upTime = ${$clientServer}[$i]['uptime'];
			$ipAddress = ${$clientServer}[$i]['address'];
			$idNo=${$clientServer}[$i]['name'];
			break;

		}else{
			$isOnline='no';
			$upTime = 'No Data!';
			$ipAddress = "No Data!";
			$idNo=$row['username'];
		}
	}

	$sub_array[] = $upTime;
	$sub_array[] = $ipAddress;
	if($isOnline=='yes'){
		$sub_array[] = '<td><span class="label label-success">Connected</span></td>'; 
	}else if($isOnline='no'){
		$sub_array[] = '<td><span class="label label-danger">Offline</span></td>';
	}

	if($row['status']=='Active')
		$sub_array[] = '<td><span class="label label-success">Active</span></td>'; 
	else if($row['status']=='Inactive')
		$sub_array[] = '<td><span class="label label-danger">Inactive</span></td>';
	else if($row['status']=='Expired')
		$sub_array[] = '<td><span class="label label-warning">Expired</span></td>';
	$sub_array[] = '

	<td>
	
	<i class="fa fa-ban text-red disable_user" id="'. $idNo.'" style="font-size:20px"></i>
	
	
	<i class="fa fa-check-circle text-green enable_user" id="'. $idNo.'" style="font-size:20px"></i>
	


	</td>
	';
	
	$data[] = $sub_array;
	$k++;
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_records(),
	"data"				=>	$data
);
echo json_encode($output);
?>