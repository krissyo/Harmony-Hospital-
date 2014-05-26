<?php
// @author: Krissy O'Farrell, 08854114
// Last modified on: 25/05/2014
session_start();
require_once('../pagecomponents/validate.php');
require_once('../pagecomponents/connectDB.php');
$pagetitle="Notes Submited";	
    include ("../pagecomponents/indexinclude.php");
$validate = new Validate();
$validated_POST = $validate->post();
$patientid = $_SESSION['passingID'];
$notes =$validated_POST["notes"];
$lastupdated = $_SESSION["Name"];
//$Medication=$validated_POST["Medication"];


$sql1= "SELECT * FROM medical_history WHERE patient_id='$patientid'";
$result=mysqli_query($con,$sql1);
$sql2= "UPDATE medical_history
                SET doctors_notes ='$notes', patient_id='$patientid', last_updated_by = '$lastupdated'
                WHERE patient_id = " . $patientid .'';

$sql3= "INSERT INTO medical_history (patient_id,doctors_notes, last_updated_by)
                    VALUES ('$patientid','$notes','$lastupdated')";
                
    
   if(mysqli_num_rows($result) > 0) {
    mysqli_query($con,$sql2);
       echo "Notes Updated";     // if user in table update notes
   }
    else{
         mysqli_query($con,$sql3);
        echo "notes added";     // if user isnt in table insert
    }
require_once('../pagecomponents/closeConnection.php');
?>

