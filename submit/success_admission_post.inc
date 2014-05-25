<?php
session_start();
// Author: Kira Jamison, 08795428
// Last modified on: 11/05/2014
require_once('pagecomponents/connectDB.php');

include ('include/set_admission_vars.inc');
$vars = array();
set_variables($vars);

if (ISSET($_SESSION[admission_id])) {
	// this is an existing admission, so update DB
	
	$sql = update_admissions_sql($vars);
	
	// update Admission details
	$result = mysqli_query($con,$sql);
	
	if ($result !== false) {
		$msg = 'Successfully updated the current Admission.<br>';
		
		$sql = update_account_sql($vars);
		
		// update Insurance details
		$result = mysqli_query($con,$sql);
		if ($result !== false) {
			$msg = $msg . 'Successfully updated Insurance details.<br>';
		} else {
			$msg = $msg . 'Failed to update Insurance details.<br>';
		}
	} else {
		$msg = 'Failed to update the current Admission.<br>';
	}	
	
} else {
	// this is a new admission, so insert into DB
	$sql = insert_admission_sql($vars);
	
	// save new Admission 
	$result = mysqli_query($con,$sql);
	
	if ($result !== false) {
		$msg = 'Successfully admitted the patient.<br>';
		
		// set the session variable of admission's record
		$sql = "SELECT admission_id FROM admissions 
				WHERE patient_id = " . $_SESSION['patient_id'] .
				" AND discharge_date IS NULL ";
		
		$result = mysqli_query($con,$sql);
		$row = mysqli_fetch_array($result);
		
		$_SESSION['admission_id'] = $row['admission_id'];
		
		$sql = insert_account_sql($vars);
		
		// save new Insurance details		
		$result = mysqli_query($con,$sql);
		if ($result !== false) {
			$msg = $msg . 'Successfully saved Insurance details.<br>';
		} else {
			$msg = $msg . 'Failed to save Insurance details.<br>';
		}
	} else {
		$msg = 'Failed to save the new Admission.<br>';
	}
}

 // if the Patient was admitted to a Bed
 // Start a Hospital Stay Service
 if (ISSET($vars['bed_id']) && $vars['bed_id'] !== 0) {
	 $procedure_id = get_procedure_id();
	 $extra = add_hospital_service($procedure_id, $vars['admission_date'], $vars['last_updated_by']);
	 $msg = $msg . $extra;
 }
// Provide the user with the Back to Admission form button
?>

<table>
	<tr>
		<td></td>
		<td><?php echo $msg; ?></td>
	</tr>

	<tr>
		<td></td>
		<td><input class="rounded" type="button" onclick="location.href = 'patientdetail.php'"
			name="submit" id="backToBedMgt" value="Back to Patient Details Form"></td>
	</tr>
</table>