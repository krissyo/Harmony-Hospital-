<?php
echo 'I am in department_list.php';
require ("pagecomponents/connectDB.php");


$sql = 'SELECT department_id, department_description, department_prefix, number_of_wards
		FROM departments ORDER BY department_id';
	
$result=mysqli_query($con,$sql);

echo 'I am in department_list.php';

 echo '<table id="details" >';
 
 // column headings
echo '<tr><th>Id</th><th>Prefix</th><th>Desc</th><th>Num of wards</th><th>Admissions</th></tr>';

	while($row = mysqli_fetch_array($result)){
			echo '<tr>';
			echo '<td>' . $row["department_id"] . '</td>';
			echo '<td>' . $row["department_prefix"] . '</td>';
			echo '<td>' . $row["department_description"] . '</td>';
			echo '<td>' . $row["number_of_wards"] . '</td>';
			
			// display number of admissions for this department
			$sql = 'SELECT Count(admission_id) as num_adm from admissions
				natural join beds natural join wards 
				where department_id = ' . $row["department_id"];
			
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

require_once('pagecomponents/closeConnection.php');
?>
