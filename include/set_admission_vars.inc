<?php
function update_admissions_sql($vars) {
	session_start();
	
	return "UPDATE admissions SET staff_id = " . $vars['staff_id'] . ",
	bed_id = " . $vars['bed_id'] . ", admission_date = '" . $vars['admission_date'] .
	"', resource_id = " . $vars['resource_id'] . ", notes = '" . $vars['notes'] .
	"', last_updated_by = " . $vars['last_updated_by'] . ", department_id = " . $vars['department_id'] .	
	" WHERE admission_id = " . $_SESSION[admission_id];
}

function update_account_sql($vars) {
	session_start();
	
	if (checkExists($_SESSION[admission_id])) {
		return "UPDATE admission_account 
			SET insurance_provider_id = " . $vars['insurance_provider_id'] . ",
			provider_client_number = '" . $vars['provider_client_number'] . "',
			expiry_date_of_cover = '" . $vars['expiry_date_of_cover'] . "',
			cover_type = '" . $vars['cover_type'] . "',
			last_updated_by = " . $vars['last_updated_by'] . 
			" WHERE admission_id = " . $_SESSION[admission_id];
	} else {
		$sql = insert_account_sql($vars);
		return $sql;
	}
}

function insert_admission_sql($vars) {
session_start();

	return "INSERT INTO admissions 
	(patient_id, staff_id, bed_id, admission_date, 
	discharge_date, resource_id, notes, 
	last_updated_by, department_id)
	VALUES (" . $_SESSION[patient_id] . 
	", " . $vars['staff_id'] . ", " . $vars['bed_id'] . ", '" . 
	$vars['admission_date'] . 
	"', NULL, " . $vars['resource_id'] . ", 
	'" . $vars['notes'] . "', ".
	$vars['last_updated_by'] . ", " . $vars['department_id'] . ")";
}

function insert_account_sql($vars) {
session_start();

	return "INSERT INTO admission_account
	(admission_id, insurance_provider_id,
	provider_client_number, expiry_date_of_cover,
	cover_type, last_updated_by)
	VALUES (" . $_SESSION[admission_id] . ", " .
	$vars['insurance_provider_id'] . ", '" .
	$vars['provider_client_number'] . "', '" .
	$vars['expiry_date_of_cover'] . "', '" .
	$vars['cover_type'] . "', " .
	$vars['last_updated_by'] . ")";
}
// Checks if an Insurance Provider account 
// exists for this admission
function checkExists($admission_id) {
	require('pagecomponents/connectDB.php');
	
	$query = "SELECT * FROM admission_account WHERE admission_id = " . $admission_id;
	
	$row = mysqli_query($con,$query);
	
	$check = mysqli_fetch_array($row);
	
	if (is_null($check[0])) {
		
		return false;
		
	} else {
		
		return true;
	}
}

function set_variables(&$vars) {
	session_start();
	// variables for the admissions table
	if (ISSET($_POST['staff_id']) && !($_POST['staff_id'] == 'default'))
		$vars['staff_id'] = $_POST['staff_id'];
	else
		$vars['staff_id'] = 0;
		
	if (ISSET($_POST['bed_id']) && !($_POST['bed_id'] == 'default'))
		$vars['bed_id'] = $_POST['bed_id'];
	else
		$vars['bed_id'] = 0;
		
	if (ISSET($_POST['admission_date']))
		$vars['admission_date'] = $_POST['admission_date'];

	if (ISSET($_POST['resource_id']) && !($_POST['resource_id'] == 'default'))
		$vars['resource_id'] = $_POST['resource_id'];
	else
		$vars['resource_id'] = 0;
		
	if (ISSET($_POST['notes']))
		$vars['notes'] = $_POST['notes'];
	else
		$vars['notes'] = '';

	if (ISSET($_SESSION['userID']))
		$vars['last_updated_by'] = $_SESSION['userID'];
	else
		$vars['last_updated_by'] = 'session not set';
		
	if (ISSET($_POST['department_id']) && !($_POST['department_id'] == 'default'))
		$vars['department_id'] = $_POST['department_id'];
	else
		$vars['department_id'] = 0;
		
	// set variables for the admission_account table
	if (ISSET($_POST['insurance_provider_id']) && ($_POST['insurance_provider_id'] !== 'default'))
		$vars['insurance_provider_id'] = $_POST['insurance_provider_id'];
	else
		$vars['insurance_provider_id'] = 0;

	if (ISSET($_POST['provider_client_number']))
		$vars['provider_client_number'] = $_POST['provider_client_number'];
	else
		$vars['provider_client_number'] = 0;

	if (ISSET($_POST['expiry_date_of_cover']))
		$vars['expiry_date_of_cover'] = $_POST['expiry_date_of_cover'];

	if (ISSET($_POST['cover_type']))
		$vars['cover_type'] = $_POST['cover_type']; 
	else
		$vars['cover_type'] = '';
}

function add_hospital_service($procedure_id, 
			$service_start_date, $last_updated) {
	session_start();
	require('pagecomponents/connectDB.php');
	
	if (!checkServiceExists($_SESSION[admission_id])) {
		$query = insert_service($_SESSION[admission_id], 
								$procedure_id, 
								$service_start_date, 
								$last_updated);

		$result = mysqli_query($con,$query);
		
		if ($result !== false) {
			return 'Added a Hospital Stay Service.<br>';
		} else {
			return 'Failed to add a Hospital Stay Service.<br>';
		}
	}
}

function checkServiceExists($admission_id) {
require('pagecomponents/connectDB.php');

	$check = "SELECT patient_procedure_id 
			FROM patient_services ps
			inner join procedure_listing pl
			on ps.procedure_id = pl.procedure_id
			where pl.procedure_description like 'Hospital Stay'
			AND ps.admission_id = " . $admission_id;
			
	$row = mysqli_query($con,$check);
	
	$data = mysqli_fetch_array($row);
	
	if (is_null($data[0])) {
		
		return false;
		
	} else {
		
		return true;
	}
}

function get_procedure_id() {
require('pagecomponents/connectDB.php');

	$sql = "SELECT procedure_id FROM procedure_listing
			WHERE procedure_description LIKE 'Hospital Stay'";
	$result = mysqli_query($con,$sql);
	
	$row = mysqli_fetch_array($result);
	
	if (!is_null($row['procedure_id']))
		return $row['procedure_id'];
	else
		return 0;
}
// returns a formulated sql query to insert a hospital stay record
// into patient_services table for this admission
function insert_service($admission_id, $procedure_id, $service_start_date, $last_updated) {
	return "INSERT INTO patient_services 
	(admission_id, procedure_id,
	 staff_id, service_start_date, service_end_date,
	 consent_received, guardian_name, guardian_signature,
	 consent_date, last_updated_by)
	VALUES( " . $admission_id . ", " . $procedure_id .
	", 0, '" . $service_start_date . "', NULL, 0, NULL, NULL, NULL, "
	. $last_updated . ")";
}
?>