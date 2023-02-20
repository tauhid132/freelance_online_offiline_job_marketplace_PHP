<?php
include('../../../db/conn.php');

function get_total_all_records()
{
	include('../../../db/conn.php');
	$statement = $connect->prepare("SELECT * FROM products");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}
$query = '';
$output = array();
$query .= "SELECT * FROM products ";
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
	$sub_array[] = $row["name"];
	$sub_array[] = $row["description"];
	$sub_array[] = $row["stock"];
	
	
	$sub_array[] = '
                            <a>
                            <i class="fa fa-plus-circle text-info remove_stock " id="'. $row["id"].'" style="font-size:20px"></i>
                            </a>
                             <a>
                            <i class="fa fa-minus-circle text-warning add_stock " id="'. $row["id"].'" style="font-size:20px"></i>
                            </a>
                            <a>
                            <i class="fa fa-edit text-green edit_cat" id="'. $row["id"].'"  style="font-size:20px"></i>
                            </a>
                            <a>
                            <i class="fa fa-trash text-red delete_cat" id="'. $row["id"].'" style="font-size:20px"></i>
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