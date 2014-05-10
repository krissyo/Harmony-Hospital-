<?php
	if (ISSET($_POST['load'])) {
		if ($_POST['load'] == 'Update') {
		
			$_SESSION['operation'] = 'Update';
			include 'resourceForm.php';
			
		} else if ($_POST['load'] == 'Add New') {
		
			$_SESSION['operation'] = 'Add';
			$_SESSION['objectId'] = 0;
			include 'resourceForm.php';
			
		} else if ($_POST['load'] == 'Delete') {
			
			$_SESSION['operation'] = 'Delete';
			
			// If there are no current admissions associated with this object,
			// allow the delete
			$checkCleared = checkDeleteAllowed($_SESSION['objectId'], $_SESSION['object']);
			
			if ($_SESSION['object'] == 'Department') {
			
				echo '<h2>Can not delete any Departments due to active resources.</h2>';
				include 'include/backToBedMgt.inc';

			} else if ($checkCleared) {
			
				require 'submit/success_resource_post.inc';
				
			} else {
			
				echo '<h2>Can not delete the selected ' . $_SESSION['object'] . ' due to active admissions.</h2>';
				include 'include/backToBedMgt.inc';
			}			
		}
	}
?>