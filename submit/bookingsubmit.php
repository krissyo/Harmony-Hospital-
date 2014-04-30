<?php session_start();
require_once('../pagecomponents/validate.php');
require_once('../pagecomponents/checkResourceAvailability.php');
require_once('../pagecomponents/checkPatientAvailability.php');
require_once('../pagecomponents/signature-to-image.php');

$validate = new Validate();
$validated_POST = $validate->post();

# Getting the signature output from consent form
$signature = $validated_POST["output"];
$guardian_name = $validated_POST["GuardianName"];

# Converting the output to an image file
$img = sigJsonToImage($signature);
# Saving the image file on server
imagepng($img, '../signatureimg/' . $guardian_name . '_'. 'signature.png');
$imgName = $guardian_name . "_". "signature.png";
# Cleaning up the image resource to free some memory! :)
imagedestroy($img);

// Getting the rest of the fields from the Bookings Form
$admissionId = (int)$validated_POST["AdmissionId"];
$procedureId = (int)$validated_POST["ProcedureId"];
$staffId = (int)$validated_POST["StaffId"];
$resourceId = (int)$validated_POST["ResourceId"];
$bookingDate = "'" . $validated_POST["StartDate"] . "'";
$startTime = "'" . $validated_POST["StartTime"] . "'";
$finishTime = "'" . $validated_POST["FinishTime"] . "'";
$consentDate = "'" . $validated_POST["ConsentDate"] . "'";
$imgName = "'" . $imgName . "'";
$guardian_name = "'" . $guardian_name . "'";

if (isset($_SESSION["userID"])) {
	$lastUpdatedBy = $_SESSION["userID"];
} else {
	$lastUpdatedBy = 100076;
}

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$resource_availability = new ResourceAvailability();
$checkResourceBooking = $resource_availability->post();

$patient_availability = new PatientAvailability();
$checkPatientBooking = $patient_availability->post();

if (($checkResourceBooking == 0) && ($checkPatientBooking == 0)) {
	$sql="INSERT INTO bookings (admission_id, procedure_id, resource_id, staff_id, booking_date,
	start_time, finish_time, last_updated_by) 
	VALUES ($admissionId, $procedureId, $resourceId, $staffId, $bookingDate,
	$startTime, $finishTime, $lastUpdatedBy);";

	$result=mysqli_query($con, $sql);

	if ($result == 1) {
		echo "Booking successful.";
		
		$sql = "INSERT INTO patient_services (admission_id, procedure_id, 
		staff_id, service_start_date, service_end_date, guardian_name,
		guardian_signature, consent_date, last_updated_by) 
		VALUES ($admissionId, $procedureId, $staffId,
		$bookingDate, $bookingDate, $guardian_name, " . $imgName . ", $consentDate, $lastUpdatedBy);";

		$result=mysqli_query($con, $sql);
		if ($result == 1) {
			echo "Recorded the Procedure on Patient's Account successfully.";
		} else {
			echo "Failed to record the Procedure on Patient's Account.";
		}
	} else {
			echo "Error occurred. ";
	}	

} else if (($checkResourceBooking == 1) && ($checkPatientBooking == 1)) {
	echo "Booking already exists for this Facility and the Patient for the selected date and times";
} else if ($checkResourceBooking == 1) {
	echo "Booking already exists for this Facility for the selected date and times.";
} else if ($checkPatientBooking == 1) {
	echo "Booking already exists for this Patient for the selected date and times.";
}

?>

<html>
	<head>
		<title>Harmony | Welcome</title>
        <link rel="shortcut icon" href="bandaid_bird_48x48.ico" type="image/x-icon" />
	</head>


</html>
