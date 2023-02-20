<?php
include('../../../db/conn.php');

function get_total_all_records()
{
	include('../../../db/conn.php');
	$statement = $connect->prepare("SELECT * FROM employee");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}
$query = '';
$output = array();
$query .= "SELECT * FROM employee ";
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE fullName LIKE "%'.$_POST["search"]["value"].'%" ';
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
	$sub_array[] = $row["fullName"];
	$sub_array[] = $row["username"];
	$sub_array[] = $row["role"];
	$sub_array[] = $row["salary"];
	$sub_array[] = $row["account"];
	
	$sub_array[] = '
                            <a href="viewEmployee.php?id=' . $row['id'] . '">
                             <i class="fa fa-eye text-info" style="font-size:20px"></i>
                             </a>
                             <a>
                             <i class="fa fa-edit text-success edit_emp" id=' . $row['id'] . ' style="font-size:20px"></i>
                             </a>
                             <a class="delete_emp" id=' . $row['id'] . ' >
                             <i class="fa fa-trash text-danger " style="font-size:20px"></i>
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