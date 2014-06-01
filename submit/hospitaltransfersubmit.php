<?php
// @author: Krissy O'Farrell, 08854114
// Last modified by James Clelland 08888141 28/5/2013
session_start();
$pagetitle="Form Submitted";	
    include ("../pagecomponents/indexinclude.php");
require_once('../pagecomponents/validate.php');
require_once('../pagecomponents/connectDB.php');

$validate = new Validate();
$validated_POST = $validate->post();
$patientid = $_SESSION["patient_id"]; 

$datedischarged =$validated_POST["DateDis"];
$hospitaltransfer =$validated_POST["hospital"];
$notes = $validated_POST["notes"];
$lastupdated = $_SESSION["Name"];

$sql="  Update admissions
        JOIN patient_details 
        ON patient_details.patient_id = admissions.patient_id
        SET admissions.notes='$notes', admissions.discharge_date='$datedischarged', patient_details.hospital_transfer='$hospitaltransfer', admissions.last_updated_by='$lastupdated'
        WHERE patient_details.patient_id = '$patientid'";

$result=mysqli_query($con,$sql);
echo "Success, the hospital transfer has been submitted";
    
require_once('../pagecomponents/closeConnection.php');    
?>    
