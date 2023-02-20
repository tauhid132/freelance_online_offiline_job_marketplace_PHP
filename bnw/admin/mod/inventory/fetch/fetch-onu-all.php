<?php
include('../../../db/conn.php');

function get_total_all_records()
{
	include('../../../db/conn.php');
	$statement = $connect->prepare("SELECT * FROM equipments");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}
$query = '';
$output = array();
$query .= "SELECT * FROM equipments ";
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE mac LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR vendor LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR status LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR sl_no LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY status ASC ';
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
	$sub_array[] = $row["equip_type"];
	$sub_array[] = $row["sl_no"];
	$sub_array[] = $row["mac"];
	$sub_array[] = $row["vendor"];
	if($row['status']=='Used')
		$sub_array[] = '<span class="label label-warning">Used</span>'; 
	else if ($row['status']=='Unused')
		$sub_array[] = '<span class="label label-success">Unused</span>';
	else if ($row['status']=='Damaged')
		$sub_array[] = '<span class="label label-danger">Damaged</span>';
	$sub_array[] = $row["used_in"];
	
	$sub_array[] = '
					<i class="fa fa-edit text-info edit_data" id="'. $row["id"].'" style="font-size:20px"></i>
					</a>

					<a>
					<i class="fa fa-trash text-red delete_equip " id="'. $row["id"].'"  style="font-size:20px"></i>
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