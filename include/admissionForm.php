<?php
// Author: Kira Jamison, 08795428
// Last modified on: 10/05/2014
require ('include/prefill_admission.inc');
session_start();

// ADD AJAX to populate Beds dropdown list
// when user clicks on Department,
// list VACANT beds ONLY for that department.
// populateDepartmentList with event to 
// add <script> event with AJAX
// load bed list dynamically, 
// "no vacant beds for this Dpt" if none found

?>

<script src="<?php $_SERVER["DOCUMENT_ROOT"] ?>/harmonyhospital/lib/buttonClickLink.js"></script>

<script>
function displayVacantBeds(dptId) {
	
	  if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	  } else { // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		  document.getElementById("bed_id").innerHTML=xmlhttp.responseText;
		}
	  }
	  xmlhttp.open("GET","getVacantBeds.php?q="+dptId,true);
	  xmlhttp.send();
}
</script>

<div id="wrapper">
	<div id="header">
		<h1>ADD / UPDATE ADMISSIONS</h1>
	</div>
<div id="content">
	<div name=" buttonWrapper" id="centre">
		<?php
			if (ISSET($_SESSION[admission_id])) {
			?>
				<button  id="curAdmissionBtn" class="linkingButtons" 
				onclick="location.href = 'bookings.php'">Make a Booking</button>
				
				<button  id="curAdmissionBtn" class="linkingButtons" 
				onclick="location.href = 'discharge.php'">Discharge Patient</button>
			<?php
			}
			?>
	</div>

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
	
	populate_list_ajax($errors, $existingAdm, 'department_id', 'Department', 
		'department_description', 
		'displayVacantBeds(this.value);');
		
	populate_list($errors, $existingAdm, 'bed_id', 'Bed', 'bed_description');
	populate_list($errors, $existingAdm, 'triage_category_id', 'Triage Category', 'triage_description');
	input_text($errors, $existingAdm, 'waiting_time', 'Waiting Time');
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