<?php
// Author: Kira Jamison, 08795428
// Last modified on: 8/05/2014

// Uses Regular Expressions to make sure the fields do not contain any invalid characters
function validatePattern(&$errors, $field_list, $field_name, $pattern) {

	if(!ISSET($field_list[$field_name]) || $field_list[$field_name] == '') {
		$errors[$field_name] = 'Required';
	} else if (!preg_match($pattern, $field_list[$field_name])) {
		$errors[$field_name] = 'Invalid';
	}
}

// Makes sure the updated field does not exceed the size limit
function validateLength(&$errors, $field, $limit) {
	// limit prefix fields to be 8 chars long
	if (strlen($field) > $limit)
		$errors[$field] = 'Too long';
}
// check if there are any current admissions at this Dpt / Ward / Bed
function checkDeleteAllowed($objectId, $object) {
session_start();
require ("connectDB.php");
	
	// Create a specific query first
	if ($object == 'Bed') {
		$sql = 'SELECT admission_id FROM admissions WHERE bed_id = ' . $objectId . ' AND admissions.discharge_date IS NULL;';
	} else if ($object == 'Ward') {
		$sql = 'SELECT admission_id FROM admissions
				NATURAL JOIN beds NATURAL JOIN wards
				WHERE wards.ward_id = ' . $objectId . ' AND admissions.discharge_date IS NULL';
	} else if ($object == 'Department') {
		$sql = 'SELECT admission_id FROM admissions
				NATURAL JOIN beds NATURAL JOIN wards
                natural join departments
				WHERE departments.department_id = ' . $objectId . ' AND admissions.discharge_date IS NULL';
	}
	
	// Query the database
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result);	

	if (IS_NULL($row)) { 
		// check cleared, no active admissions
		return true; 
		
	} else {
		// check failed, there are active admissions present
		return false; 
	}
	
}
?>