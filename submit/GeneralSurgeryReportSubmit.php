<?php
	
	if($_POST['_month'] && $_POST['_year'])
	{
		echo $_POST['_month'];
		echo $_POST['_year'];
		//session_start();
		//$_SESSION['patient_id'] = $_POST['patient_id'];
		//header("Location: http://trustinblack.com/harmonyhospital/Harmony_patientinvoicereportsession.php");
	}

?>