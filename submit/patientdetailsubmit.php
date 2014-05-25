<?php
// @author: Krissy O'Farrell, 08854114
// Last modified on: 25/05/2014
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
$DOD=$validated_POST["DOD"];
$gender=$validated_POST["gender"];
$allergies=$validated_POST["allergies"];
$conditions=$validated_POST["conditions"];
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

$sql = $sql . " gender = '$gender', 
			medicare_number = '$medicare_number',
			medicare_expiry_date = '$medicare_exp'
			WHERE patient_id = " . $_SESSION['patient_id'];

$result=mysqli_query($con,$sql);
if ($result !== false)
	$msg = 'Success, patient details have been updated.';
else
	$msg = 'Failed to update patient details.';

require_once('../pagecomponents/closeConnection.php');
?>
<html>
    <head>
    </head>
    <body>
        <?php echo $msg;?> 
    </body>
</html>