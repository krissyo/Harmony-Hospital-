<?php
session_start();
require_once('../pagecomponents/validate.php');
require_once('../pagecomponents/connectDB.php');

$validate = new Validate();
$validated_POST = $validate->post();

$fname =$validated_POST["FirstName"];
$lname =$validated_POST["LastName"];
$aname=$validated_POST["Aname"];
$cname=$validated_POST["Cname"];
$DOB=$validated_POST["DateofBirth"];
$date=$validated_POST["Date"];

$aname= implode($aname,',');
$cname= implode($cname,',');


$sql=" INSERT INTO patient_details (first_name, last_name, date_of_birth)
       VALUES ('".$fname."', '".$lname."', '".$DOB."')";

$result=mysqli_query($con,$sql);


$sql_1="INSERT INTO medical_history (allergies, conditions)
       VALUES ('".$aname."', '".$cname."')";

$result=mysqli_query($con,$sql_1);

$sql_2="INSERT INTO admissions (admission_date)
        VALUES ('".$date."')";

$result=mysqli_query($con,$sql_2);

echo Successful;

//$sql_1="UPDATE medical_history 
//JOIN patient_details
//ON patient_details.patient_id = medical_history.patient_id
//SET medical_history.allergies='$aname', medical_history.conditions='$cname'
//WHERE patient_details.first_name = '$fname' AND patient_details.last_name = '$lname';";                    




require_once('../pagecomponents/closeConnection.php');
?>


<!--

Allergies - medicalhistory
conditions - medical history-->


