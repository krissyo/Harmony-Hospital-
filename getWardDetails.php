<?php
$departmentId = intval($_GET['q']);

require_once ("pagecomponents/connectDB.php");

if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

$sql='SELECT ward_id, ward_description from wards WHERE department_id = ' . $departmentId . ' ORDER BY ward_id';
	
$result=mysqli_query($con,$sql);

                        
	while($row = mysqli_fetch_array($result)){
		echo "<option value='" . $row["ward_id"] . "'>" . $row["ward_description"] . "</option>";
    }
?>