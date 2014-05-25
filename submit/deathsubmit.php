<?php
// @author: Krissy O'Farrell, 08854114
// Last modified on: 25/05/2014
require_once('../pagecomponents/validate.php');
require_once('../pagecomponents/connectDB.php');
$pagetitle="Submitted";	
    include ("../pagecomponents/indexinclude.php");
$validate = new Validate();
$validated_POST = $validate->post();
$patientid= (int)$validated_POST["PatientId"];
$authorisingperson=$validated_POST["authorising"];
$dateofdeath=$validated_POST["DateOfDeath"];

$sql="UPDATE patient_details SET date_of_death=$dateofdeath WHERE patient_id=$patientid;";
$result=mysqli_query($con,$sql);
echo $result . "Notification of Death has been submitted";

require_once('../pagecomponents/closeConnection.php');
?>

