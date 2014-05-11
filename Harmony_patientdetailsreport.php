<?php
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
			$this->SetFont('Helvetica','B',28);

			//Move to the right
			$this->Cell(110);

			//Title
			$this->Cell(88,8,'INVOICE',0,2,'C');

			//Line Break
			$this->Ln(2);

			////--------Document Number

			// Set Border Colour
			$this->SetDrawColor(165,165,167);

			// Set Text Colour
			$this->SetTextColor(135,186,214);

			//Move to the right
			$this->Cell(100);
			$this->SetFont('Helvetica','B',15);
			$this->SetLineWidth(1);
			$this->Cell(88,8,'INVOICE NUMBER',1,2,'C');

			//Line Break
			$this->Ln(0);

			////--------Document Date

			// Set Text Colour
			$this->SetTextColor(165,165,167);
			
			//Move to the right
			$this->Cell(110);

			//get current date
			$currentDate = new DateTime();
			$currentDate = $currentDate->format('d-m-Y');

			//output Date
			$this->SetFont('Helvetica','B',12);
			$this->Cell(88,8,$currentDate,0,2,'C');
			$this->Ln(2);
		}

		
		function PatientDetails(){

			//Connect to database
			include ('pagecomponents/connectDB.php');

			if (!isSet($_SESSION['AdmissionId'])) {
			$_SESSION['AdmissionId'] = 1;
			}	

			//Select records
			$sql = 'SELECT patient_id,first_name, middle_name, last_name,
			address_line, postcode
			FROM patient_details 
			WHERE patient_id = 1';

			$result=mysqli_query($con,$sql);
			

			// Set Title Font
			$this->SetTextColor(165,165,167);
			$this->SetFont('Helvetica','B',12);

			//Shift to the right 10mm
			//$this->Cell(0);

			//Title
			$this->Cell(88,8,$row,0,2,'L');

			//Set the draw Text colour to black
			$this->SetTextColor(0,0,0);


			// Patient details Variables Set
			if($result){
				$row = mysqli_fetch_array($result);
				$patientId = "Patient Id:".$row['patient_id'];
				$space = "\n";
				$patientName = $row['first_name']." ".$row['middle_name']." ".$row['last_name'];
				$addressLn1 = $row['address_line']." ".$row['postcode'];
				$patientDetails = $patientId.$space.$patientName.$space.$addressLn1;	

				//Create details border Box and input patient details
				$this->SetFont('Helvetica','',12);
				$this->SetLineWidth(1);
				$this->SetDrawColor(135,186,214);			
				$this->MultiCell(88,7,$patientDetails,1,'L');			
			}						
			include('pagecomponents/closeConnection.php');
			$this->Ln(10);
		}

		// Load Table data
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

			

		function invoiceTable($header, $data, $totalsHeader){
			// Special conversion used to convert 
			// date difference into days
			$CONVERSION = 86400;
	
    		// Colors, line width and bold font
    		$this->SetFillColor(255,255,255);
    		$this->SetTextColor(135,186,214);
    		$this->SetDrawColor(165,165,167);	
    		$this->SetLineWidth(.8);
   			$this->SetFont('','B');

    		// Header Line of table
    		// Set Column Widths
    		$w = array(47, 32, 42, 42, 27);
    		// Header
    		for($i=0;$i<count($header);$i++)
        	$this->Cell($w[$i],10,$header[$i],1,0,'C',true);
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
			
				// Populate Data
        		$this->Cell($w[0],10, $row['procedure_description'],'LR',0,'L',$fill);
				$startDate = date("d/m/Y", strToTime($row['service_start_date']));
       	 		$this->Cell($w[1],10, $startDate,'LR',0,'L',$fill);
        		$this->Cell($w[2],10, '$' . number_format($row['procedure_fee'], 2),'LR',0,'R',$fill);
        		$this->Cell($w[3],10, '$' . number_format($row['medicare_rebate'], 2),'LR',0,'R',$fill);
				$this->Cell($w[4],10, $days,'LR',0,'R',$fill);
        		$this->Ln();
        		$fill = !$fill;
			
				// Variables to calculate total Cost
				$feeTotal += $row['procedure_fee'] * $days;
				$rebateTotal += $row['medicare_rebate'] * $days;
    			}
	
    		// Closing line
    		$this->Cell(array_sum($w),0,'','T');
    		$this->Ln(10);

    		// Colors, line width and bold font
    		$this->SetFillColor(255,255,255);
    		$this->SetTextColor(135,186,214);
    		$this->SetDrawColor(165,165,167);	
    		$this->SetLineWidth(.8);
   			$this->SetFont('','B',12);

   			// Header Line of table
    		// Set Column Widths
    		$w2 = array(53.3,53.3,83.3);
    		// Header
    		for($i=0;$i<count($totalsHeader);$i++)
        	$this->Cell($w2[$i],10,$totalsHeader[$i],1,0,'C',true);
    		$this->Ln();

    		$this->SetTextColor(0,0,0);

			// Display the Totals
			$this->SetFont('','');
			$this->Cell($w2[0],10,'$'.number_format($feeTotal, 2),1,0,'C');
			$this->Cell($w2[1],10,'$'.number_format($rebateTotal, 2),1,0,'C');
			// Calculate Gap Total
			$this->SetFont('','B');
			$gapTotal = $feeTotal - $rebateTotal;
			$this->Cell($w2[2],10,'$'.number_format($gapTotal, 2),1,0,'C');
			$this->Ln();
	
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

		
	}

	$pdf=new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->PatientDetails();
	$data = $pdf->LoadData($file);
	$header = array('SERVICE', 'DATE', 'FEE', 'REBATE', 'DAYS');
	$totalsHeader = array('TOTAL FEES','TOTAL REBATE','TOTAL GAP AMOUNT PAYABLE');
	$pdf->invoiceTable($header, $data, $totalsHeader);
	$pdf->Output();

?>