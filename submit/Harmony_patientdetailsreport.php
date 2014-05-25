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
			$this->SetFont('Helvetica','B',20);

			//Move to the right
			$this->Cell(95);

			//Title
			$this->Cell(88,8,'PATIENT DETAILS REPORT',0,2,'L');

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
		}

		
		function PatientDetails(){

			//Connect to database
			include ('pagecomponents/connectDB.php');

			if (!isSet($_SESSION['AdmissionId'])) {
			$_SESSION['AdmissionId'] = 1;
			}	

			//Select records
			$sql = 'SELECT patient_id,first_name, middle_name, last_name,
			address_line, postcode, date_of_birth, date_of_death, gender,
			medicare_number, medicare_expiry_date
			FROM patient_details 
			WHERE patient_id = 3';

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
				$patientId = "PATIENT ID: ".$row['patient_id'];
				$space = "\n";
				$patientName = $row['first_name']." ".$row['middle_name']." ".$row['last_name'];
				$DOB= "DOB:".$row['date_of_birth'];
				if($row['date_of_death']){
					$DOD = " DOD:".$row['date_of_death'];
				}
				$addressLn1 = $row['address_line']." ".$row['postcode'];
				$medicareNumber = "Medicare number: ".$row['medicare_number'];
				$medicareExp = "Medicare Expiry Date: ".$row['medicare_expiry_date'];
				$patientDetails = $patientId.$space.$patientName.$space.$addressLn1.$space.$DOB.$DOD.
				$space.$medicareNumber.$space.$medicareExp;	

				//Create details border Box and input patient details
				$this->SetFont('Helvetica','',12);
				$this->SetLineWidth(1);
				$this->SetDrawColor(135,186,214);			
				$this->MultiCell(88,7,$patientDetails,1,'L');			
			}						
			include('pagecomponents/closeConnection.php');
			//$this->Ln(10);
		}

		function CarerDetails(){

			//Connect to database
			include ('pagecomponents/connectDB.php');

			if (!isSet($_SESSION['AdmissionId'])) {
			$_SESSION['AdmissionId'] = 1;
			}	

			//Select records
			$sql2 = 'SELECT carer1_name, carer1_address, carer1_phone_number, carer2_name, carer2_address, carer2_phone_number,
			address_line, postcode
			FROM patient_details 
			WHERE patient_id = 1';

			$result=mysqli_query($con,$sql2);
			
			//Set the draw Text colour to black
			$this->SetTextColor(0,0,0);


			// carer details Variables Set
			if($result){
				$row = mysqli_fetch_array($result);
				$space = "\n";
				$carerName = "CARER 1: ".$row['carer1_name'];
				$carerPhone= "PH: ".$row['carer1_phone_number'];
				$address1 = $row['carer1_address']." ";
				$carer2Name = "CARER 2: ".$row['carer2_name'];
				$carer2Phone = "PH: ".$row['carer2_phone_number'];
				$address2 = $row['carer2_address']." ";
				$patientDetails = $carerName.$space.$carerPhone.$space.$address1.$space.
				$carer2Name.$space.$carer2Phone.$space.$address2;	

				//Create details border Box and input patient details
				$this->SetFont('Helvetica','',12);
				$this->SetLineWidth(1);
				$this->SetDrawColor(165,165,167);			
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
			if (!isSet($_SESSION['PatientId'])) {
			$_SESSION['PatientId'] = 1;
			}
	
			//Select Admission records
			$sql = 	'SELECT admission_id, admission_date, notes
			FROM admissions 
			WHERE patient_id = ' . $_SESSION["PatientId"];
			
			$data=mysqli_query($con,$sql);
	
			if (!$data) {
			return 'No data to display.';
			} else {
			return $data;
			}
			include ('pagecomponents/closeConnection.php');
			}

			

		function invoiceTable($header, $data){
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
    		
    		// Header
    		$this->Cell(190,10,"PATIENT ADMISSIONS HISTORY",1,0,'C',true);
    		$this->Ln();
    		$w = array(40, 40, 111);
    		for($i=0; $i<count($header);$i++)
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
	
				// Populate Data
        		$this->Cell($w[0],10, $row['admission_id'],1,0,'L',$fill);
        		$admDate = $row['admission_date'];
        		$this->Cell($w[1],10,$admDate,1,0,'L',$fill);
        		$this->MultiCell($w[2],10, '$'.$row['notes'],1,0,'R',$fill);
        		$this->Ln();
        		$fill = !$fill;
			
				// Variables to calculate total Cost
				$feeTotal += $row['procedure_fee'] * $days;
				$rebateTotal += $row['medicare_rebate'] * $days;
    			}
	
    		// Closing line
    		$this->Cell(array_sum($w),0,'','T');
    		$this->Ln(10);

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
	$pdf->SetXY(113,38);
	$pdf->CarerDetails();
	$pdf->SetXY(10,90);
	$data = $pdf->LoadData($file);
	$header = array('Admission Id', 'Admission Date', 'Admission Notes');
	$pdf->invoiceTable($header, $data, $totalsHeader);
	$pdf->Output();

?>