<?php
$departmentId = intval($_GET['q']);

require ("pagecomponents/connectDB.php");

$sql='SELECT ward_id, ward_description from wards WHERE department_id = ' . $departmentId . ' ORDER BY ward_id';
	
$result=mysqli_query($con,$sql);

 echo "<option value='WardDefault'>-- please select a ward --</option>";

	while($row = mysqli_fetch_array($result)){
		echo "<option value='" . $row["ward_id"] . "'>" . $row["ward_description"] . "</option>";
    }

require_once('pagecomponents/closeConnection.php');
?>
