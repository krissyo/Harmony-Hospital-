<?php
session_start();
require_once('pagecomponents/validate.php');
$con=mysqli_connect("mysql.Firelabs.com.au","inb201harmony","6wxPSiPp","inb201harmony");
if(!$con )
{
  die('Could not connect: ' . mysql_error());
}
$validate = new Validate();
$validated_POST = $validate->post();
$staffid=$_SESSION["userID"];
$startdate=$validated_POST["StartDate"];
$enddate=$_POST["EndDate"];
$doctorscertificate=$validated_POST["certificate"];

$sql="UPDATE staff_details SET sick_leave_start=$startdate, sick_leave_end=$enddate, sick_leave_cert=$doctorscertificate WHERE staff_id=$staffid;";
$result=mysqli_query($con,$sql);
echo $result;
?>
