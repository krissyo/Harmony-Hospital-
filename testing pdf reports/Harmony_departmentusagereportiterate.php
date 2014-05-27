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
			$this->MultiCell(88,8,'DEPARTMENT ADMISSION STATISTICS',0,'C');

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

		// Load departments data
		function LoadDepData($file)
		{
			//Connect to database
			include ('pagecomponents/connectDB.php');
	
			//Select departments records
			$sql = 	'SELECT department_id, department_description
			FROM departments';
			
			
			$data=mysqli_query($con,$sql);
	
			if (!$data) {
			return 'No data to display.';
			} else {
			return $data;
			}
			include ('pagecomponents/closeConnection.php');
		}




		// Load admission data
		function LoadAdmData($file, $department)
		{
			//Connect to database
			include ('pagecomponents/connectDB.php');
	
			//Select Admission records
			$sql = 	'SELECT patient_id, admission_id, admission_date, discharge_date, department_id
			FROM admissions 
			WHERE admission_date >= "2014-05-01" AND department_id = ' . $department;
			
			$data=mysqli_query($con,$sql);
	
			if (!$data) {
			return 'No data to display.';
			} else {
			return $data;
			}
			include ('pagecomponents/closeConnection.php');
		}


		// Load patient data
		function LoadPatData($file, $patientIdArray ) 
		{
			//Connect to database
			include ('pagecomponents/connectDB.php');

			$implodeArray = implode(',', $patientIdArray);
			//$this->Ln(40);
			//$this->Cell(20,20,$patientIdArray[0],1,1,'L',0);
	
			//Select Admission records
			$sql = 	'SELECT patient_id, date_of_birth
			FROM patient_details
			WHERE patient_id IN ('.$implodeArray.')';
			
			$data=mysqli_query($con,$sql);
			
	
			if (!$data) {
			return false;
			} else {
			return $data;
			}
			include ('pagecomponents/closeConnection.php');
			}




		function AdmissionTable($admheader, $admdata, &$patientIdArray, $todaysDate, $departmentName, $departmentnumber){

    		// Colors, line width and bold font
    		$this->SetFillColor(255,255,255);
    		$this->SetTextColor(135,186,214);
    		$this->SetDrawColor(165,165,167);	
    		$this->SetLineWidth(.8);
   			$this->SetFont('','B');

    		// Header Line of table
    		// Set Column Widths
    		
    		// Header
    		$this->Cell(190,10,$departmentName." ADMISSIONS STATISTICS",1,0,'C',true);
    		$this->Ln();
    		$w = array(38, 38, 38, 38, 38);
    		$this->SetTextColor(165,165,167);
    		$xcoord= 48;
    		$ycood = $this->GetY();
    		for($i=0; $i<count($admheader);$i++){
    			$this->MultiCell($w[$i],5,$admheader[$i],1,'C',true);
    			$this->SetXY($xcoord,$ycood);
    			$xcoord += 38;
    			}
    		$this->Ln(10);	


    		// Color and font restoration
    		$this->SetFillColor(224,235,255);
    		$this->SetTextColor(0);
    		$this->SetFont('');

    		// set count variables
			$admissionCount= 0;
			$dischargeCount= 0;
			$stayLengthSeconds = 0;
			
			// Calculate Average length of stay
			$admdata = $this->LoadAdmData($file,$departmentnumber);
    		while($row = mysqli_fetch_array($admdata)) {
    			$admissionCount++;
    			$dischargeCount++;
    			array_push($patientIdArray, $row['patient_id']);
    			

    			if($row['discharge_date'] != null){
    				$stayLengthSeconds += strtotime($row['discharge_date']) - strtotime($row['admission_date']);
    			}
    			else{
    				$stayLengthSeconds += $todaysDate - strtotime($row['admission_date']);

    			}
    		}
    		
    		//Calculate Average age
    		$totalAgesYears = 0;
    		$patdata = $this->LoadPatData($file,$patientIdArray);
			if ($patdata) {
				while($row = mysqli_fetch_array($patdata)) {
    				$totalAgesYears += (($todaysDate - strtotime($row['date_of_birth']))/31536000);
				}
			}


    		$stayLength = $stayLengthSeconds / 86400;
    		if($admissionCount>0)
    		{
    			$avgStayLength = $stayLength / $admissionCount;
    			$avgAge = sprintf ("%.2f",($totalAgesYears / $admissionCount));
    		}
    		else
    		{
    			$avgStayLength = 0;
    			$avgAge = 0;
    		}
    		
    		

    		$returningPatientCount = 0;
    		//Check if any patients are returning patients
    		if(count(array_unique($patientIdArray))<count($patientIdArray))
    		{
    			$uniqueCount = (array_count_values($patientIdArray));
    			for($i=0;$i<count($uniqueCount);$i++){
    				if ($uniqueCount[$i]>1)
    				{
    					$returningPatientCount ++;
    				}

    			}
    		}
	
				// Populate Data	
        			$this->Cell($w[0],10,$admissionCount,1,0,'L',$fill);
        			$this->Cell($w[1],10,$dischargeCount,1,0,'L',$fill);
        			$this->Cell($w[2],10,$avgStayLength,1,0,'L',$fill);
        			$this->Cell($w[3],10,$avgAge,1,0,'L',$fill);
        			$this->Cell($w[4],10,$returningPatientCount,1,0,'L',$fill);
        			$fill = !$fill;
        			$this->Ln();

        			$this->Ln(10);
        		}       		
        		
        function iterateDepartments($admheader, $depdata, $patientIdArray, $todaysDate)
		{
			$departmentName = array();
			while($row=mysqli_fetch_array($depdata))
			{
				$id = $row['department_id'];
				$departments[$id] = $row['department_description'];
			}			
			foreach ($departments as $key=>$element) {
				$querydepartmentno = $key;
				$querydepartmentname = $element;
				$this->AdmissionTable($admheader, $admdata, $patientIdArray, $todaysDate, $querydepartmentname, $querydepartmentno);
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
	//$admdata = $pdf->LoadAdmData($file);
	$depdata = $pdf->LoadDepData($file);

	$currentDate = new DateTime();
	$todaysDate = strtotime($currentDate->format('Y-m-d'));
	
	$admheader = array('Number of Admissions', 'Number of Discharges','Average length of stay', 'Average Age of Patients','Number of returning patients');
	$admissionIdArray = array();
	$patientIdArray = array();
	//$pdf->AdmissionTable($admheader, $admdata, $patdata, $admissionIdArray, $todaysDate);
	$pdf->iterateDepartments($admheader, $depdata, $patientIdArray, $todaysDate);
	$pdf->Output();

?>