<?php
session_start();
require_once('../pagecomponents/validate.php');
$con=mysqli_connect("mysql.Firelabs.com.au","inb201harmony","6wxPSiPp","inb201harmony");
if(!$con )
{
  die('Could not connect: ' . mysql_error());
}
$validate = new Validate();
$validated_POST = $validate->post();

$notes =$validated_POST["notes"];
//$Medication=$validated_POST["Medication"];
$fname =$validated_POST["FirstName"];
$lname =$validated_POST["LastName"];

$sql="
Update medical_history
JOIN patient_details 
ON patient_details.patient_id = medical_history.patient_id
SET medical_history.nurses_notes='$notes' 
WHERE patient_details.first_name = '$fname' AND patient_details.last_name = '$lname';";

$result=mysqli_query($con,$sql);
echo success;
?>
