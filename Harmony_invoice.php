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
			$this->Cell(110);
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
		}
	}

	$pdf=new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->PatientDetails();
	
	$pdf->Output();

?>