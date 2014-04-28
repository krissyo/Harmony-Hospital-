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

$clinicalid=$validated_POST["Clinicalid"];
$procedureid=$validated_POST["ProID"];
$medicalnotes=$validated_POST["notes"];
$lastupdated=$validated_POST["lastupdated"];
// Uploading file

$_POST ['Submit'];
    
    $name=$_FILES['MedicalImaging']['name'];
    $temp=$_FILES['MedicalImaging']['tmp_name'];
    $type=$_FILES ['MedicalImaging']['type'];
    $size=$_FILES ['MedicalImaging']['size'];
    $pathdir= '../testresultsimg/';
    $filepath = $pathdir . $name;



    
     if (($type =="image/jpeg") || ($type =="image/jpg") || ($type =="image/png")){    //specify type of image
         
         if ($size <= 10000000){               //bytes (10mb)
          
          move_uploaded_file($temp,"../testresultsimg/$name");  //uploading to server
             
             
          $sql="UPDATE clinical_history_detail
          SET procedure_id='$procedureid',test_notes='$medicalnotes',medical_image='$filepath',last_updated_by='$lastupdated'
          WHERE clinical_history_detail_id='$clinicalid';";
             
   
     
             
        $result=mysqli_query($con,$sql);
        echo "Test results have been entered"; 

         }else{
             echo "File size is too big";
         }
         
     }else {
         
         echo "This not an image";
    
     } 




