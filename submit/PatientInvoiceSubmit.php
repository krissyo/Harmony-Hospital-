<?php
	
	if($_POST['selectPatient'])
	{
		session_start();
		$_SESSION['patient_id'] = $_POST['selectPatient'];
		//echo $_SESSION['patient_id'];
		header("Location: http://trustinblack.com/harmonyhospital/Harmony_patientinvoicereportsession.php");
	}

?>