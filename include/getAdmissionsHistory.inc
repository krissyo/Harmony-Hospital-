<?php
function getHistory($patient_id) {
require('pagecomponents/connectDB.php');

$patient_id = 1;

$sql = getQuery($patient_id);

$result = mysqli_query($con, $sql);

	if ($result !== false) {
		if (mysqli_num_rows($result) !== 0 ) {
			// Headings
			echo '<tr>';
				echo '<th>Start Date</th><th>End Date</th><th>Notes</th>';
			echo '</tr>';
			
			// Main data
			while ($row = mysqli_fetch_array($result) ) {
				echo '<tr>';
					echo '<td>' . date("d/m/Y", strToTime($row["admission_date"])) . '</td>';
					echo '<td>' . date("d/m/Y", strToTime($row["discharge_date"])) . '</td>';
					echo '<td>' . $row["notes"] . '</td>';
				echo '</tr>';
			}
		} else {
			echo '<tr><td>No admissions records found.</td></tr>';
		}
	} 
}

function getQuery($patient_id) {
	return "SELECT admission_date, discharge_date, notes 
	FROM admissions 
	WHERE discharge_date IS NOT NULL 
	AND patient_id = " . $patient_id;
}
?>