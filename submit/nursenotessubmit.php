<?php
// Author James Clelland n8888141
// Last modified by Armin Khoshbin on 28/05/2014
session_start();
require_once('../pagecomponents/validate.php');
require_once('../pagecomponents/connectDB.php');
$pagetitle="Notes Submited";	
    include ("../pagecomponents/indexinclude.php");
$validate = new Validate();
$validated_POST = $validate->post();
$notes =$validated_POST["notes"];
$patientid = $_SESSION["patient_id"]; 
$lastupdated = $_SESSION["Name"];
date_default_timezone_set('Australia/Brisbane');
$dateTime = date('Y-m-d H:i:s');

$sql1= "SELECT * FROM medical_history WHERE patient_id='$patientid'";
$result=mysqli_query($con,$sql1);
$sql2= "UPDATE medical_history
                SET nurses_notes ='$notes', patient_id='$patientid', last_updated_by_nurse = '$lastupdated', time_stamp_nurse ='$dateTime' WHERE patient_id = " . $patientid .'';

$sql3= "INSERT INTO medical_history (patient_id,nurses_notes, last_updated_by_nurse, time_stamp_nurse)
                    VALUES ('$patientid','$notes','$lastupdated', '$dateTime')";
                
    
 if(mysqli_num_rows($result) > 0) {
    mysqli_query($con,$sql2);
       echo "Success, Notes have been added";     // if user in table update notes
   }
    else{
         mysqli_query($con,$sql3);
        echo "Success, Notes have been added";     // if user isnt in table insert
    }
          

require_once('../pagecomponents/closeConnection.php');
?>
<html>
    <head>
    </head>
    <body>
    </body>
</html>

