<?php
session_start();
$pagetitle="Add / Update a Resource";
include("pagecomponents/head.php");
require_once 'pagecomponents/validate_resource_mgt.inc';
require_once ("pagecomponents/connectDB.php");


// If the form posted to itself, check for errors
if (ISSET($_POST['submit'])) {

	//validate here
	$errors = array();
	validate_bed_form($errors);
	
	if (count($errors) === 0) {
		require 'submit/success_resource_post.inc';
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
	require 'include/beds_session_vars.inc';
	require 'include/determine_operation.inc';
}
?>

	</div>
<?php
include("pagecomponents/footer.php");
?>

</div>    
</body>
</html>   	
