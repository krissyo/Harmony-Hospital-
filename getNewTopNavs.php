<?php
// Author: Kira Jamison, 08795428
require_once("pagecomponents/connectDB.php");

$roleId = intval($_GET['q']);

$sql="select distinct name 
	from top_nav where name not in 
	(select name from top_nav where role_id = " . $roleId . "
	or role_id = 0) 
	order by name";

$result = mysqli_query($con,$sql);


if ($result !== false) {
	echo '<label><b>Select New Item</b></label><br/>';
	//
	echo "<select name = 'name' onclick='display_top_URLdetails(this.value);'>";

	while($row = mysqli_fetch_array($result)){
		echo "<option value='" . $row["name"] . "'>" . $row["name"] . "</option>";
    }
	
	echo "</select>";
	
} else {
	echo 'The selected role has full access to all side tabs.';
}

require_once('pagecomponents/closeConnection.php');
?>