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

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('logo.png',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',25);
    $this->SetTextColor(51, 153, 255);
    $this->Cell(190 ,10,'ATS Technology',0,0,'R');
    $this->SetFont('Arial','I',12);
    $this->SetTextColor(0, 0, 0);
    $this->Line(10,28,200,28);
    $this->Cell(0 ,25,'Connecting with Confidence',0,0,'R');

    // Move to the right
    $this->Ln(35);
    $this->Cell(80);
    // Title
    $this->SetFont('Arial','B',15);
    $this->Cell(50,10,'Billing Statement',1,0,'C');
    // Line break
    $this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    
    $this->Line(10,283,200,283);
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','',11);
    // Page number
    $this->Cell(0,10,'Head Office: House-465 (3rd Floor), Road-31, Mohakhali DOHS Dhaka 1206',0,0,'C');
    $this->Ln(5);
    $this->Cell(0,10,'Mobile: 01700833725-26; Email: info@atsbd.net; Website: atsbd.net',0,0,'C');
}
}




/*A4 width : 219mm*/

$pdf = new PDF('P','mm','A4');

$pdf->AddPage();
/*output the result*/

/*set font to arial, bold, 14pt*/
$pdf->SetFont('Arial','B',20);

/*Cell(width , height , text , border , end line , [align] )*/




$pdf->SetFont('Arial','B',11);
$pdf->Cell(50 ,5,"Subscriber Name:",0,0);
$pdf->SetFont('Arial','',11);
$pdf->Cell(130 ,5,$result['cus_name'],0,0);
$pdf->Cell(40 ,8,'',0,1);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(50 ,5,"User ID / Subscriber ID:",0,0);
$pdf->SetFont('Arial','',11);
$pdf->Cell(130 ,5,$result['username'],0,0);













$pdf->Cell(50 ,10,'',0,1);
$pdf->Cell(50 ,10,'',0,1);

$pdf->SetFont('Arial','B',11);
/*Heading Of the table*/
$pdf->Cell(10 ,6,'No',1,0,'C');
$pdf->Cell(30 ,6,'Billing Month',1,0,'C');
$pdf->Cell(30 ,6,'Monthly Bill',1,0,'C');
$pdf->Cell(30 ,6,'Previous Due',1,0,'C');
$pdf->Cell(20 ,6,'Total Bill',1,0,'C');
$pdf->Cell(20 ,6,'Paid',1,0,'C');
$pdf->Cell(23 ,6,'Date',1,0,'C');
$pdf->Cell(25 ,6,'Current Due',1,1,'C');
/*end of line*/
/*Heading Of the table end*/
$pdf->SetFont('Arial','',11);

$i=1;         
$user_id= $result['username'];
$sql = "SELECT * FROM billing WHERE user_id = '$user_id'";
if($result3 = mysqli_query($conn, $sql)){
  if(mysqli_num_rows($result3) > 0){


    while($row = mysqli_fetch_array($result3)){
        $pdf->Cell(10 ,6,$i,1,0,'C');
        $pdf->Cell(30 ,6,$row['billing_month'],1,0,'C');
        $pdf->Cell(30 ,6,$row['monthly_bill'],1,0,'C');
        $pdf->Cell(30 ,6,$row['pre_due'],1,0,'C');
        $totalBill = $row['pre_due']+$row['monthly_bill'];
        $pdf->Cell(20 ,6,$totalBill,1,0,'C');
        $totalPaid = $row['paid_bill']+$row['paid_due'];
        $pdf->Cell(20 ,6,$totalPaid,1,0,'C');
        $pdf->Cell(23 ,6,$row['pay_date'],1,0,'C');
        $currentDue = $totalBill - $totalPaid;
        $pdf->Cell(25 ,6,$currentDue,1,1,'C');

        $i++;

    }

        // Free result set
    mysqli_free_result($result3);
} else{
    echo "No Billing History available.";
}
} else{
  echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}






// $pdf->SetFont('Arial','B',11);
// $pdf->Cell(118 ,6,'',0,0);
// $pdf->Cell(20 ,6,'',0,0);
// $pdf->Cell(25 ,6,'Total Payable Amount: ',0,0,'R');
// $pdf->Cell(25 ,6,$result['due'],1,1,'C');

// $pdf->Cell(50 ,10,'',0,1,'C');
// $pdf->SetFont('Arial','B',11);
// $abir=$result['due'];
// $number=$abir;
// $inwords= convert_number($number);
// $pdf->Cell(130 ,5,"In Words: $inwords taka only",0,0);




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


