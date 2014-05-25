<?php
	
	if($_POST['patient_id'])
	{
		
		session_start();
		$_SESSION['patient_id'] = $_POST['patient_id'];
		header("Location: http://trustinblack.com/harmonyhospital/Harmony_patientinvoicereportsession.php");
	}

?>