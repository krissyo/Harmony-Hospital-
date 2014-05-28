<?php
// Author: Kira Jamison, 08795428
require_once("pagecomponents/connectDB.php");

$roleId = intval($_GET['q']);

$sql="SELECT name
FROM top_nav
WHERE role_id = " . $roleId . " or role_id = 0";

$result = mysqli_query($con,$sql);


if ($result !== false) {
	while($row = mysqli_fetch_array($result)){
		echo $row["name"] . '; ';
    }
} else {
	echo 'No results';
}

require_once('pagecomponents/closeConnection.php');
?>