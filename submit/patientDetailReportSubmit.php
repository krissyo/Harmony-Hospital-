<?php
	if($_POST['patient-id'])
	{
		$_SESSION['patient-id']=$_POST['patient-id'];
		$link = "<script type=\"text/javascript\" language=\"javascript\" >window.open('http://trustinblack.com/harmonyhospital/Harmony_patientdetailsreportsession.php')</script>";

	echo $link;

	}
?>