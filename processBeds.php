<?php
session_start();
$pagetitle="Add / Update a Resource";
include("pagecomponents/head.php");
require_once 'validate.inc';
require_once ("pagecomponents/connectDB.php");


// If the form posted to itself, check for errors
if (ISSET($_POST['submit'])) {

	//validate here
	$errors = array();
	validatePattern($errors, $_POST, 'description', '/^[a-zA-Z0-9\_\- ]+$/');
	if ($_SESSION['object'] != 'Bed') {
		validatePattern($errors, $_POST, 'prefix', '/^[a-zA-Z0-9\_\- ]+$/');
		validateLength($errors, $_POST['prefix'], 8);
	}
	
	if (count($errors) === 0) {
		require 'success_resource_post.inc';
	} else {
		echo '<h2>Error - please correct the problems listed below</h2>';
		require 'resourceForm.php';
	}
} else {

	?>
		<script src="<?php $_SERVER["DOCUMENT_ROOT"] ?>/harmonyhospital/lib/buttonClickLink.js"></script>
		
		<div id="wrapper">
			<div id="header">
				<h1>ADD / UPDATE RESOURCES</h1>
			</div>
		<div id="content">
	<?php
	// Grab details from bedManagement Form
	//as this form loads for the first time
	if (ISSET($_POST['new_bed'])) {
		$_SESSION['newBedName']  = $_POST['new_bed'];
	} else {
		$_SESSION['newBedName'] = '';
	}

	if ($_POST['selectWard'] != 'WardDefault'){

		$_SESSION['object'] = 'Bed';
		$_SESSION['parentId'] = $_POST['selectWard'];
		
	} else if ($_POST['selectDpmnt'] != 'deptDefault') {

		$_SESSION['object'] = 'Ward';
		$_SESSION['parentId'] = $_POST['selectDpmnt'];
		
	} else {
		$_SESSION['object'] = 'Department';
	}

	if (ISSET($_POST['record_id'])) {
		$_SESSION['objectId'] = $_POST['record_id'];
	} else {
		$_SESSION['objectId'] = 0;
	}

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
		}
	} 

}
?>

	</div>
<?php
include("pagecomponents/footer.php");
?>

</div>    
</body>
</html>   	
