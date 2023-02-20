<?php
include('../../../db/conn.php');
$i=1;
$month = $_POST['month'];
function get_total_all_records()
{
	include('../../../db/conn.php');
	$month = $_POST['month'];
	$statement = $connect->prepare("SELECT * FROM billing WHERE (billing_month='$month') ");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}
$query = '';
$output = array();

$query .= "SELECT * FROM billing WHERE billing_month='$month'  ";


if(isset($_POST["search"]["value"]))
{
	
	$query .= 'AND (user_id LIKE "%'.$_POST["search"]["value"].'%" ' ;
	$query .= 'OR cus_name LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR monthly_bill LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR pre_due LIKE "%'.$_POST["search"]["value"].'%" )';
	
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	
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

foreach($result as $row)
{
	
	



	$sub_array = array();
	$sub_array[] = $i;
	if(($row['paid_bill']==$row['monthly_bill']) && ($row['paid_due']==$row['pre_due'])){
		$sub_array[] = '<span class="label label-success">'.$row['user_id'].'</span>';
	}else if(($row['paid_bill']==0) && ($row['paid_due']==0)){
		$sub_array[] = '<span class="label label-danger">'.$row['user_id'].'</span>'; 
	}else {
		$sub_array[] = '<span class="label label-warning">'.$row['user_id'].'</span>';
	}
	$sub_array[] = $row["cus_name"];
	$sub_array[] = $row["monthly_bill"];
	$sub_array[] = $row["pre_due"];
	$sub_array[] = $row["paid_bill"];
	$sub_array[] = $row["paid_due"];
	$sub_array[] = $row["comment"];
	
	//$sub_array[] = '<input type="text"  name="paid_bill" id="paid_bill">';
	$sub_array[] = '<a>
                <i class="fa fa-money text-green edit_data" id="'. $row["id"].'" style="font-size:20px"></i>
                </a>
                <a class="send_reminder" id="'. $row["id"].'" >
                <i class="fa fa-send text-info" style="font-size:20px"></i>
                </a>
                <a>
                <i class="fa fa-edit  text-green edit_bill" id="'. $row["id"].'"  style="font-size:20px"></i>
                </a>
                <a>
                <i class="fa fa-trash delete_bill text-red" id="'. $row["id"].'"  style="font-size:20px"></i>
                </a>
                <a>
                <i class="fa fa-history f-w-600 f-16 text-yellow view_data" id="'. $row["id"].'"  style="font-size:20px"></i>
                <i class="fa fa-comments-o f-w-600 f-16 text-red add_comment" id="'. $row["id"].'"  style="font-size:20px"></i>
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