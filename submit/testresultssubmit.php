<?php
// Author James Clelland n8888141
// Modified by Kira Jamison, n8795428
session_start();
require_once('../pagecomponents/validate.php');
require_once('../pagecomponents/connectDB.php');
$pagetitle="Form Submited";	
include ("../pagecomponents/indexinclude.php");
include ('../pagecomponents/validate_resource_mgt.inc');
	
$validate = new Validate();
$validated_POST = $validate->post();

$patientid = $_SESSION["patient_id"]; 
$procedureid=$validated_POST["ProID"];
$medicalnotes=$validated_POST["notes"];
$lastupdated = $_SESSION["userID"];

// validate notes for any illegal characters/strings
$errors = array();
checkInvalidCharacters($errors, $_POST, 'notes');

if (count($errors) !== 0) {
	echo 'Medical Notes are missing or contain invalid characters. Please try again.';

} else {


    $_POST ['Submit'];
    $name=$_FILES['MedicalImaging']['name'];
    $temp=$_FILES['MedicalImaging']['tmp_name'];
    $type=$_FILES ['MedicalImaging']['type'];
    $size=$_FILES ['MedicalImaging']['size'];
    $pathdir= '../testresultsimg/';
    $filepath = $pathdir . $name;
	$todaysDate = date('Y-m-d');

	$sql3= "INSERT INTO clinical_history_detail (patient_id, date_entered, test_notes,medical_image, last_updated_by)
			VALUES ('$patientid',$todaysDate, '$medicalnotes','$name','$lastupdated')";

      //specify type of image          
     if (($type =="image/jpeg") || ($type =="image/jpg") || ($type =="image/png")){  
			 //bytes (10mb)
			 if ($size <= 10000000){
				//uploading to server
				move_uploaded_file($temp,"../testresultsimg/$name");       
				mysqli_query($con,$sql3);
				echo "Success,notes have been added";     // if user isnt in table insert
					   
			}else{
				 echo "file size too big";
			}
	}else if ((IS_NULL($temp)) || ($temp === '')){ // just notes are being added, no image files
			mysqli_query($con,$sql3);
			echo "Success, notes have been added";     // if user isnt in table insert 
	} else {
			echo "File type not allowed, please try again. ";
	}
} // end validation
require_once('../pagecomponents/closeConnection.php');
?>

