<?php
/*call the FPDF library*/
require('fpdf182/fpdf.php');
include('../../db/conn.php');
$month= date('F-Y');   
/*A4 width : 219mm*/


$unpaidUsersList = array();
$unpaidUsersListFinal = array();

$sql = "SELECT * FROM billing WHERE billing_month = '$month' && paid_bill=0 && paid_due=0";
if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $unpaidUsersList[] = $row;
        }
    }
}
foreach($unpaidUsersList as $unpaidU){
    $selected_user = $unpaidU['user_id'];
    $sql2 = "SELECT * FROM users WHERE username = '$selected_user' ";
    if($result2 = mysqli_query($conn, $sql2)){
        if(mysqli_num_rows($result2) > 0){
            while($row2 = mysqli_fetch_array($result2)){
                $unpaidUsersListFinal[] = $row2;
            }
        }
    }
}

function val_sort($array,$key) {
    
    //Loop through and get the values of our specified key
    foreach($array as $k=>$v) {
        $b[] = strtolower($v[$key]);
    }
    
   
    
    asort($b);
    
    
    
    foreach($b as $k=>$v) {
        $c[] = $array[$k];
    }
    
    return $c;
}

$sorted = val_sort($unpaidUsersListFinal, 'area');

$pdf = new FPDF('P','mm','A4');

$pdf->AddPage('2');
/*output the result*/

/*set font to arial, bold, 14pt*/
$pdf->SetFont('Arial','B',20);

/*Cell(width , height , text , border , end line , [align] )*/







$pdf->SetFont('Arial','B',10);
/*Heading Of the table*/
$pdf->Cell(10 ,6,'No',1,0,'C');
$pdf->Cell(30 ,6,'Area',1,0,'C');
$pdf->Cell(18 ,6,'User-ID',1,0,'C');
$pdf->Cell(60 ,6,'Customer Name',1,0,'C');
$pdf->Cell(60 ,6,'Address',1,0,'C');
$pdf->Cell(60 ,6,'Mobile',1,0,'C');
$pdf->Cell(15 ,6,'B.Cycle',1,0,'C');
$pdf->Cell(15 ,6,'M.Bill',1,0,'C');
$pdf->Cell(15 ,6,'D.Bill',1,1,'C');/*end of line*/
/*Heading Of the table end*/
$pdf->SetFont('Arial','',10);

// $sql = "SELECT * FROM billing WHERE billing_month = '$month' && paid_bill=0 && paid_due=0";
// if($result = mysqli_query($conn, $sql)){
//     if(mysqli_num_rows($result) > 0){

//         while($row = mysqli_fetch_array($result)){
//             $userid2=$row['user_id'];

//             //$sql2="SELECT * FROM users WHERE status='active' ORDER BY area"
//             $query=mysqli_query($conn,"SELECT * FROM users WHERE username='$userid2' ORDER BY area DESC");
//             $result2=mysqli_fetch_array($query);
            
//             $pdf->Cell(10 ,5,$result2['id'],1,0,'C');
//             $pdf->Cell(30 ,5,$result2['area'],1,0,'C');
//             $pdf->Cell(18 ,5,$result2['username'],1,0,'C');
//             $pdf->Cell(60 ,5,$result2['cus_name'],1,0,'C');
//             $pdf->Cell(60 ,5,$result2['conn_address'],1,0,'C');
//             $pdf->Cell(60 ,5,$result2['mobile'],1,0,'C');
//             $pdf->Cell(15 ,5,$result2['billing_type'],1,0,'C');
//             $pdf->Cell(15 ,5,$result2['monthly_bill'],1,0,'C');
//             if($result2['due']-$result2['monthly_bill']<0){
//                 $due=0;
//             }
//             else{
//                 $due=$result2['due']-$result2['monthly_bill'];
//             }
//             $pdf->Cell(15 ,5,$due,1,1,'C');
            
//         }

        

//         // Free result set
//         mysqli_free_result($result);
//     } else{
//         echo "No records matching your query were found.";
//     }
// } 
foreach($sorted as $userFinal){
    $pdf->Cell(10 ,5,$userFinal['id'],1,0,'C');
    $pdf->Cell(30 ,5,$userFinal['area'],1,0,'C');
    $pdf->Cell(18 ,5,$userFinal['username'],1,0,'C');
    $pdf->Cell(60 ,5,$userFinal['cus_name'],1,0,'C');
    $pdf->Cell(60 ,5,$userFinal['conn_address'],1,0,'C');
    $pdf->Cell(60 ,5,$userFinal['mobile'],1,0,'C');
    $pdf->Cell(15 ,5,$userFinal['billing_type'],1,0,'C');
    $pdf->Cell(15 ,5,$userFinal['monthly_bill'],1,0,'C');
    if($userFinal['due']-$userFinal['monthly_bill']<0){
        $due=0;
    }
    else{
        $due=$userFinal['due']-$userFinal['monthly_bill'];
    }
    $pdf->Cell(15 ,5,$due,1,1,'C');
}






$pdf->Output();

?>


