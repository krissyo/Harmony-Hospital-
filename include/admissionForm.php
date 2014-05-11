<?php
// Author: Kira Jamison, 08795428
// Last modified on: 10/05/2014
require ('include/prefill_admission.inc');
session_start();
?>

<script src="<?php $_SERVER["DOCUMENT_ROOT"] ?>/harmonyhospital/lib/buttonClickLink.js"></script>

<div id="wrapper">
	<div id="header">
		<h1>ADD / UPDATE ADMISSIONS</h1>
	</div>
<div id="content">
<form method="POST" action="processAdmission.php">
<table>
<?php
// admissions table
// 	Session variable for admission_id
// 	session var for patient_id
	
	// show patient's ID, first_name and last_name
	patient_details();
	input_date($errors, $existingAdm, 'admission_date', 'Admission');
	populate_list($errors, $existingAdm, 'staff_id', 'Staff', 'staff_name');
	populate_list($errors, $existingAdm, 'department_id', 'Department', 'department_description');
	populate_list($errors, $existingAdm, 'bed_id', 'Bed', 'bed_description');
	populate_list($errors, $existingAdm, 'resource_id', 'Facility', 'resource_description');
	input_textArea($errors, $existingAdm, 'notes', 'Notes');
	populate_list($errors, $existingAdm, 'insurance_provider_id', 'Insurance', 'insurance_provider_name');
	input_text($errors, $existingAdm, 'provider_client_number', 'Card Number');
	input_date($errors, $existingAdm, 'expiry_date_of_cover', 'Expiry Date');
	input_text($errors, $existingAdm, 'cover_type', 'Cover Type');

?>
	<tr>
		<td></td>
		<td><input class="rounded" type="submit" name="submit" id="submit" value="Submit"></td>
	</tr>
</table>

</div>