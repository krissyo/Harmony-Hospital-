<?php
$wardId = intval($_GET['q']);

require ("pagecomponents/connectDB.php");


$sql='SELECT bed_id, bed_description 
from beds WHERE ward_id = ' . $wardId . ' ORDER BY bed_description';
	
$result=mysqli_query($con,$sql);

 echo '<h3>Bed List</h3>';
 echo '<table id="details" >';
 
 // column headings
 echo "<tr><th>Select</th>
			<th>Description</th>
			<th>Vacancy</th>
			<th>Patient Id</th>
			<th>Patient's Name</th>
		</tr>";

	while($row = mysqli_fetch_array($result)){
		echo '<tr>';
		echo '<td><input type="radio" name="record_id" value="' . $row['bed_id'] . '"></td>';
		//echo '<td>' . $row["bed_id"] . '</td>';
		echo '<td>' . $row["bed_description"] . '</td>';
		
		// Check occupancy / vacancy for this bed
		$sql = 'SELECT patient_details.patient_id, first_name, last_name from admissions
			LEFT JOIN patient_details ON admissions.patient_id = patient_details.patient_id
			WHERE (admissions.bed_id = ' . $row["bed_id"] . ' AND admissions.discharge_date IS NULL)';
		
		$record = mysqli_query($con,$sql);	
		
		$num_rows = mysqli_num_rows($record);	
		
		if ($num_rows > 0) { // the bed is occupied
		
			$info = mysqli_fetch_array($record);
			echo '<td>Occupied</td>';
			echo '<td>' . $info["patient_id"] . '</td>';
			echo '<td>' . $info["last_name"] . ', ' . $info["first_name"] . '</td>';
			
		} else { // bed is vacant
			echo '<td>Vacant</td>';
			echo '<td>-</td>';
			echo '<td>-</td>';
		}
			
		echo '</tr>';
    }
	
echo '</table>';

require_once('pagecomponents/closeConnection.php');
?>
