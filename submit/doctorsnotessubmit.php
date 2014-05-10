<?php
session_start();
require_once('../pagecomponents/validate.php');
require_once('../pagecomponents/connectDB.php');

$validate = new Validate();
$validated_POST = $validate->post();
$patientid = $_SESSION['passingID'];
$notes =$validated_POST["notes"];
//$Medication=$validated_POST["Medication"];


$sql1= "SELECT * FROM medical_history WHERE patient_id='$patientid'";
$result=mysqli_query($con,$sql1);
$sql2= "UPDATE medical_history
                SET doctors_notes ='$notes', patient_id='$patientid'
                WHERE patient_id = " . $patientid .'';

$sql3= "INSERT INTO medical_history (patient_id,doctors_notes)
                    VALUES ('$patientid','$notes')";
                
    
   if(mysqli_num_rows($result) > 0) {
    mysqli_query($con,$sql2);                         // Updating notes
       echo "notes updated";
   }
    else{
         mysqli_query($con,$sql3);                   // adding notes
        echo "notes added";
    
    }
       

require_once('../pagecomponents/closeConnection.php');
?>
