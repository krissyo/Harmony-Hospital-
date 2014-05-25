<?php
// @author: Krissy O'Farrell, 08854114
// Last modified on: 25/05/2014
session_start();
$pagetitle="Form Submitted";	
    include ("../pagecomponents/indexinclude.php");
require_once('../pagecomponents/validate.php');
require_once('../pagecomponents/connectDB.php');

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
echo "Success, the hospital transfer has been submitted";
    
require_once('../pagecomponents/closeConnection.php');    
?>    
