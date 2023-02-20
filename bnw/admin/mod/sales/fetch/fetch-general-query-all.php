<?php
include('../../../db/conn.php');

function get_total_all_records()
{
	include('../../../db/conn.php');
	$statement = $connect->prepare("SELECT * FROM generalquery");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}
$query = '';
$output = array();
$query .= "SELECT * FROM generalquery ";
if(isset($_POST["search"]["value"]))
{
	
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY id DESC ';
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
	
	if($row['status']=='0')
		$sub_array[] = '<td><span class="label label-warning">Not Confirmed</span></td>'; 
	else if($row['status']=='1') 
		$sub_array[] = '<td><span class="label label-success">Confirmed</span></td>';

	$sub_array[] = '
					<a href="view-request-status.php?id='.$row['id'].'">
					<i class="fa fa-eye text-info "  style="font-size:20px"></i>
					</a>
					<a>
					<i class="fa fa-edit text-green edit_data" id="'. $row["id"].'"  style="font-size:20px"></i>
					</a>
					<a>
					<i class="fa fa-trash text-red delete_request" id="'. $row["id"].'" style="font-size:20px"></i>
					</a>
					';
	$sub_array[] = $row["fullName"];
	$sub_array[] = $row["address"];
	$sub_array[] = $row["mobileNo"];
	$sub_array[] = $row["timestamp"];
	
	
	
	//$sub_array[] = $row["createTime"];
	$sub_array[] = $row["executive"];
	$sub_array[] = $row["comment"];
	
	
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