<?php
// Author James Clelland 08888141
session_start();
require_once('../pagecomponents/validate.php');
require_once('../pagecomponents/connectDB.php');
$pagetitle="Notes Submited";	
    include ("../pagecomponents/indexinclude.php");

$validate = new Validate();
$validated_POST = $validate->post();

$departmentid=$validated_POST["departmentid"];
$resourcename=$validated_POST["resourcename"];

        $sql="INSERT INTO resources (resource_description, department_id)
        VALUES ('$resourcename', '$departmentid')";
        $result=mysqli_query($con,$sql);
        echo "Resouce has been added"
 ?>