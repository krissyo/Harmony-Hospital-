<?php
session_start();
function load_admission(&$existingAdm) {
	require('pagecomponents/connectDB.php');
	//echo 'i am in load_existing_admission.inc<br>';
	
	// query the DB for this admission
	// and save the info into the array
	
	// pull data from admissions
	if (ISSET($_SESSION[admission_id])) {

		$sql = "SELECT * FROM admissions WHERE admission_id = " . $_SESSION[admission_id];
		$result = mysqli_query($con,$sql);
	
		if ($result !== false) {
			$row = mysqli_fetch_array($result);
			$existingAdm[staff_id] = $row['staff_id'];
			$existingAdm[bed_id] = $row['bed_id'];
			$existingAdm[admission_date] = $row['admission_date'];
			$existingAdm[resource_id] = $row['resource_id'];
			$existingAdm[account_id] = $row['account_id'];
			$existingAdm[notes] = $row['notes'];
			$existingAdm[department_id] = $row['department_id'];
			$existingAdm[triage_category_id] = $row['triage_category_id'];
			$existingAdm[waiting_time] = $row['waiting_time'];
		}
		
		$sql = "SELECT * FROM admission_account 
		WHERE admission_id = " . $_SESSION[admission_id];
		
		$result = mysqli_query($con,$sql);
	
		if ($result !== false) {
			$row = mysqli_fetch_array($result);
			$existingAdm[insurance_provider_id] = $row['insurance_provider_id'];
			$existingAdm[provider_client_number] = $row['provider_client_number'];
			$existingAdm[expiry_date_of_cover] = $row['expiry_date_of_cover'];
			$existingAdm[cover_type] = $row['cover_type'];
		}
	}
}
?>