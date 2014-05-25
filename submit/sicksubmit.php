<?php
// @author: Krissy O'Farrell, 08854114
// Last modified on: 25/05/2014
session_start();
require_once('../pagecomponents/validate.php');
require_once('../pagecomponents/connectDB.php');
$pagetitle="Form Submited";	
    include ("../pagecomponents/indexinclude.php");
$validate = new Validate();
$validated_POST = $validate->post();
$staffid=$_SESSION["userID"];
$startdate=$validated_POST["StartDate"];
$enddate=$_POST["EndDate"];
$doctorscertificate=$validated_POST["certificate"];

$sql="UPDATE staff_details SET sick_leave_start=$startdate, sick_leave_end=$enddate, sick_leave_cert=$doctorscertificate WHERE staff_id=$staffid;";
$result=mysqli_query($con,$sql);
echo $result . "Success, your sick leave has been submitted.";

require_once('../pagecomponents/closeConnection.php');
?>
