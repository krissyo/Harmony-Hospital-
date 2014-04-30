<?php

require_once('connectDB.php');

	$sql="SELECT procedure_id, procedure_description FROM procedure_listing
		WHERE procedure_id <> 11;";
	$result=mysqli_query($con,$sql);
	while($row = mysqli_fetch_array($result)){
		echo "<option value='" . $row["procedure_id"] . "'>" . $row["procedure_description"] . "</option>";
}

require_once('closeConnection.php');
?>