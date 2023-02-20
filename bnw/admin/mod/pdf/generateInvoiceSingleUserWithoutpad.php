<?php
/*call the FPDF library*/
require('fpdf182/fpdf.php');
include('../../db/conn.php');
$id=$_GET['id'];
$query=mysqli_query($conn,"select * from `users` where id='$id'");
$result=mysqli_fetch_array($query);


//IN WORDS START


function convert_number($number) 
{ 
    $my_number = $number;

    if (($number < 0) || ($number > 999999999)) 
    { 
        throw new Exception("Number is out of range");
    } 
    $Kt = floor($number / 10000000); /* Koti */
    $number -= $Kt * 10000000;
    $Gn = floor($number / 100000);  /* lakh  */ 
    $number -= $Gn * 100000; 
    $kn = floor($number / 1000);     /* Thousands (kilo) */ 
    $number -= $kn * 1000; 
    $Hn = floor($number / 100);      /* Hundreds (hecto) */ 
    $number -= $Hn * 100; 
    $Dn = floor($number / 10);       /* Tens (deca) */ 
    $n = $number % 10;               /* Ones */ 

    $res = ""; 

    if ($Kt) 
    { 
        $res .= convert_number($Kt) . " Koti "; 
    } 
    if ($Gn) 
    { 
        $res .= convert_number($Gn) . " Lakh"; 
    } 

    if ($kn) 
    { 
        $res .= (empty($res) ? "" : " ") . 
        convert_number($kn) . " Thousand"; 
    } 

    if ($Hn) 
    { 
        $res .= (empty($res) ? "" : " ") . 
        convert_number($Hn) . " Hundred"; 
    } 

    $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", 
        "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", 
        "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", 
        "Nineteen"); 
    $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", 
        "Seventy", "Eigthy", "Ninety"); 

    if ($Dn || $n) 
    { 
        if (!empty($res)) 
        { 
            $res .= " and "; 
        } 

        if ($Dn < 2) 
        { 
            $res .= $ones[$Dn * 10 + $n]; 
        } 
        else 
        { 
            $res .= $tens[$Dn]; 

            if ($n) 
            { 
                $res .= "-" . $ones[$n]; 
            } 
        } 
    } 

    if (empty($res)) 
    { 
        $res = "zero"; 
    } 

    return $res; 


} 




//END WORD END






/*A4 width : 219mm*/

$pdf = new FPDF('P','mm','A4');

$pdf->AddPage();
/*output the result*/

/*set font to arial, bold, 14pt*/
$pdf->SetFont('Arial','B',20);

/*Cell(width , height , text , border , end line , [align] )*/

$pdf->SetFont('Arial','B',20);
$pdf->Cell(71 ,10,'',0,0);
$pdf->Cell(59 ,80,'INVOICE',0,0,'C');
$pdf->Cell(59 ,40,'',0,1);

$pdf->Cell(50 ,20,'',0,1);


