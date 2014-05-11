<?php
session_start();

// Author: Kira Jamison, 08795428
// Last modified on: 10/05/2014

$pagetitle="Admission Form";
include("pagecomponents/head.php");
require_once 'pagecomponents/validate_resource_mgt.inc';

// If the form posted to itself, check for errors
if (ISSET($_POST['submit'])) {

	//validate here
	$errors = array();
	//validatePattern(&$errors, $field_list, $field_name, $pattern)
	validateDate($errors, $_POST, 'admission_date');
	validateDate($errors, $_POST, 'expiry_date_of_cover');
	checkInvalidCharacters($errors, $_POST, 'notes');
	//validatePattern($errors, $_POST, 'provider_client_number', '([A-Za-z0-9\#\- \_\/]+)');
	
	validatePattern($errors, $_POST, 'provider_client_number', '/^[a-zA-Z0-9\#\_\- ]+$/');
	/*	
	
	validatePattern($errors, $_POST, 'cover_type', 'PATTERN HERE');
	*/
	
	if (count($errors) === 0) {
	
		// no errors - so can proceed to submitting to DB
		echo 'going to submit';
		require 'submit/success_admission_post.inc';
		
	} else {
		echo '<h3>Error - please correct the problems listed below</h3>';
		// some errors detected - loading a pre-filled form
		// for the user to correct the errors
		require 'include/admissionForm.php';
		
	}
} else if (ISSET($_SESSION['admission_id'])){

	// Query the DB to extract the existing admission record
	$existingAdm = array();
	require 'include/load_existing_admission.inc';
	
	load_admission($existingAdm);
	
	// Existing admission - loading an update form
	require 'include/admissionForm.php';
} else {

	// New admission - loading an empty form
	require 'include/admissionForm.php';
	
}
	?>

<?php

include("pagecomponents/footer.php");
?>

</div>    
</body>
</html>   	
