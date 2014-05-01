<?php
$departmentId = intval($_GET['q']);

require ("pagecomponents/connectDB.php");

if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

$sql='SELECT ward_id, ward_prefix, ward_description, number_of_beds from wards WHERE department_id = ' . $departmentId . ' ORDER BY ward_id';
	
$result=mysqli_query($con,$sql);

 echo '<table id="details" >';
 echo '<tr><th>Id</th><th>Prefix</th><th>Description</th><th>Num of beds</th><th>Admissions</th></tr>';

	while($row = mysqli_fetch_array($result)){
		echo '<tr>';
		echo '<td>' . $row["ward_id"] . '</td>';
		echo '<td>' . $row["ward_prefix"] . '</td>';
		echo '<td>' . $row["ward_description"] . '</td>';
		echo '<td>' . $row["number_of_beds"] . '</td>';
		
		// display number of admissions for each ward
		$sql = 'SELECT Count(admission_id) as num_adm from admissions
			natural join beds 
			where ward_id = ' . $row["ward_id"];
		
		$record = mysqli_query($con,$sql);				
		$num_rows = mysqli_num_rows($record);
		
		
		if ($num_rows > 0) {
			$count = mysqli_fetch_array($record);
			echo '<td>' . $count["num_adm"] . '</td>';
		} else {
			echo '<td>0</td>';
		}
			
		echo '</tr>';
    }
	
echo '</table>';
?>