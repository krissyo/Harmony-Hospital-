<?php
// @author: Kira Jamison, 08795428
// 
// link this from Current Admission and Patient Details form
// on discharge end any services for this patient (patient_services table)
session_start();
if (isset($_SESSION['userID']))
	{
		$userId = $_SESSION['userID'];
	}
$current_page = basename($_SERVER['PHP_SELF']);
require 'include/check_access.inc';
if (check_access($userId, $current_page) == false)
{
	die("Sorry, You don't have access to this page!");
}
$pagetitle="Discharge Form";
include("pagecomponents/head.php");
require_once 'pagecomponents/validate_resource_mgt.inc';

// The form posted to itself, check for errors
if (ISSET($_POST['submit'])) {

	//validate here
	$errors = array();

	validateDate($errors, $_POST, 'discharge_date');
	
	if (count($errors) === 0) {
	
		// no errors - so can proceed to submitting to DB
		require 'submit/success_discharge_post.inc';
		
	} else {
		echo '<h3>Error - please correct the problems listed below</h3>';
		// some errors detected - loading a pre-filled form
		// for the user to correct the errors
		require 'include/dischargeForm.php';
		
	}
} else if (ISSET($_SESSION['admission_id'])){
	
	// loading an update form
	require 'include/dischargeForm.php';
} 
?>

<?php

include("pagecomponents/footer.php");
?>

</div>    
</body>
</html> 