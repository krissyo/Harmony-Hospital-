<?php 
// @author: Krissy O'Farrell, 08854114
// Last modified on: 25/05/2014
session_start();
require_once('../pagecomponents/connectDB.php');
require_once('../pagecomponents/validate.php');
$pagetitle="Form Submited";	
    include ("../pagecomponents/indexinclude.php");
$validate = new Validate();
$validated_POST = $validate->post();
$staffid=$_SESSION["userID"];
$startdate=$validated_POST["AnnualLeaveStart"];
$enddate=$validated_POST["AnnualLeaveEnd"];
$approvingofficer=$validated_POST["ApprovingOfficer"];               
                
$sql="UPDATE staff_details SET annual_leave_start=$startdate, annual_leave_end=$enddate, approving_officer=$approvingofficer WHERE staff_id=$staffid;";
$result=mysqli_query($con,$sql);
echo $result . "Success, your Annual Leave has been submitted.";

require_once('../pagecomponents/closeConnection.php');
?>
