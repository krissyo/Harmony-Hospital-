<?php
// An array to store the json file
$name_list = array();
// Another array to store the information retrived from db
$name_list_row = array();
$mysqli = new mysqli('localhost', 'trustinb_harmony', 'inb201', 'trustinb_harmonyhospital');
$query = "SELECT first_name FROM staff_details WHERE first_name LIKE '%" .
	  $mysqli->real_escape_string($_GET['$term']) . "%'";
$result = $mysqli->query($query);
// going through result of sql query and inserting the values in an associative array
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
	$name_list_row["label"] = $row['first_name'];
	$name_list_row["value"] = $row['first_name'];
	// pushing the values in our associative array into the other array that store the json file
	array_push($name_list, $name_list_row);
}
// convert our array to json file as the output, cause jquery want json file!
echo json_encode($name_list);
?>
