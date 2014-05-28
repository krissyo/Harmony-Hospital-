<?php
function drop_down_list($name) {

require("pagecomponents/connectDB.php");
		// class=\"rounded\" 
		echo "<select name=\"$name\" id=\"$name\">";
		
		$sql = get_sql_query($name);
		$result = mysqli_query($con,$sql);
		if ($result !== false) {
		
			while ($row = mysqli_fetch_array($result)) {
				
				echo '<option value="' . $row[$name] . '">' . $row['description'] . '</option>';
			}
		}
		echo '</select><br>';

}

function drop_down_ajax($name, $event) {
	
require("pagecomponents/connectDB.php");
		// class=\"rounded\" 
		echo "<td><select class=\"rounded\" name=\"$name\" id=\"$name\" onchange=\"$event\">";
		
		$sql = get_sql_query($name);
		$result = mysqli_query($con,$sql);
		if ($result !== false) {
		
			while ($row = mysqli_fetch_array($result)) {
				
				echo '<option value="' . $row[$name] . '">' . $row['description'] . '</option>';
			}
		}
		echo '</select><br/>';
}

function get_sql_query($name) {
	if ($name === 'role') {
		return "SELECT role_id as " . $name . ",
		role_description as description
		FROM roles
		ORDER BY role_description";
	}
}
?>