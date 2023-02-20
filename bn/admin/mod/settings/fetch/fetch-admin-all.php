<?php
include('../../../db/conn.php');

function get_total_all_records()
{
	include('../../../db/conn.php');
	$statement = $connect->prepare("SELECT * FROM admin");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}
$query = '';
$output = array();
$query .= "SELECT * FROM admin ";
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
	
	
	
	$sub_array[] = $row["username"];
	$sub_array[] = $row["full_name"];
	$sub_array[] = $row["email"];
	$sub_array[] = $row["role"];
	 if($row['status']==1){
                      $sub_array[] = '<input class="enableAdmin" id="'. $row["id"].'" type="checkbox"   checked="yes" >';
                    }else if($row['status']==0){
                      $sub_array[] = '<input class="enableAdmin" id="'. $row["id"].'" type="checkbox"  >';
                    }
	
	//$sub_array[] = '<input id="api_setting" type="checkbox" data-toggle="toggle" data-on="Enabled" data-off="Disabled"  checked="yes" data-size="xs">';
	$sub_array[] = '
                            
                            <a>
                            <i class="fa fa-edit text-green edit_data" id="'. $row["id"].'"  style="font-size:20px"></i>
                            </a>
                            <a>
                            <i class="fa fa-trash text-red delete_admin" id="'. $row["id"].'" style="font-size:20px"></i>
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