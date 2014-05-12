<?php
session_start();
function populate_list($errors, $existingAdm, $name, $label, $description) {
	require("pagecomponents/connectDB.php");
	echo '<tr>';
	
		label($name, $label);
		
		$value = straight_value($name, $existingAdm);
		
		echo "<td><select class=\"rounded\" name=\"$name\" id=\"$name\">";
		echo '<option value="default">-- please select from list --</option>';
		
		$sql = get_sql_query($name);
		$result = mysqli_query($con,$sql);
		if ($result !== false) {
		
			while ($row = mysqli_fetch_array($result)) {
				
				if ($row[$name] == $value) 
					echo '<option value="' . $row[$name] . '" selected>' . $row[$description] . ' </option>';
				else
					echo '<option value="' . $row[$name] . '">' . $row[$description] . '</option>';
			}
		}
		echo '</select></td>';
	echo '</tr>';
	errorLabel($errors, $name);		
}

function populate_list_ajax($errors, 
						$existingAdm, $name, 
						$label, $description, $event) {
	require("pagecomponents/connectDB.php");
	echo '<tr>';
	
		label($name, $label);
		
		$value = straight_value($name, $existingAdm);
		
		echo "<td><select class=\"rounded\" name=\"$name\" id=\"$name\" onchange=\"$event\">";
		echo '<option value="default">-- please select from list --</option>';
		
		$sql = get_sql_query($name);
		$result = mysqli_query($con,$sql);
		if ($result !== false) {
		
			while ($row = mysqli_fetch_array($result)) {
				
				if ($row[$name] == $value) 
					echo '<option value="' . $row[$name] . '" selected>' . $row[$description] . ' </option>';
				else
					echo '<option value="' . $row[$name] . '">' . $row[$description] . '</option>';
			}
		}
		echo '</select></td>';
	echo '</tr>';
	errorLabel($errors, $name);	
}

function get_sql_query($name) {
	if ($name == 'staff_id') {
		return ("SELECT staff_id, CONCAT(last_name, ', ', first_name) as staff_name
			FROM staff_details INNER JOIN roles 
			ON staff_details.role_id = roles.role_id
			WHERE role_description LIKE '%DOCTOR%' OR role_description LIKE '%NURSE%'");
	} else if ($name == 'resource_id') {
		return ("SELECT resource_id, resource_description 
			FROM resources
			ORDER BY resource_description");
	} else if ($name == 'department_id') {
		return ("SELECT department_id, department_description 
			FROM departments 
			ORDER BY department_description");
	} else if ($name == 'bed_id') {
		return ("SELECT bed_id, bed_description
			FROM beds 
			WHERE bed_id NOT IN (SELECT bed_id from admissions WHERE discharge_date IS NULL)
			ORDER BY bed_description");
	} else if ($name == 'insurance_provider_id') {
		return ("SELECT insurance_provider_id, insurance_provider_name
				FROM insurance_providers
				ORDER BY insurance_provider_name");
	} else if ($name == 'patientId') {
		return ("SELECT CONCAT(last_name, ', ', first_name) AS patient_name
		FROM patient_details WHERE patient_id = " . $_SESSION[patient_id]);
	}
	
	/* 
	SELECT bed_id, bed_description, ward_description 
			FROM beds INNER JOIN wards 
			ON beds.ward_id = wards.ward_id
			ORDER BY ward_description, bed_description
	*/
}

function input_date($errors, $existingAdm, $name, $label) {
	echo '<tr>';
		label($name, $label);
		
		// use today's date if the date is not already selected
		if (ISSET($_POST[$name]))
			$value = $_POST[$name];
		else if (ISSET($existingAdm[$name]))
			$value = $existingAdm[$name];
		else
			$value = date('Y-m-d');
			
		echo "<td><input type=\"date\" class=\"rounded\" id= \"$name\" name=\"$name\" value=\"$value\" /></td>";
		errorLabel($errors, $name);
	echo '</tr>';
}

function input_textArea($errors, $existingAdm, $name, $label) {
	$value = straight_value($name, $existingAdm);
	echo '<tr>';
		label($name, $label);
		echo "<td><textarea rows=\"4\" cols=\"50\" name=\"$name\">";
		echo $value;
		echo '</textarea></td>';
		errorLabel($errors, $name);
	echo '</tr>';
}

function input_text($errors, $existingAdm, $name, $label) {
	$value = straight_value($name, $existingAdm);
	echo '<tr>';
		label($name, $label);
		echo "<td><input type=\"text\" name=\"$name\" value=\"$value\" />";
		echo '</td>';
		errorLabel($errors, $name);
	echo '</tr>';
}

function patient_details() {
	require("pagecomponents/connectDB.php");

	if (ISSET($_SESSION[patient_id])) {
	
		$sql = get_sql_query('patientId');
		$result = mysqli_query($con,$sql);
		if ($result !== false) {
			$row = mysqli_fetch_array($result);
		
			echo '<tr>';
				echo '<td><label>Patient ID: ' . $_SESSION[patient_id] . '</label></td>';
				echo '<td><label>' . $row["patient_name"] . '</label></td>';
			echo '</tr><tr></tr>';
		}
	}
}

function straight_value($name, $existingAdm) {
	if (ISSET($_POST[$name]))
		return $_POST[$name];
	else if (ISSET($existingAdm[$name]))
		return $existingAdm[$name];
	else
		return '';
}

function label($name, $label) {
	echo '<td><label for="' . $name . '">' . $label . ':</label></td>';
}

function errorLabel($errors, $name) {
	$error = errorMessage($errors, $name);
	echo "<tr><td></td><td><span id=\"{$name}Missing\" class=\"missing\" > $error</span></td></tr>";
}

function errorMessage($errors, $name) {
	if (ISSET($errors[$name]))
		return $errors[$name];
	else
		return '';
}
?>