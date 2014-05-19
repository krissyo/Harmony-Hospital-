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

			// set patient_id from session data
			$patient = $_SESSION['patient_id'];	

			//Select records
			$sql = 'SELECT patient_id,first_name, middle_name, last_name,
			address_line, postcode, date_of_birth, date_of_death, gender,
			medicare_number, medicare_expiry_date
			FROM patient_details 
			WHERE patient_id ='.$patient;

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

			// set patient_id from session data
			$patient = $_SESSION['patient_id'];

			//Select records
			$sql2 = 'SELECT carer1_name, carer1_address, carer1_phone_number, carer2_name, carer2_address, carer2_phone_number,
			address_line, postcode
			FROM patient_details 
			WHERE patient_id ='.$patient;

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
		function LoadAdmData($file)
		{
			//Connect to database
			include ('pagecomponents/connectDB.php');

			// set patient_id from session data
			$patient = $_SESSION['patient_id'];
			
	
			//Select Admission records
			$sql = 	'SELECT admission_id, admission_date, notes
			FROM admissions 
			WHERE patient_id = ' . $patient;
			
			$data=mysqli_query($con,$sql);
	
			if (!$data) {
			return 'No data to display.';
			} else {
			return $data;
			}
			include ('pagecomponents/closeConnection.php');
			}

			

		function AdmissionTable($admheader, $admdata){

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
    		$w = array(40, 40, 110);
    		$this->SetTextColor(165,165,167);
    		for($i=0; $i<count($admheader);$i++)
    			$this->Cell($w[$i],10,$admheader[$i],1,0,'C',true);    			
    		$this->Ln();


    		// Color and font restoration
    		$this->SetFillColor(224,235,255);
    		$this->SetTextColor(0);
    		$this->SetFont('');

	
    		while($row = mysqli_fetch_array($admdata)) {
	
				// Populate Data
				$notes = $row['notes'];
        		$notesLength = strlen($notes);
        		// provide for long admission notes
				if($notesLength>40){
					$x = $this->x;
					$y = $this->y;	
					$space = "\n";
					$admission_id = $row['admission_id'].$space.$space;
					$admission_date = $row['admission_date'].$space.$space;	
        			$this->MultiCell($w[0],10,$admission_id,1,'L',$fill);
        			$this->SetXY($x + $w[0], $y);
        			$this->MultiCell($w[1],10,$admission_date,1,'L',$fill);
        			$this->SetXY($x + $w[0] + $w[1], $y);        		
        			$this->MultiCell($w[2],10,$notes,1,'L',$fill);        			
        			$fill = !$fill;
        		}
        		else{
        			$this->Cell($w[0],10,$row['admission_id'],1,0,'L',$fill);
        			$this->Cell($w[1],10,$row['admission_date'],1,0,'L',$fill);
        			$this->Cell($w[2],10,$notes,1,0,'L',$fill);
        			$fill = !$fill;
        			$this->Ln();
        		}       		

        	}
        	$this->Ln();


			    		// Closing line
    					
    					$this->Ln(5);
				
    	}

    	// Load Table data
		function LoadMedData($file)
		{
			//Connect to database
			include ('pagecomponents/connectDB.php');

			
			// set patient_id from session data
			$patient = $_SESSION['patient_id'];
	
			//Select Admission records
			$sql = 	'SELECT doctors_notes, nurses_notes, current_medication, allergies, conditions,
			height, weight
			FROM medical_history 
			WHERE patient_id = ' .$patient;
			
			$data=mysqli_query($con,$sql);
	
			if (!$data) {
			return 'No data to display.';
			} else {
			return $data;
			}
			include ('pagecomponents/closeConnection.php');
			}

    	function MedicalHistoryTable($medheader, $meddata){

    		// Colors, line width and bold font
    		$this->SetFillColor(255,255,255);
    		$this->SetTextColor(135,186,214);
    		$this->SetDrawColor(165,165,167);	
    		$this->SetLineWidth(.8);
   			$this->SetFont('','B');

    		// Header Line of table
    		// Set Column Widths
    		
    		// Header
    		$this->Cell(190,10,"PATIENT MEDICAL HISTORY",1,0,'C',true);
    		$this->Ln();
    		$w = array(63.3, 63.3, 63.3);
    		$this->SetTextColor(165,165,167);
    		for($i=0; $i<count($medheader);$i++)
    			$this->Cell($w[$i],10,$medheader[$i],1,0,'C',true);    			
    		$this->Ln();


    		// Color and font restoration
    		$this->SetFillColor(224,235,255);
    		$this->SetTextColor(0);
    		$this->SetFont('');

   		
	
    		while($row = mysqli_fetch_array($meddata)) {
	
				// Populate Data
				$this->Cell($w[0],10,$row['height'],1,0,'c',false);
				$this->Cell($w[1],10,$row['weight'],1,0,'c',false);
				$this->Cell($w[2],10,$row['allergies'],1,0,'c',false);
				$this->Ln();
				$this->Cell($w[0],10,'Doctors Notes',1,0,'c',true);
				$this->Ln();
				$w2 = array(30,160);
				$notes = $row['doctors_notes'];
        		$notesLength = strlen($notes);
        		// provide for long admission notes
				if($notesLength>40){
					$this->MultiCell(190,10,$row['doctors_notes'],1,'L',$fill);
					$this->Ln();        			  			
        			$fill = !$fill;
        		}
        		else{
        			$this->Cell(190,10,$row['doctors_notes'],1,0,'L',$fill);
        			$this->Ln();
        			$fill = !$fill;
        		}
        		if($row['nurses	_notes']){
        			$this->Cell($w[0],10,'Nurses Notes',1,0,'c',true);
					$this->Ln();
        			$notes = $row['nurses_notes'];
        			$notesLength = strlen($notes);
        			// provide for long admission notes
					if($notesLength>40){
						$this->MultiCell(190,10,$row['nurses_notes'],1,'L',$fill);        			  			
        				$fill = !$fill;
        				}
        			else{
        				$this->Cell(190,10,$row['nurses_notes'],1,0,'L',$fill);
        				$fill = !$fill;
        				}
        		}            		

        	}
        	$this->Ln();


			    		// Closing line
    					//$this->Cell(array_sum($w),0,'','T');
    					//$this->Ln(10);
				
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
	$admdata = $pdf->LoadAdmData($file);
	$admheader = array('Admission Id', 'Admission Date', 'Admission Notes');	
	$pdf->AdmissionTable($admheader, $admdata);

	$meddata = $pdf->LoadMedData($file);
	$medheader = array('Height', 'Weight','Allergies');
	$pdf->MedicalHistoryTable($medheader, $meddata);
	$pdf->Output();

?>