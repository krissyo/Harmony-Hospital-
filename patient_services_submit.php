<?php session_start();
require_once('../pagecomponents/validate.php');

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

/*
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {
} */

	$sql='UPDATE patient_services
	SET staff_id = ' . $staffId . ', procedure_id = ' . $procedureId . ', 
	service_start_date = ' . $startDate . ', service_end_date = ' . $endDate . ', 
	guardian_signature = ' . $signature . ', consent_date = ' . $consentDate . ',
	last_updated_by = ' . $lastUpdatedBy .
	' WHERE patient_procedure_id = ' . $_SESSION["patientProcedureId"];
	
	$result=mysqli_query($con, $sql);

	if ($result == 1) {
		echo "Update successful.";
	} else {
		echo "Error occurred. " . mysqli_errno() . " " . mysqli_error();
	}

	
?>