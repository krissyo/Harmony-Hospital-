<?php
 // insert or update the database
 // display a success or failure message
if ($_SESSION['operation'] == 'Update') {

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

}

// execute the query
$result = mysqli_query($con,$sql);

if ( $result !== false ) {
	echo 'Successfully updated the selected '. $_SESSION['object'];
} else {
	echo 'Failed to update the selected '. $_SESSION['object'];
	echo $sql;
}
?>