$pdf->SetFont('Arial','',10);
/*Heading Of the table*/
$pdf->SetFont('Arial','B',10);
$pdf->Cell(30 ,6,'Customer Name',1,0,'C');
$pdf->SetFont('Arial','',10);
$pdf->Cell(60 ,6,$result['cus_name'],1,0,'C');
$pdf->Cell(23 ,6,'',0,0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(30 ,6,'Invoice No',1,0,'C');
$username=$result['username'];
$invYear=date("MY");
$invoice_no="INV-$username-$invYear";
$pdf->SetFont('Arial','',10);
$pdf->Cell(45 ,6,$invoice_no,1,1,'C');/*end of line*/
/*Heading Of the table end*/
$pdf->SetFont('Arial','B',10);

$pdf->Cell(30 ,6,'User ID',1,0,'C');
$pdf->SetFont('Arial','',10);
$pdf->Cell(60 ,6,$result['username'],1,0,'C');
$pdf->Cell(23 ,6,'',0,0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(30 ,6,'Invoice Date',1,0,'C');
$pdf->SetFont('Arial','',10);
$pdf->Cell(45 ,6,date("d-m-y"),1,1,'C');

$pdf->SetFont('Arial','B',10);
$pdf->Cell(30 ,14,'Billing Address',1,0,'C');
$pdf->SetFont('Arial','',10);
$pdf->Cell(60 ,14,$result['conn_address'],1,0,'C');
$pdf->Cell(23 ,6,'',0,0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(30 ,6,'Billing Month',1,0,'C');
$billing_type=$result['billing_type'];
if($billing_type=='PrePaid' || $billing_type=='Prepaid'){
 $billing_month=date("F-Y");
}else{
 $billing_month=date('F-Y', strtotime("-1 Months"));
}
$pdf->SetFont('Arial','',10);
$pdf->Cell(45 ,6,$billing_month,1,1,'C');

$pdf->Cell(30 ,12,'',0,0,'C');
$pdf->Cell(60 ,12,'',0,0,'C');
$pdf->Cell(23 ,6,'',0,0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(30 ,6,'Billing Cycle',1,0,'C');
$pdf->SetFont('Arial','',10);
$pdf->Cell(45 ,6,$result['billing_type'],1,1,'C');













$pdf->Cell(50 ,10,'',0,1);
$pdf->Cell(50 ,10,'',0,1);

$pdf->SetFont('Arial','B',11);
/*Heading Of the table*/
$pdf->Cell(10 ,6,'No',1,0,'C');
$pdf->Cell(80 ,6,'Description',1,0,'C');
$pdf->Cell(23 ,6,'Unit',1,0,'C');
$pdf->Cell(30 ,6,'Amount (Tk.)',1,0,'C');
$pdf->Cell(20 ,6,'VAT(5%)',1,0,'C');
$pdf->Cell(25 ,6,'Total (Tk.)',1,1,'C');/*end of line*/
/*Heading Of the table end*/
$pdf->SetFont('Arial','',11);

$pdf->Cell(10 ,15,'1',1,0,'C');
$pdf->Cell(80 ,15,"Monthly Internet Bill of $billing_month",1,0);
$pdf->Cell(23 ,15,'',1,0,'C');
$pdf->Cell(30 ,15,$result['monthly_bill'],1,0,'C');
$pdf->Cell(20 ,15,'Nill',1,0,'C');
$pdf->Cell(25 ,15,$result['monthly_bill'],1,1,'C');

$dueCheck=$result['due']- $result['monthly_bill'];
if($dueCheck>0){
  $pdf->Cell(10 ,15,'2',1,0,'C');
  $pdf->Cell(80 ,15,"Due Bill",1,0);
  $pdf->Cell(23 ,15,'',1,0,'C');
  $pdf->Cell(30 ,15,$result['due']-$result['monthly_bill'],1,0,'C');
  $pdf->Cell(20 ,15,'Nill',1,0,'C');
  $pdf->Cell(25 ,15,$result['due']-$result['monthly_bill'],1,1,'C');
}


$pdf->SetFont('Arial','B',11);
$pdf->Cell(118 ,6,'',0,0);
$pdf->Cell(20 ,6,'',0,0);
$pdf->Cell(25 ,6,'Total Payable Amount: ',0,0,'R');
$pdf->Cell(25 ,6,$result['due'],1,1,'C');

$pdf->Cell(50 ,10,'',0,1,'C');
$pdf->SetFont('Arial','B',11);
$abir=$result['due'];
$number=$abir;
$inwords= convert_number($number);
$pdf->Cell(130 ,5,"In Words: $inwords taka only",0,0);




$pdf->Cell(50 ,50,'',0,1,'C');

$pdf->SetFont('Arial','',12);
$pdf->Cell(40 ,0,'',0,1);
$pdf->Cell(40 ,0,'',1,1);
$pdf->Cell(80 ,10,'Authorized Signature',0,0);
$pdf->Cell(59 ,5,'',0,1);
//$pdf->SetFont('Arial','',12);
//$pdf->Cell(80 ,5,'Accounts Signature',0,1);

$pdf->Cell(50 ,10,'',0,0);
$pdf->Cell(50 ,10,'',0,0);
$pdf->Cell(50 ,10,'',0,0);






$pdf->Output();

?>


