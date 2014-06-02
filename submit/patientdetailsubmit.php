<?php
// @author: Krissy O'Farrell, 08854114
// Last modified on: 25/05/2014
// Last modified by: Kira Jamison, 08795428

/* James' code
	if(isset($_POST['Aname'])) {

		$checked = implode(',', $_POST['Aname']);  

	} else {

		$checked = "nothing";

	}
*/


require_once('../pagecomponents/validate.php');
require_once('../pagecomponents/connectDB.php');
$pagetitle="Form Submited";	
    include ("../pagecomponents/indexinclude.php");
	
$validate = new Validate();
$validated_POST = $validate->post();
$first_name=$validated_POST["first-name"];
$middle_name=$validated_POST["middle-name"];
$last_name=$validated_POST["last-name"];

if ($validated_POST["sex"] === 'female')
	$gender='F';
else
	$gender='M';
	
$DOB=$validated_POST["DOB"];
//$DOD=$validated_POST["DOD"];
//$gender=$validated_POST["gender"];


$medicare_number=$validated_POST["medicare-number"];
$medicare_exp=$validated_POST["medicare-exp"];
                                
$sql="UPDATE patient_details 
SET date_of_birth = '$DOB',
first_name = '$first_name',
middle_name = '$middle_name',
last_name = '$last_name', ";

if (ISSET($_POST["DOD"])) {
	if ($validated_POST["DOD"] !== 0)
		$sql = $sql . " date_of_death = '$DOD', ";
}

if(ISSET($_POST['Aname'])) {

	$allergies = implode(',', $_POST['Aname']); 

}

if(ISSET($_POST['Cname'])) {

	$conditions = implode(',', $_POST['Cname']); 

}

$sql = $sql . " gender = '$gender', 
			medicare_number = '$medicare_number',
			medicare_expiry_date = '$medicare_exp'
			WHERE patient_id = " . $_SESSION['patient_id'];

$result=mysqli_query($con,$sql);
if ($result !== false)
	$msg = 'Success, patient details have been updated.';
else
	$msg = 'Failed to update patient details.';

	// Update the allergies and conditions
// check if record exists!
$sql = "SELECT * FROM medical_history WHERE patient_id = ". $_SESSION['patient_id'];
$result=mysqli_query($con,$sql);
if ($result !== false) { // record exists, update operation
	if (strlen($allergies) > 0 && strlen($conditions) > 0) {
		$sql = "UPDATE medical_history
				SET allergies = '$allergies',
				conditions = '$conditions'
				WHERE patient_id = " . $_SESSION['patient_id'];
	} else if (strlen($allergies) > 0) {
		$sql = "UPDATE medical_history
				SET allergies = '$allergies'
				WHERE patient_id = " . $_SESSION['patient_id'];
	} else if (strlen($conditions) > 0) {
		$sql = "UPDATE medical_history
				SET conditions = '$conditions'
				WHERE patient_id = " . $_SESSION['patient_id'];
	} else {
		$sql = '';
	}
} else {	// no record, insert operation
	if (strlen($allergies) > 0 && strlen($conditions) > 0) {
		$sql = "INSERT into medical_history
				(patient_id, allergies, conditions)
				VALUES (" . $_SESSION['patient_id'] . ", '" . $allergies . "', '" . $conditions . "')";
	} else if (strlen($allergies) > 0) {
		$sql = "INSERT into medical_history
				(patient_id, allergies)
				VALUES (" . $_SESSION['patient_id'] . ", '" . $allergies . "')";
	} else if (strlen($conditions) > 0) {
		$sql = "INSERT into medical_history
				(patient_id, conditions)
				VALUES (" . $_SESSION['patient_id'] . ", '" . $conditions . "')";
	} else {
		$sql = '';
	}
}

// execute the query
if (strlen($sql) > 0) {
	$result=mysqli_query($con,$sql);
	
	if ($result !== false)
		$msg = $msg . "<br>Success, patient's medical details have been updated.";
	else
		$msg = $msg . "<br>Failed to update patient's medical details.";
}

//require_once('../pagecomponents/closeConnection.php');
?>
<html>
    <head>
    </head>
    <body>
        <?php echo $msg;?> 
    </body>
</html>