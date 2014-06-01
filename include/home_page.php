<?php
function getHomePage($roleId) {

	require("pagecomponents/connectDB.php");
	$sql = "SELECT home_page from roles 
			WHERE role_id = " . $roleId;
			
	$result = mysqli_query($con,$sql); 
	
	if ($result !== false) {
		$row = mysqli_fetch_array($result);
		if ($row !== false) 
			return $row['home_page'];
		else
			return "'search.inc'";
	} else {
		// return a default home page, search form?
		return "'search.inc'";
	}
}
?>