<?php
require_once('../pagecomponents/validate.php');
require_once('../pagecomponents/connectDB.php');

$validate = new Validate();
$validated_POST = $validate->post();
$patientid= (int)$validated_POST["PatientId"];
$authorisingperson=$validated_POST["authorising"];
$dateofdeath=$validated_POST["DateOfDeath"];

$sql="UPDATE patient_details SET date_of_death=$dateofdeath WHERE patient_id=$patientid;";
$result=mysqli_query($con,$sql);
echo $result;

require_once('../pagecomponents/closeConnection.php');
?>

