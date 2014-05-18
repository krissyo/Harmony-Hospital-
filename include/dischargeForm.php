<?php
// Author: Kira Jamison, 08795428
// Last modified on: 18/05/2014
require ('include/prefill_admission.inc');
session_start();

?>

<script src="<?php $_SERVER["DOCUMENT_ROOT"] ?>/harmonyhospital/lib/buttonClickLink.js"></script>

<div id="wrapper">
	<div id="header">
		<h1>DISCHARGE FORM</h1>
	</div>
<div id="content">

<form method="POST" action="discharge.php">
<table>
<?php
// admissions table
// 	Session variable for admission_id
// 	session var for patient_id
	
	// show patient's ID, first_name and last_name
	patient_details();
	input_date($errors, $empty, 'discharge_date', 'Discharge');

?>
	<tr>
		<td></td>
		<td><input class="rounded" type="submit" name="submit" id="submit" value="Submit"></td>
	</tr>
</table>

</div>