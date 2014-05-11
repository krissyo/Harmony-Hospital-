<?php
session_start();
// Author: Kira Jamison, 08795428
// Last modified on: 11/05/2014
require_once('pagecomponents/connectDB.php');

// insert or update admission details
// also insert or update admission_account table with the 
// insurance provider details

include ('include/set_admission_vars.inc');

if (ISSET($_SESSION[admission_id])) {
	// this is an existing admission, so update DB
	
	$sql = "UPDATE admissions SET staff_id = $staff_id,
	bed_id = $bed_id, admission_date = '" . $admission_date .
	"', resource_id = $resource_id, notes = '" . $notes .
	"', last_updated_by = $last_updated_by, department_id = $department_id	
	WHERE admission_id = " . $_SESSION['admission_id'];
	
	echo $sql;
	
	$sql = "";
} else {
	// this is a new admission, so insert into DB
}

?>