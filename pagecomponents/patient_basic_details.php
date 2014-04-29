<?php 
	include ("pagecomponents/connectDB.php");

	if (isset($_SESSION["PatientID"])) {
		$sql="SELECT first_name, last_name, date_of_birth, admission_id from patient_details 
		NATURAL JOIN admissions
		WHERE patient_id = " . $_SESSION["PatientID"] . ";";
	} else {
		//Testing with PatientID = 1
		$sql="SELECT patient_id, first_name, last_name, date_of_birth, admission_id from patient_details 
		NATURAL JOIN admissions
		where patient_id = 1;";
		$_SESSION["PatientId"] = 1;
	}

	$result=mysqli_query($con, $sql);

	while($row = mysqli_fetch_array($result)){							
		$_SESSION["PatientName"] = $row["first_name"] . " " . $row["last_name"];							
		$_SESSION["DateOfBirth"] = $row["date_of_birth"];							
		$_SESSION["AdmissionId"] = $row["admission_id"];							
	}
?>