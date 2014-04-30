<?php 
require_once('../pagecomponents/validate.php');

if(!$con )
{
  die('Could not connect: ' . mysql_error());
}
//patient details
$validate= new Validate();
$validatedvalidated_POST=$validate->post();
$first-name=$validated_POST['first-name'];
$middle-name=$validated_POST['middle-name'];
$last-name=$validated_POST['last-name'];
$date-of-birth=$validated_POST['date-of-birth'];
$address=$validated_POST['address'];
$post-code=(int)$validated_POST['post-code'];
$phone-number=(int)$validated_POST['phone-number'];
$mobile-number=(int)$validated_POST['mobile-number'];
$second-language=$validated_POST['second-language'];
$country-id=$validated_POST['country-id'];
$allergies=$validated_POST['allergies'];
$conditions=$validated_POST['conditions'];
$medicare-no=$validated_POST['medicare-no'];
$medicare-exp=$validated_POST['medicare-exp'];


// Family details
$mothers-name=$validated_POST['mothers-name'];
$mothers-address=$validated_POST['mothers-address'];
$mothers-phone=(int)$validated_POST['mothers-phone'];
$fathers-name=$validated_POST['fathers-name'];
$fathers-address=$validated_POST['fathers-address'];
$fathers-phone=(int)$validated_POST['fathers-phone'];
$acc-responsibility=$validated_POST['acc-responsibility'];
$billing-address=$validated_POST['billing-address'];
$signature=$validated_POST['signature'];


//testing
if ($_SESSION["userID"] == "") {
	$username = 'kiraj';
}

if(isset($validated_POST['submit'])) {
    $gender = $validated_POST['sex'];
}
if ($gender == "female") {          
    $gender = 'F';      
}
else {
    $gender = 'M'; 
}

//execute SQL for patient details
$sql="INSERT INTO patient_details 
	(first_name,middle_name,last_name,carer1_name,carer1_address,carer1_phone_number,
	carer2_name,carer2_address,carer2_phone_number,
	send_bill_to,billing_address,signature,
	date_of_birth,address_line,postcode,
	phone_number,mobile_number,gender,
	country_id,spoken_language,last_updated_by,
	medicare_number,medicare_expiry_date) 
	VALUES ('$first-name','$middle-name','$last-name',
	'$mothers-name','$mothers-address','$mothers-phone',
	'$fathers-name','$fathers-address','$fathers-phone',
	'$acc-responsibility','$billing-address','$signature',
	'$date-of-birth','$address','$post-code',
	'$phone-number','$mobile-number','$gender',
	'$country-id','$second-language','$username',
	'$medicare-no','$medicare-exp')";


$result=mysqli_query($con,$sql);
echo $result; 
?>
