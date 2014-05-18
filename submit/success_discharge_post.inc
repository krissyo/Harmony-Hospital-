<?php
session_start();

// @author: Kira Jamison, 08795428
// Last modified on: 18/05/2014

require_once('pagecomponents/connectDB.php');
include ('include/set_admission_vars.inc');

if (ISSET($_SESSION['admission_id'])) {
		
	$sql = update_discharge_sql();
	
	
	// update Admission details
	$result = mysqli_query($con,$sql);
	
	if ($result !== false) {
		$msg = 'Successfully discharged the patient.<br>';
		
		$sql = update_services_sql();
	
		
		// End all services for this admission
		$result = mysqli_query($con,$sql);
		if ($result !== false) {
			$msg = $msg . 'All services stopped for this patient.<br>';
		} else {
			$msg = $msg . 'Failed to update services for this patient.<br>';
		}
	} else {
		$msg = 'Failed to discharge the patient.<br>';
	}	
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