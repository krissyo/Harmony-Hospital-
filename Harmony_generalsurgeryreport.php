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
			$this->MultiCell(88,8,'GENERAL SURGERY MONTHLY REPORT',0,'C');

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

		// Load Table data
		function LoadData($file)
		{
			//Connect to database
			include ('pagecomponents/connectDB.php');

			// Testing with AdmissionId set to 1
			if (!isSet($_SESSION['DepartmenttId'])) {
			$_SESSION['DepartmenttId'] = 219;
			}
	
			//Select Admission records
			$sql = 	'SELECT patient_id, admission_id, admission_date, department_id
			FROM admissions 
			WHERE admission_date >= "2014-05-01" AND department_id = ' . $_SESSION["DepartmenttId"];
			
			$data=mysqli_query($con,$sql);
	
			if (!$data) {
			return 'No data to display.';
			} else {
			return $data;
			}
			include ('pagecomponents/closeConnection.php');
			}

			

		function AdmissionTable($admheader, $admdata, &$admissionIdArray){

    		// Colors, line width and bold font
    		$this->SetFillColor(255,255,255);
    		$this->SetTextColor(135,186,214);
    		$this->SetDrawColor(165,165,167);	
    		$this->SetLineWidth(.8);
   			$this->SetFont('','B');

    		// Header Line of table
    		// Set Column Widths
    		
    		// Header
    		$this->Cell(190,10,"PROCEDURE HISTORY",1,0,'C',true);
    		$this->Ln();
    		$w = array(47.5, 47.5, 47.5, 47.5);
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
	
        			$this->Cell($w[0],10,$row['patient_id'],1,0,'L',$fill);
        			$this->Cell($w[1],10,$row['admission_id'],1,0,'L',$fill);
        			$this->Cell($w[2],10,$row['admission_date'],1,0,'L',$fill);
        			$this->Cell($w[3],10,$row['department_id'],1,0,'L',$fill);
        			$fill = !$fill;
        			array_push($admissionIdArray,$row['admission_id']);
        			$this->Ln();
        		}       		
        		$this->Ln(10);
        	}


        	// Load Table data
			function LoadProData($file, $admissionIdArray )
			{
			//Connect to database
			include ('pagecomponents/connectDB.php');

			// Testing with AdmissionId set to 1
			if (!isSet($_SESSION['DepartmenttId'])) {
			$_SESSION['DepartmenttId'] = 219;
			}

			$implodeIdArray = implode(',', $admissionIdArray);
	
			//Select Admission records
			$sql = 	'SELECT patient_procedure_id, admission_id, service_start_date, procedure_id
			FROM patient_services 
			WHERE service_start_date >= "2014-05-01" AND admission_id IN ('.$implodeIdArray.')';
			
			$data=mysqli_query($con,$sql);
	
			if (!$data) {
			return 'No data to display.';
			} else {
			return $data;
			}
			include ('pagecomponents/closeConnection.php');
			}

        	function procedureTable($proheader, $prodata, $admissionIdArray){

    		// Colors, line width and bold font
    		$this->SetFillColor(255,255,255);
    		$this->SetTextColor(135,186,214);
    		$this->SetDrawColor(165,165,167);	
    		$this->SetLineWidth(.8);
   			$this->SetFont('','B');

    		// Header Line of table
    		// Set Column Widths
    		
    		// Header
    		$this->Cell(190,10,"DEPARTMENT ADMISSIONS HISTORY",1,0,'C',true);
    		$this->Ln();
    		$w = array(47.5, 47.5, 47.5, 47.5);
    		$this->SetTextColor(165,165,167);
    		for($i=0; $i<count($proheader);$i++)
    			$this->Cell($w[$i],10,$proheader[$i],1,0,'C',true);    			
    		$this->Ln();


    		// Color and font restoration
    		$this->SetFillColor(224,235,255);
    		$this->SetTextColor(0);
    		$this->SetFont('');

	
    		while($row = mysqli_fetch_array($prodata)) {
	
				// Populate Data
	
        			$this->Cell($w[0],10,$row['patient_procedure_id'],1,0,'L',$fill);
        			$this->Cell($w[1],10,$row['admission_id'],1,0,'L',$fill);
        			$this->Cell($w[2],10,$row['service_start_date'],1,0,'L',$fill);
        			$this->Cell($w[3],10,$row['procedure_id'],1,0,'L',$fill);
        			$fill = !$fill;
        			$this->Ln();

        		}
        		      		
        		
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
	$admdata = $pdf->LoadData($file);
	$admheader = array('Patient Id', 'Admission Id','Admission Date', 'Admission Notes');
	$admissionIdArray = array();
	$pdf->AdmissionTable($admheader, $admdata, $admissionIdArray);
	$proheader = array('Procedure number', 'Admission Id','Procedure Date', 'Procedure Id');
	$prodata = $pdf->LoadProData($file, $admissionIdArray);	
	$pdf->procedureTable($proheader, $prodata, $admissionIdArray);
	$pdf->Output();

?>