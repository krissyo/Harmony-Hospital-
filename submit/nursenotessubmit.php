<?php
session_start();
require_once('../pagecomponents/validate.php');
require_once('../pagecomponents/connectDB.php');
$pagetitle="Notes Submited";	
    include ("../pagecomponents/indexinclude.php");
$validate = new Validate();
$validated_POST = $validate->post();
$notes =$validated_POST["notes"];
$patientid = $_SESSION['passingID'];
$lastupdated = $_SESSION["userID"]

$sql1= "SELECT * FROM medical_history WHERE patient_id='$patientid'";
$result=mysqli_query($con,$sql1);
$sql2= "UPDATE medical_history
                SET nurses_notes ='$notes', patient_id='$patientid', last_updated_by = '$lastupdated'
                WHERE patient_id = " . $patientid .'';

$sql3= "INSERT INTO medical_history (patient_id,nurses_notes, last_updated_by)
                    VALUES ('$patientid','$notes','$lastupdated')";
                
    
   if(mysqli_num_rows($result) > 0) {
    mysqli_query($con,$sql2);
       echo "notes updated";
   }
    else{
         mysqli_query($con,$sql3);
        echo "notes added";
    
    }
          

require_once('../pagecomponents/closeConnection.php');
?>
<html>
    <head>
    </head>
    <body>
        Success, notes have been added. 
    </body>
</html>

