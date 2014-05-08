<?php
$departmentId = intval($_GET['q']);
$firstRow = true;

require_once ("pagecomponents/connectDB.php");

/*
$sql='SELECT ward_id, ward_prefix, 
ward_description, COUNT(beds.bed_id) AS number_of_beds 
from wards natural join beds
WHERE wards.department_id = ' . $departmentId . 
' GROUP BY ward_id, ward_prefix, ward_description;';
*/

$sql = 'SELECT wards.ward_id, ward_prefix, 
ward_description, COUNT(beds.bed_id) AS number_of_beds 
from wards LEFT JOIN beds 
ON wards.ward_id = beds.ward_id 
WHERE wards.department_id = ' . $departmentId .  
' GROUP BY ward_id, ward_prefix, ward_description';
	
$result=mysqli_query($con,$sql);
 echo '<h3>Ward List</h3>';
 echo '<table id="details">';
 echo '<tr><th>Select</th><th>Prefix</th><th>Description</th><th>Num of beds</th><th>Admissions</th></tr>';
if ( $result !== false ) {
	while($row = mysqli_fetch_array($result)){
		echo '<tr>';
		//echo '<td>' . $row["ward_id"] . '</td>';
		if ($firstRow) {
			echo '<td><input type="radio" name="record_id" id = "record_id" value="' . $row['ward_id'] . '" checked></td>';
			$firstRow = false;
		} else {
			echo '<td><input type="radio" name="record_id" id = "record_id" value="' . $row['ward_id'] . '"></td>';
		}
		
		echo '<td>' . $row["ward_prefix"] . '</td>';
		echo '<td>' . $row["ward_description"] . '</td>';
		echo '<td>' . $row["number_of_beds"] . '</td>';
		
		// display number of admissions for each ward
		$sql = 'SELECT Count(admission_id) as num_adm from admissions
			natural join beds 
			where ward_id = ' . $row["ward_id"];
		
		$record = mysqli_query($con,$sql);	
		if( $record !== false )
			$num_rows = mysqli_num_rows($record);
			
			
			if ($num_rows > 0) {
				$count = mysqli_fetch_array($record);
				echo '<td>' . $count["num_adm"] . '</td>';
			} else {
				echo '<td>0</td>';
			}
			
		echo '</tr>';
    }
}	
echo '</table>';

require_once('pagecomponents/closeConnection.php');
?>
