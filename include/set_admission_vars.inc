<?php
session_start();
// variables for the admissions table
if (ISSET($_POST['staff_id']) && !($_POST['staff_id'] == 'default'))
	$staff_id = $_POST['staff_id'];
else
	$staff_id = 0;
	
if (ISSET($_POST['bed_id']) && !($_POST['bed_id'] == 'default'))
	$bed_id = $_POST['bed_id'];
else
	$bed_id = 0;
	
if (ISSET($_POST['admission_date']))
	$admission_date = $_POST['admission_date'];

if (ISSET($_POST['resource_id']) && !($_POST['resource_id'] == 'default'))
	$resource_id = $_POST['resource_id'];
else
	$resource_id = 0;
	
if (ISSET($_POST['notes']))
	$notes = $_POST['notes'];
else
	$notes = '';

if (ISSET($_SESSION['userID']))
	$last_updated_by = $_SESSION['userID'];
else
	$last_updated_by = 'session not set';
	
if (ISSET($_POST['department_id']) && !($_POST['department_id'] == 'default'))
	$department_id = $_POST['department_id'];
else
	$department_id = 0;
	
// set variables for the admission_account table
if (ISSET($_POST['insurance_provider_id']) && ($_POST['insurance_provider_id'] !== 'default'))
	$insurance_provider_id = $_POST['insurance_provider_id'];
else
	$insurance_provider_id = 0;

if (ISSET($_POST['provider_client_number']))
	$provider_client_number = $_POST['provider_client_number'];
else
	$provider_client_number = 0;

if (ISSET($_POST['expiry_date_of_cover']))
	$expiry_date_of_cover = $_POST['expiry_date_of_cover'];

if (ISSET($_POST['cover_type']))
	$cover_type = $_POST['cover_type']; 
else
	$cover_type = '';

?>