<?php
	
	if($_POST['patient_id'])
	{
		
		session_start();
		$_SESSION['patient_id'] = $_POST['patient_id'];
<<<<<<< HEAD
		header("Location: http://trustinblack.com/harmonyhospital/Harmony_patientinvoicereportsession.php");
=======
		header("Location: http://trustinblack.com/harmonyhospital/Harmony_patientdetailsreportsession.php");
>>>>>>> 2fffefb740a36430ce931cd5da1d0b1cee01a241
	}

?>