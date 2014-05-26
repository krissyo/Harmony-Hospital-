<?php
// @author: Krissy O'Farrell, 08854114
// Last modified on: 25/05/2014
require_once('../pagecomponents/validate.php');
require_once('../pagecomponents/connectDB.php');
$pagetitle="Submitted";	
    include ("../pagecomponents/indexinclude.php");
$validate = new Validate();
$validated_POST = $validate->post();

$patientid = $_SESSION["patient_id"]; 
$authorisingperson=$validated_POST["AuthPerson"];
$DOD=$validated_POST["DOD"];

$sql="UPDATE patient_details SET date_of_death='$DOD', authorising_person='$authorisingperson' WHERE patient_id='$patientid';";
$result=mysqli_query($con,$sql);
echo "Notification of Death has been submitted";

require_once('../pagecomponents/closeConnection.php');
?>

