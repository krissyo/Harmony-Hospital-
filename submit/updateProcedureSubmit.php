<?php
session_start();
require_once('../pagecomponents/validate.php');
require_once('../pagecomponents/connectDB.php');

$pagetitle="Submitted"; 
    include ("../pagecomponents/indexinclude.php");
$validate = new Validate();
$validated_POST = $validate->post();
$procedure= $validated_POST["procedure"];
$fee=$validated_POST["newFee"];
$rebate=$validated_POST["newRebate"];


if($fee >= $rebate){
    $sql="UPDATE procedure_listing
    SET procedure_fee='$fee', medicare_rebate='$rebate'
    WHERE procedure_id='$procedure';";
    $result=mysqli_query($con,$sql);
    echo "Procedure Update Successful";
}


require_once('../pagecomponents/closeConnection.php');
?>
