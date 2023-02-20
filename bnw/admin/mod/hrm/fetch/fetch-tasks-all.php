<?php
include('../../../db/conn.php');

function get_total_all_records()
{
	include('../../../db/conn.php');
	$statement = $connect->prepare("SELECT * FROM tasks");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}
$query = '';
$output = array();
$query .= "SELECT * FROM tasks ";
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE description LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY create_time DESC ';
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
	
	if($row['status']=='Active')
                              $sub_array[] = '<td><span class="label label-success">Active</span></td>'; 
                             else 
                              $sub_array[] = '<td><span class="label label-danger">Closed</span></td>';
	$sub_array[] = '
                            <a>
                            <i class="fa fa-times text-info  close_task" id="'. $row["id"].'" style="font-size:20px"></i>
                            </a>
                            <a>
                            <i class="fa fa-edit text-success edit_data" id="'. $row["id"].'"  style="font-size:20px"></i>
                            </a>
                            <a>
                            <i class="fa fa-trash text-danger delete_task" id="'. $row["id"].'" style="font-size:20px"></i>
                            </a>
                            ';
	
	$sub_array[] = $row["description"];
	$sub_array[] = $row["create_time"];
	$sub_array[] = $row["created_by"];
	$sub_array[] = $row["assigned_person"];
	
	
	$sub_array[] = $row["finish_time"];
	
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