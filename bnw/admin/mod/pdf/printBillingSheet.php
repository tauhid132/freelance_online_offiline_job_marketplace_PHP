<?php
$area = $_POST['area'];
/*call the FPDF library*/
require('fpdf182/fpdf.php');
include('../../db/conn.php');
    
/*A4 width : 219mm*/


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
if($area=='all'){
     $sql = "SELECT * FROM users WHERE status='Active' && due>0 ORDER BY area ";
}else{
     $sql = "SELECT * FROM users WHERE status='Active' && due>0 && area='$area'";
}
if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
        
        while($row = mysqli_fetch_array($result)){
            
		$pdf->Cell(10 ,5,$row['id'],1,0,'C');
        $pdf->Cell(30 ,5,$row['area'],1,0,'C');
        $pdf->Cell(18 ,5,$row['username'],1,0,'C');
        $pdf->Cell(60 ,5,$row['cus_name'],1,0,'C');
        $pdf->Cell(60 ,5,$row['conn_address'],1,0,'C');
		$pdf->Cell(60 ,5,$row['mobile'],1,0,'C');
		$pdf->Cell(15 ,5,$row['billing_type'],1,0,'C');
		$pdf->Cell(15 ,5,$row['monthly_bill'],1,0,'C');
		if($row['due']-$row['monthly_bill']<0){
			$due=0;
		}
		else{
			$due=$row['due']-$row['monthly_bill'];
		}
        $pdf->Cell(15 ,5,$due,1,1,'C');
			
        }
      
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}
 


    
        


$pdf->Output();

?>


