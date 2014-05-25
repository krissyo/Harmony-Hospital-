<?php session_start();
require_once('../pagecomponents/validate.php');
require_once('../pagecomponents/connectDB.php');
$pagetitle="Submitted";	
    include ("../pagecomponents/indexinclude.php");
$validate = new Validate();
$validated_POST = $validate->post();

$procedureId = (int)$validated_POST["ProcedureId"];
$staffId = (int)$validated_POST["SpecialistId"];
$startDate = "'" . $validated_POST["StartDate"] . "'";
$endDate = "'" . $validated_POST["EndDate"] . "'";
$signature = "'" . $validated_POST["Signature"] . "'";
$consentDate = "'" . $validated_POST["ConsentDate"] . "'";

if (isset($_SESSION["userID"])) {
	$lastUpdatedBy = $_SESSION["userID"];
} else {
	$lastUpdatedBy = 100076;
}


	$sql='UPDATE patient_services
	SET staff_id = ' . $staffId . ', procedure_id = ' . $procedureId . ', 
	service_start_date = ' . $startDate . ', service_end_date = ' . $endDate . ', 
	guardian_signature = ' . $signature . ', consent_date = ' . $consentDate . ',
	last_updated_by = ' . $lastUpdatedBy .
	' WHERE patient_procedure_id = ' . $_SESSION["patientProcedureId"];
	
	$result=mysqli_query($con, $sql);

	if ($result == 1) {
		$msg = "Update successful.";
	} else {
		$msg = "Error occurred.";
	}
	
// Let the user know of the successful / failed update
// and display a Back to Patient Account button
require_once('../confirm_service_update.inc');
showMessage($msg);

require_once('../pagecomponents/closeConnection.php');	
?>
