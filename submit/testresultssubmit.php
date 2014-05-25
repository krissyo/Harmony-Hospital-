<?php
session_start();
require_once('../pagecomponents/validate.php');
require_once('../pagecomponents/connectDB.php');
	$pagetitle="Form Submited";	
    include ("../pagecomponents/indexinclude.php");
$validate = new Validate();
$validated_POST = $validate->post();
$procedureid=$validated_POST["ProID"];
$medicalnotes=$validated_POST["notes"];
$patientid = $_SESSION['passingID'];

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
        SET procedure_id='$procedureid', patient_id='$patientid',test_notes='$medicalnotes', medical_image='$name'
        WHERE patient_id = " . $patientid .'';

$sql3=  "INSERT INTO clinical_history_detail (patient_id, procedure_id, test_notes, medical_image )
         VALUES ('$patientid','$procedureid','$medicalnotes','$name')";
                
     if (($type =="image/jpeg") || ($type =="image/jpg") || ($type =="image/png")){    //specify type of image
         if ($size <= 10000000){                                      //bytes (10mb)
             
            move_uploaded_file($temp,"../testresultsimg/$name");       //uploading to server
             
              if(mysqli_num_rows($result) > 0) {
                    mysqli_query($con,$sql2);                         // updating notes if ID already exists
                        echo 'Success, test results have been updated.';
             
              }else{
                  mysqli_query($con,$sql3);                   // adding notes if ID doesnt exist
                    echo "Success, test results have been added.";
              }

}
}




require_once('../pagecomponents/closeConnection.php');
?>

