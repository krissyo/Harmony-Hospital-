<?php
function getHistory($patient_id) {
require('pagecomponents/connectDB.php');

$sql = getQuery($patient_id);

$result = mysqli_query($con, $sql);

	if ($result !== false) {
		if (mysqli_num_rows($result) !== 0 ) {
			// Headings
			echo '<tr>';
				echo '<td style="border: 1px solid grey;">Start Date</td>
				<td style="border: 1px solid grey;">End Date</td>
				<td style="border: 1px solid grey;">Notes</td>';
			echo '</tr>';
			
			// Main data
			while ($row = mysqli_fetch_array($result) ) {
				echo '<tr>';
					echo '<td style="border: 1px solid grey;">' . $row["admission_date"] . '</td>';
					echo '<td style="border: 1px solid grey;">' . $row["discharge_date"] . '</td>';
					echo '<td style="border: 1px solid grey;">' . $row["notes"] . '</td>';
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