<?php
$wardId = intval($_GET['q']);

require_once ("pagecomponents/connectDB.php");

$sql='SELECT bed_id, bed_description from beds WHERE ward_id = ' . $wardId . ' ORDER BY bed_id';
	
$result=mysqli_query($con,$sql);

  echo "<option value='BedDefault'>-- please select a bed --</option>";

	while($row = mysqli_fetch_array($result)){
		echo "<option value='" . $row["bed_id"] . "'>" . $row["bed_description"] . "</option>";
    }

require_once('pagecomponents/closeConnection.php');
	
?>
