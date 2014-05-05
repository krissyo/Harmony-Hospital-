<html>
<?php
include ('loadResourceForm.inc');

if (ISSET($_POST['new_bed'])) {
	$newBedName = $_POST['new_bed'];
} else {
	$newBedName = '';
}

if ($_POST['selectWard'] != 'WardDefault'){

	$object = 'bed';
	
} else if ($_POST['selectDpmnt'] != 'deptDefault') {

	$object = 'ward';
	
} else {
	$object = 'dpt';
}

if (ISSET($_POST['record_id'])) {
	$objectId = $_POST['record_id'];
}

if (ISSET($_POST['submit'])) {
	if ($_POST['submit'] == 'Update') {
		$operation = 'update';
		loadResource ($object, $objectID, $operation, $newBedName);
		
	} else if ($_POST['submit'] == 'Add New') {
		$operation = 'add';
	} else if ($_POST['submit'] == 'Delete') {
		$operation = 'delete';
	}
} ?>

</html>


