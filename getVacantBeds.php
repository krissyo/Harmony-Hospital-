<?php
require_once("pagecomponents/connectDB.php");

$dptId = intval($_GET['q']);

$sql="SELECT bed_id, bed_description 
FROM beds
INNER JOIN wards
ON beds.ward_id = wards.ward_id
WHERE wards.department_id = " . $dptId .
" AND bed_id NOT IN (SELECT bed_id FROM admissions WHERE discharge_date IS NULL)";

$result = mysqli_query($con,$sql);

 echo "<option value='default'>-- please select a bed --</option>";

	while($row = mysqli_fetch_array($result)){
		echo "<option value='" . $row["bed_id"] . "'>" . $row["bed_description"] . "</option>";
    }

require_once('pagecomponents/closeConnection.php');
?>