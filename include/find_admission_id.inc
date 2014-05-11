<?php
session_start();
require("pagecomponents/connectDB.php");

	$sql = "SELECT admission_id FROM admissions
			WHERE patient_id = " . $_SESSION[patient_id] . "
			AND discharge_date IS NULL";
			
	$result = mysqli_query($con,$sql);
	
	if ($result !== false) {
		$row = mysqli_fetch_array($result);
		
		$_SESSION[admission_id] = $row['admission_id'];
	}
?>