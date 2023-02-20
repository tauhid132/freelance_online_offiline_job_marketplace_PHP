<?php
include('../../../db/conn.php');

function get_total_all_records()
{
	include('../../../db/conn.php');
	$statement = $connect->prepare("SELECT * FROM left_client");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}
$query = '';
$output = array();
$query .= "SELECT * FROM left_client ";
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
	$sub_array[] = $row["user_id"];
	$sub_array[] = $row["cus_name"];
	$sub_array[] = $row["address"];
	$sub_array[] = $row["monthly_bill"];
	$sub_array[] = $row["left_on"];
	$sub_array[] = $row["leftReason"];
	$sub_array[] = $row["mobile"];
	$sub_array[] = '
                           
                             
                             <a>
                             <i class="fa fa-edit text-green edit_data" id="'. $row["id"].'" style="font-size:20px"></i>
                             </a>
                             <a>
                             <i class="fa fa-trash text-red delete_user" id="'. $row["id"].'" style="font-size:20px"></i>
                             </a>
                             <a>
                             <i class="fa fa-paper-plane text-blue send_sms" id="'. $row["id"].'" style="font-size:20px"></i>
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