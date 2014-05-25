<?php
 // insert or update the database
 // display a success or failure message
 $action = '';
if ($_SESSION['operation'] == 'Update') {
	$action = ' updated ';
	$sql = 'UPDATE ';
	
	if ($_SESSION['object'] == 'Department') {
		$sql = $sql . 'departments 
		SET department_description = "' . 
		$_POST['description'] . '", department_prefix = "' . $_POST['prefix'] . '"
		WHERE department_id = ' . $_SESSION['objectId'];
	} else if ($_SESSION['object'] == 'Ward') {
		$sql = $sql . 'wards 
		SET ward_description = "' . $_POST['description'] . 
		'", ward_prefix = "' . $_POST['prefix'] . '"
		WHERE ward_id = ' . $_SESSION['objectId'];
	} else if ($_SESSION['object'] == 'Bed') {
		$sql = $sql . 'beds 
		SET bed_description = "' . $_POST['description'] . '"
		WHERE bed_id = ' . $_SESSION['objectId'];
	}

	
} else if ($_SESSION['operation'] == 'Add') {

	$action = ' added ';
	$sql = 'INSERT INTO ';
	
	if ($_SESSION['object'] == 'Department') {
		$sql = $sql . 'departments (department_description, department_prefix) 
		VALUES ("' . $_POST['description'] . '", "' . $_POST['prefix'] . '")';
	} else if ($_SESSION['object'] == 'Ward') {
		$sql = $sql . 'wards (ward_description, ward_prefix, department_id) 
		VALUES ("' . $_POST['description'] . '", "' . $_POST['prefix'] . '", ' . $_SESSION['parentId'] . ')';
	} else if ($_SESSION['object'] == 'Bed') {
		$sql = $sql . 'beds (bed_description, ward_id) 
		VALUES ("' . $_POST['description'] . '", ' . $_SESSION['parentId'] . ')';
	}

} else if ($_SESSION['operation'] == 'Delete') {

	$action = ' deleted ';
	// Can not delete departments! as they are used in the "resources" table
	if ($_SESSION['object'] == 'Ward') {
	
		// also need to delete all beds associated with this ward
		$sql = 'DELETE FROM beds WHERE ward_id = ' . $_SESSION['objectId'];
		
		// execute the 1st query to delete associated beds
		$result = mysqli_query($con,$sql);
		
		// Deleting wards now
		$sql = 'DELETE FROM wards WHERE ward_id = ' . $_SESSION['objectId'];
		// 2nd query will be executed below to delete the ward record
		
	} else if ($_SESSION['object'] == 'Bed') {
		$sql = 'DELETE FROM beds WHERE bed_id = ' . $_SESSION['objectId'];
	}
	
}

// execute the query
$result = mysqli_query($con,$sql);

//$row = mysqli_fetch_array($result);
?>

<table><tr><td></td><td>

<?php
if ($result !== false) {
	echo 'Successfully' . $action . 'the selected '. $_SESSION['object'];
} else {
	echo 'Failed to perform the ' . $_SESSION['operation'] . ' on the selected ' . $_SESSION['object'];
	
}
?>
</td></tr>

<tr><td></td>
	<td><input class="rounded" type="button" onclick="location.href = 'bedmanagement.php'"
		name="submit" id="backToBedMgt" value="Back"></td>
</tr>
</table>