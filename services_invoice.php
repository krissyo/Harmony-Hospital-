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
    $this->Cell(80,10,'Patient Services Invoice',1,0,'C');
    // Line break
    $this->Ln(20);
	
	// Display Patient's Full Name/Address in the header
	// establish the connection
	include ('pagecomponents/connectDB.php');

	// Testing with AdmissionId set to 1
	if (!isSet($_SESSION['AdmissionId'])) {
		$_SESSION['AdmissionId'] = 1;
	}
	
	//Select records
	$sql = "SELECT patient_details.patient_id, first_name, last_name,
			send_bill_to, billing_address
			FROM patient_details INNER JOIN admissions ON
			patient_details.patient_id = admissions.patient_id
			WHERE admission_id = " . $_SESSION['AdmissionId'] ;
	
	$result=mysqli_query($con,$sql);
	
	// Arial 10
    $this->SetFont('Arial','',10);
	
	if($result) {
		$row = mysqli_fetch_array($result);
		
		$this->Cell(100,10, $row['send_bill_to'],0,0,'L');
		$this->Ln();
		
		$fullName = 'c/o ' . $row['first_name'] . ' ' . $row['last_name'] . '(PatientId ' . $row['patient_id'] . ')';
		$this->Cell(100,10, $fullName,0,0,'L');
		$this->Ln();
		
		$this->Cell(100,10, $row['billing_address'],0,0,'L');
		$this->Ln();
		$this->Ln();
	}	
	include('pagecomponents/closeConnection.php');
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
function LoadData($file)
{
	//Connect to database
	include ('pagecomponents/connectDB.php');

	// Testing with AdmissionId set to 1
	if (!isSet($_SESSION['AdmissionId'])) {
		$_SESSION['AdmissionId'] = 1;
	}
	
	//Select records
	$sql = 	'SELECT service_start_date, service_end_date,
			procedure_description, procedure_fee, 
			medicare_rebate
			FROM patient_services 
			INNER JOIN procedure_listing
			ON patient_services.procedure_id = procedure_listing.procedure_id
			WHERE admission_id = ' . $_SESSION["AdmissionId"] . ' ORDER BY service_start_date, service_end_date';
			
	$data=mysqli_query($con,$sql);
	
	if (!$data) {
		return 'No data to display.';
	} else {
		return $data;
	}
	include ('pagecomponents/closeConnection.php');
}

// Colored table
function FancyTable($header, $data)
{
	// Special conversion used to convert 
	// date difference into days
	$CONVERSION = 86400;
	
    // Colors, line width and bold font
    $this->SetFillColor(117,174,235);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);	
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    // Header
    $w = array(40, 25, 35, 35, 20);
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
	
    while($row = mysqli_fetch_array($data)) {
	
		// Calculate days if the Service is open-dated
		if (is_null($row['service_end_date'])) {
						
			// Calculate fees as at today's date
			$row['service_end_date'] = date('Y-m-d');
		}
		
		if ($row['service_start_date'] == $row['service_end_date']) {		
			$days = 1;			
		} else {
			$days = Round(ABS(strToTime($row['service_start_date'])-strToTime($row['service_end_date']))/$CONVERSION);
		}
	
        $this->Cell($w[0],6, $row['procedure_description'],'LR',0,'L',$fill);
		$startDate = date("d/m/Y", strToTime($row['service_start_date']));
        $this->Cell($w[1],6, $startDate,'LR',0,'L',$fill);
        $this->Cell($w[2],6, '$' . number_format($row['procedure_fee'], 2),'LR',0,'R',$fill);
        $this->Cell($w[3],6, '$' . number_format($row['medicare_rebate'], 2),'LR',0,'R',$fill);
		$this->Cell($w[4],6, $days,'LR',0,'R',$fill);
        $this->Ln();
        $fill = !$fill;
		
		$feeTotal += $row['procedure_fee'] * $days;
		$rebateTotal += $row['medicare_rebate'] * $days;
    }
	
    // Closing line
    $this->Cell(array_sum($w),0,'','T');
	
	// Display the Totals
	$this->Ln(8);
	$this->Cell(120,10, 'Fees Total: $' . number_format($feeTotal, 2),0,0,'L');
	// Line break
	$this->Ln();
	
	$this->Cell(120,10, 'Rebates Total: $' . number_format($rebateTotal, 2),0,0,'L');
	$this->Ln();
	
	$gapTotal = $feeTotal - $rebateTotal;
	$this->Cell(120,10, 'Total Gap Amount Payable: $' . number_format($gapTotal, 2),0,0,'L');
	$this->Ln();
}
}

$pdf = new PDF();
$pdf->AliasNbPages();
// Column headings
$header = array('SERVICE', 'DATE', 'FEE', 'REBATE', 'DAYS');

// Data loading
$data = $pdf->LoadData($file);
$pdf->SetFont('Arial','',12);

$pdf->AddPage();
$pdf->FancyTable($header,$data);
$pdf->Output();
?>
