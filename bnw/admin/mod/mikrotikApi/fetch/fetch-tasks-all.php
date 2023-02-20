<?php
include('../../../db/conn.php');
include('../includes/routeros_api.class.php');

function get_total_all_records()
{
	include('../../../db/conn.php');
	$statement = $connect->prepare("SELECT * FROM mikrotiklist");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}
$query = '';
$output = array();
$query .= "SELECT * FROM mikrotiklist ";
if(isset($_POST["search"]["value"]))
{

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
$i=1;
foreach($result as $row)
{
	
	
	$sub_array = array();
	$sub_array[] = $i;
	
	// if($row['status']=='Active')
 //                              $sub_array[] = '<td><span class="badge badge-success">Active</span></td>'; 
 //                             else 
 //                              $sub_array[] = '<td><span class="badge badge-danger">Closed</span></td>';
	
	
	$sub_array[] = $row["serverName"];
	$sub_array[] = $row["ipAddress"];
	$sub_array[] = $row["username"];

	${$row['serverName']} = new routeros_api();
			$ip = $row['ipAddress'];
			$user = $row['username'];
			$pass = $row['password'];
			if(${$row['serverName']}->connect($ip, $user, $pass)){
				$sub_array[] =  '<span class="label label-success">Online</span>';
			}else{
				$sub_array[] = '<span class="btn btn-secondary btn-sm">Offline</span>';
			}


	$sub_array[] = '

	<a>
	<i class="fa fa-edit text-green edit_data" id="'. $row["id"].'"  style="font-size:20px"></i>
	</a>
	<a>
	<i class="fa fa-trash text-red delete_router" id="'. $row["id"].'" style="font-size:20px"></i>
	</a>
	';
	
	$data[] = $sub_array;
	$i++;
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_records(),
	"data"				=>	$data
);
echo json_encode($output);
?>