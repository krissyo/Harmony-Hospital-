<?php
session_start();

	// Grab details from bedManagement Form
	//as this form loads for the first time
	if (ISSET($_POST['new_bed'])) {
		$_SESSION['newBedName']  = $_POST['new_bed'];
	} else {
		$_SESSION['newBedName'] = '';
	}

	if ($_POST['selectWard'] != 'WardDefault'){

		$_SESSION['object'] = 'Bed';
		$_SESSION['parentId'] = $_POST['selectWard'];
		
	} else if ($_POST['selectDpmnt'] != 'deptDefault') {

		$_SESSION['object'] = 'Ward';
		$_SESSION['parentId'] = $_POST['selectDpmnt'];
		
	} else {
		$_SESSION['object'] = 'Department';
		$_SESSION['parentId'] = '';
	}

	if (ISSET($_POST['record_id'])) {
		$_SESSION['objectId'] = $_POST['record_id'];
	} else {
		$_SESSION['objectId'] = 0;
	}
?>