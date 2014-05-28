<?php
// Author: Kira Jamison, 08795428
require_once("pagecomponents/connectDB.php");

$roleId = intval($_GET['q']);

$sql="SELECT DISTINCT name
FROM sub_nav
WHERE role_id <> " . $roleId;

$result = mysqli_query($con,$sql);


if ($result !== false) {
	echo '<label><b>New Items</b></label><br/>';
	echo "<select name = 'name' onchange='displayURLdetails(this.value);'>";

	while($row = mysqli_fetch_array($result)){
		echo "<option value='" . $row["name"] . "'>" . $row["name"] . "</option>";
    }
	
	echo "</select>";
	
} else {
	echo 'No results';
}

require_once('pagecomponents/closeConnection.php');
?>