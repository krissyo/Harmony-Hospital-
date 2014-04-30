<?php
require_once('../pagecomponents/validate.php');

if(!$con )
{
  die('Could not connect: ' . mysql_error());
}
$validate = new Validate();
$validated_POST = $validate->post();
$LastName= $validated_POST["LastName"];
$DOB=$validated_POST["DOB"];
$DateAdmission=$validated_POST["DateAdmission"];
$FirstTreat=$validated_POST["FirstTreat"];
$procedures=$validated_POST["procedures"];
$procedureDate=$validated_POST["procedureDate"];
$department=$validated_POST["department"];
$ward=$validated_POST["ward"];
$bed=$validated_POST["bed"];
$docNotes=$validated_POST["docNotes"];


$sql="INSERT INTO admissions VALUES (admission_Id	patient_id	bed_id FK	admission_date	discharge_date	resource_id	account_id	notes);";
$result=mysqli_query($con,$sql);
echo $result;
?>

                
             