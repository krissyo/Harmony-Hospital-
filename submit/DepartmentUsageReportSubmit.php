<?php
	
	if($_POST['report_month'] && $_POST['report_year'])
	{
		session_start();
		$_SESSION['report_month'] = $_POST['report_month'];
		$_SESSION['report_year'] = $_POST['report_year'];
		//echo $_SESSION['report_month'];
		//echo $_SESSION['report_year'];
		header("Location: http://trustinblack.com/harmonyhospital/Harmony_departmentusagereportsession.php");
	}

?>