<?php
require_once('../pagecomponents/validate.php');
$con=mysqli_connect("mysql.Firelabs.com.au","inb201harmony","6wxPSiPp","inb201harmony");
if(!$con )
{
  die('Could not connect: ' . mysql_error());
}
$validate = new Validate();
$validated_POST = $validate->post();
$first-name=$validated_POST["first-name"];
$middle-name=$validated_POST["middle-name"];
$last-name=$validated_POST["last-name"];
$gender=$validated_POST["gender"];
$DOB=$validated_POST["DOB"];
$DOD=$validated_POST["DOD"];
$gender=$validated_POST["gender"];
$allergies=$validated_POST["allergies"];
$conditions=$validated_POST["conditions"];
$medicare-number=$validated_POST["medicare-number"];
$medicare-exp=$validated_POST["medicare-exp"];
                                
$sql="UPDATE patient_details SET date_of_death=$dateofdeath WHERE patient_id=$patientid;";
$result=mysqli_query($con,$sql);
echo $result;
?>
