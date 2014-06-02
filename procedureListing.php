<?php session_start();
require('pagecomponents/fpdf.php');

class PDF extends FPDF
{
//page header
		function Header(){
			// LOGO Image
			$this->Image('http://trustinblack.com/harmonyhospital/images/PdfImages/Harmony_Logo_Header_Logo.png',10,6,55,26);
			
			//--------Document Title

			// Set Document Title Font
			$this->SetTextColor(165,165,167);
			$this->SetFont('Helvetica','B',20);

			//Move to the right
			$this->Cell(95);

			//Title
			$this->MultiCell(88,8,'HOSPITAL PROCEDURE LISTING',0,'C');

			//Line Break
			$this->Ln(2);

			

			////--------Document Date

			// Set Text Colour
			$this->SetTextColor(165,165,167);
			
			//Move to the right
			$this->Cell(100);

			//get current date
			$currentDate = new DateTime();
			$currentDate = $currentDate->format('d-m-Y');

			//output Report Date
			$this->SetTextColor(135,186,214);
			$this->SetFont('Helvetica','B',12);
			$this->Cell(88,8,"REPORT DATE ".$currentDate,0,2,'C');
			$this->Ln(2);
			$this->SetTextColor(165,165,167);
			$months = array(JANUARY, FEBRUARY, MARCH, APRIL, MAY, JUNE, JULY, AUGUST, SEPTEMBER, OCTOBER, NOVEMBER, DECEMBER);
			$this->Ln(2);
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
		$this->setX(35);
		for($i=0;$i<count($header);$i++)
			$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
		
		$this->Ln();
		
		// Color and font restoration
		$this->SetFillColor(224,235,255);
		$this->SetTextColor(0);
		$this->SetFont('');
		$this->setX(35);
		// Data
		$fill = false;
		$feeTotal = 0;
		$rebateTotal = 0;
		
		if ($data !== false) {
			while($row = mysqli_fetch_array($data)) {
				$this->setX(35);
				$this->Cell($w[0],6, $row['procedure_description'],'LR',0,'L',$fill);
				$this->Cell($w[1],6, '$' . number_format($row['procedure_fee'], 2),'LR',0,'R',$fill);
				$this->Cell($w[2],6, '$' . number_format($row['medicare_rebate'], 2),'LR',0,'R',$fill);
				$this->Ln();
				$fill = !$fill;
			}
		}
		// Closing line
		$this->setX(35);
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
