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
$staffid=$_SESSION["userID"];
$startdate=$validated_POST["AnnualLeaveStart"];
$enddate=$validated_POST["AnnualLeaveEnd"];
$approvingofficer=$validated_POST["ApprovingOfficer"];               
                
$sql="UPDATE staff_details SET annual_leave_start=$startdate, annual_leave_end=$enddate, approving_officer=$approvingofficer WHERE staff_id=$staffid;";
$result=mysqli_query($con,$sql);
echo $result;
?>