<?php 
function pull_details(&$patient_details) {
	session_start();
	require('pagecomponents/connectDB.php');

		if (isset($_SESSION[patient_id])) {
			$sql="SELECT first_name, last_name, 
			date_of_birth, admission_id 
			FROM patient_details 
			INNER JOIN admissions 
			on patient_details.patient_id = admissions.patient_id 
			WHERE patient_details.patient_id = " . $_SESSION[patient_id] . ";";
			
			$result=mysqli_query($con, $sql);

			if ($row = mysqli_fetch_array($result)){	
				$patient_details["full_name"] = $row["first_name"] . " " . $row["last_name"];							
				$patient_details["date_of_birth"] = $row["date_of_birth"];							
				$patient_details["admission_id"] = $row["admission_id"];							
			}
		}	else
			echo 'patientid is not set';
}
?>