<?php
session_start();
require_once('../pagecomponents/validate.php');

if(!$con )
{
  die('Could not connect: ' . mysql_error());
}
$validate = new Validate();
$validated_POST = $validate->post();


$patientid =$validated_POST["PatientId"];
$lname=$validated_POST["LastName"];
$datedis =$validated_POST["DateDis"];
$transfer =$validated_POST["Transfer"];
$notes =$validated_POST["notes"];

$sql="  Update admissions
        JOIN patient_details 
        ON patient_details.patient_id = admissions.patient_id
        SET admissions.discharge_date='$datedis', admissions.notes='$notes', patient_details.hospital_transfer='$transfer'
        WHERE patient_details.last_name = '$lname' AND patient_details.patientid = '$patientid'";

$result=mysqli_query($con,$sql);
echo success;
    
    
    
    
