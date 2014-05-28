<?php
// Author: Kira Jamison, 08795428
require_once("pagecomponents/connectDB.php");

$roleId = intval($_GET['q']);

$sql="select distinct name 
	from sub_nav where name not in 
	(select name from sub_nav where role_id = " . $roleId . "
	or role_id = 0) 
	order by name";

$result = mysqli_query($con,$sql);


if ($result !== false) {
	echo '<label><b>Select New Item</b></label><br/>';
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