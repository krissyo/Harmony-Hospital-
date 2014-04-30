<?php session_start();

require_once('../pagecomponents/validate.php');
require_once('../pagecomponents/signature-to-image.php');

$validate = new Validate();
$validated_POST = $validate->post();
# Getting the signature output from consent form
$signature = $validated_POST["output"];
$fName = $validated_POST["FirstName"];
$lName = $validated_POST["LastName"];
# Converting the output to an image file
$img = sigJsonToImage($signature);
# Saving the image file on server
imagepng($img, '../signatureimg/'. $fName. '_'. $lName. '_'. 'signature.png');
$imgName = $fName. "_". $lName. "_". "signature.png";
# Cleaning up the image resource to free some memory! :)
imagedestroy($img);

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$fullName = $fName. " ". $lName;
$sql = "UPDATE patient_services SET guardian_signature =". "'". $imgName. "'". "WHERE admission_id = 
		(SELECT admission_id FROM admissions WHERE patient_id = (SELECT patient_id FROM patient_details WHERE carer1_name =". "'". $fullName. "'". "OR carer2_name =". "'". $fullName. "'". "))";

mysqli_query($con,$sql);

?>
