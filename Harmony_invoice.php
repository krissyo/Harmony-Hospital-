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
			$this->Cell(88,8,'DOCUMENT TITLE',0,2,'C');

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
			$this->Cell(88,8,'DOCUMENT NUMBER',1,2,'C');

			//Line Break
			$this->Ln(0);

			////--------Document Date

			// Set Text Colour
			$this->SetTextColor(165,165,167);
			
			//Move to the right
			$this->Cell(110);

			//output Date
			$this->SetFont('Helvetica','B',12);
			$this->Cell(88,8,'20/05/2014',0,2,'C');
			$this->Ln(2);
		}

		function PatientDetails(){			

			// Set Title Font
			$this->SetTextColor(165,165,167);
			$this->SetFont('Helvetica','B',12);

			//Shift to the right 10mm
			//$this->Cell(0);

			//Title
			$this->Cell(88,8,'PATIENT DETAILS',0,2,'L');

			// Patient details Varaibles
			$patientName = "Jesse Cunningham - Creech \n";
			$addressLn1 = "34 Mossman Street, Newmarket \n";
			$addressLn2 = "Qld, 4051";
			$patientDetails = $patientName.$addressLn1.$addressLn2;

			//Create details border Box and input patient details
			$this->SetFont('Helvetica','',12);
			$this->SetLineWidth(1);
			$this->SetDrawColor(135,186,214);			
			$this->MultiCell(88,7,$patientDetails,1,'L');
			
		}
	}

	$pdf=new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->PatientDetails();
	
	$pdf->Output();

?>