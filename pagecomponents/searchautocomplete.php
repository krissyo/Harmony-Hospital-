<?php
// An array to store the json file
$name_list = array();
// Another array to store the information retrived from db
$name_list_row = array();
$mysqli = new mysqli('localhost', 'trustinb_harmony', 'inb201', 'trustinb_harmonyhospital');
$query1 = "SELECT first_name, last_name, staff_id FROM staff_details WHERE first_name LIKE '%" .
	  $mysqli->real_escape_string($_GET['$term']) . "%' OR last_name LIKE '%" .
	  $mysqli->real_escape_string($_GET['$term']) . "%' OR staff_id LIKE '%" .
	  $mysqli->real_escape_string($_GET['$term']) . "%'";
$result = $mysqli->query($query1);
if ( mysqli_num_rows($result) > 0 ) {
	// going through result of sql query and inserting the values in an associative array
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		$name_list_row["label"] = 'Staff: ' . $row['first_name'] . ' ' . $row['last_name'] . ', ' . 		$row	['staff_id'];
		$name_list_row["value"] = $row['first_name'];
		// pushing the values in our associative array into the other array that store the json file
		array_push($name_list, $name_list_row);
	}
}

$query2 = "SELECT first_name, last_name, patient_id FROM patient_details WHERE first_name LIKE '%" .
	  $mysqli->real_escape_string($_GET['$term']) . "%' OR last_name LIKE '%" .
	  $mysqli->real_escape_string($_GET['$term']) . "%' OR patient_id LIKE '%" .
	  $mysqli->real_escape_string($_GET['$term']) . "%'";
$result = $mysqli->query($query2);
if (mysqli_num_rows($result) > 0) {
	// going through result of sql query and inserting the values in an associative array
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		$name_list_row["label"] = 'Patient: ' . $row['first_name'] . ' ' . $row['last_name'] . ', ' . 		$row	['patient_id'];
		$name_list_row["value"] = $row['first_name'];
		// pushing the values in our associative array into the other array that store the json file
		array_push($name_list, $name_list_row);
	}
}

// convert our array to json file as the output, cause jquery want json file!
echo json_encode($name_list);
?>
