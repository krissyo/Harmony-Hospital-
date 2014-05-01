<?php
$wardId = intval($_GET['q']);

require_once ("pagecomponents/connectDB.php");

if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

$sql='SELECT bed_id, bed_description from beds WHERE ward_id = ' . $wardId . ' ORDER BY bed_id';
	
$result=mysqli_query($con,$sql);

  echo "<option value="WardDefault">-- please select a bed --</option>";

	while($row = mysqli_fetch_array($result)){
		echo "<option value='" . $row["bed_id"] . "'>" . $row["bed_description"] . "</option>";
    }
	
?>



<td><select name="selectBed" id="selectBed" required></td>