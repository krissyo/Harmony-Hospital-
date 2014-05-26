<?php
// Author James Clelland n8888141
session_start();
require_once('../pagecomponents/validate.php');
require_once('../pagecomponents/connectDB.php');
	$pagetitle="Form Submited";	
    include ("../pagecomponents/indexinclude.php");
$validate = new Validate();
$validated_POST = $validate->post();

$patientid = $_SESSION["patient_id"]; 
$procedureid=$validated_POST["ProID"];
$medicalnotes=$validated_POST["notes"];
$lastupdated = $_SESSION["userID"];


    $_POST ['Submit'];
    $name=$_FILES['MedicalImaging']['name'];
    $temp=$_FILES['MedicalImaging']['tmp_name'];
    $type=$_FILES ['MedicalImaging']['type'];
    $size=$_FILES ['MedicalImaging']['size'];
    $pathdir= '../testresultsimg/';
    $filepath = $pathdir . $name;

$sql1= "SELECT * FROM clinical_history_detail WHERE patient_id='$patientid'";
$result=mysqli_query($con,$sql1);

$sql2=  "UPDATE clinical_history_detail
        SET procedure_id='$procedureid', patient_id='$patientid',test_notes='$medicalnotes', medical_image='$name', last_updated_by='$lastupdated'
        WHERE patient_id = " . $patientid .'';



$sql3= "INSERT INTO clinical_history_detail (patient_id,test_notes,medical_image,last_updated_by)
        VALUES ('$patientid','$medical_notes','$name','$lastupdated')";

      //specify type of image          
     if (($type =="image/jpeg") || ($type =="image/jpg") || ($type =="image/png")){  
         //bytes (10mb)
         if ($size <= 10000000){
             //uploading to server
             move_uploaded_file($temp,"../testresultsimg/$name");       
                if(mysqli_num_rows($result) > 0) {
                    mysqli_query($con,$sql2);
                        echo "Success, notes have been added";     // if user in table update notes
   }
    else{
         mysqli_query($con,$sql3);
        echo "Success,notes have been added";     // if user isnt in table insert
    }   
     }else{
             echo "file size too big";
     }
     }else{
         echo "File type not allowed, please try again";
     }
require_once('../pagecomponents/closeConnection.php');
?>

