<?php
include('../../../db/conn.php');

function get_total_all_records()
{
	include('../../../db/conn.php');
	$statement = $connect->prepare("SELECT * FROM tickets");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}
$query = '';
$output = array();
$query .= "SELECT * FROM tickets ";
if(isset($_POST["search"]["value"]))
{
	
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
	$sub_array[] = $row["id"];
	
	if($row['status']=='0')
                              $sub_array[] = '<td><span class="label label-danger">Pending</span></td>'; 
                             else if($row['status']=='1')
                              $sub_array[] = '<td><span class="label label-warning">Processing</span></td>';
                          else if($row['status']=='2')
                              $sub_array[] = '<td><span class="label label-success">Closed</span></td>';
	$sub_array[] = '
                            <a href="track-ticket.php?id='.$row["id"].'">
                            <i class="fa fa-external-link text-info " style="font-size:20px"></i>
                            </a>
                            <a>
                            <i class="fa fa-edit text-green edit_data" id="'. $row["id"].'"  style="font-size:20px"></i>
                            </a>
                            <a>
                            <i class="fa fa-trash text-red delete_ticket" id="'. $row["id"].'" style="font-size:20px"></i>
                            </a>
                            ';
	$sub_array[] = $row["user_id"];
	$sub_array[] = $row["ticket_type"];
	$sub_array[] = $row["ticket_details"];
	$sub_array[] = $row["create_time"];
	
	
	
	$sub_array[] = $row["close_date"];
	//$sub_array[] = $row["review"];
	
	
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