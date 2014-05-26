<?php session_start();
require('pagecomponents/fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('bird.jpg',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Title
	// Cell(width,height, 'title', 1?, 0?, 'C' center-aligned); 
    $this->Cell(80,10,'Listing of Procedures / Services',1,0,'C');
    // Line break
    $this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}

// Load data
function LoadData()
{
	//Connect to database
	include ('pagecomponents/connectDB.php');
	
		//Select records
		$sql = 	'SELECT procedure_description, procedure_fee,
				medicare_rebate
				FROM procedure_listing
				ORDER BY procedure_description';
				
		$data=mysqli_query($con,$sql);
		
		if (!$data) {
			return false;
		} else {
			return $data;
		}
		include ('pagecomponents/closeConnection.php');
	
}

	// Colored table
	function FancyTable($header, $data)
	{
		
		// Colors, line width and bold font
		$this->SetFillColor(117,174,235);
		$this->SetTextColor(255);
		$this->SetDrawColor(128,0,0);	
		$this->SetLineWidth(.3);
		$this->SetFont('','B');
		
		// Header
		$w = array(80, 30, 35);
		for($i=0;$i<count($header);$i++)
			$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
		
		$this->Ln();
		
		// Color and font restoration
		$this->SetFillColor(224,235,255);
		$this->SetTextColor(0);
		$this->SetFont('');
		// Data
		$fill = false;
		$feeTotal = 0;
		$rebateTotal = 0;
		
		if ($data !== false) {
			while($row = mysqli_fetch_array($data)) {
			
				$this->Cell($w[0],6, $row['procedure_description'],'LR',0,'L',$fill);
				$this->Cell($w[1],6, '$' . number_format($row['procedure_fee'], 2),'LR',0,'R',$fill);
				$this->Cell($w[2],6, '$' . number_format($row['medicare_rebate'], 2),'LR',0,'R',$fill);
				$this->Ln();
				$fill = !$fill;
			}
		}
		// Closing line
		$this->Cell(array_sum($w),0,'','T');
	}
}

$pdf = new PDF();
$pdf->AliasNbPages();
// Column headings
$header = array('SERVICE', 'FEE', 'REBATE');

// Data loading
$data = $pdf->LoadData();
$pdf->SetFont('Arial','',12);

$pdf->AddPage();
$pdf->FancyTable($header,$data);
$pdf->Output();
?>
