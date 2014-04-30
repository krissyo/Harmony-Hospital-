<?php 
require_once('../pagecomponents/connectDB.php');

require_once('../pagecomponents/validate.php');

//patient details
$validate= new Validate();
$validated_POST=$validate->post();
$first_name=$validated_POST['first-name'];
$middle_name=$validated_POST['middle-name'];
$last_name=$validated_POST['last-name'];
$date_of_birth=$validated_POST['date-of-birth'];
$address=$validated_POST['address'];
$post_code=(int)$validated_POST['post-code'];
$phone_number=(int)$validated_POST['phone-number'];
$mobile_number=(int)$validated_POST['mobile-number'];
$second_language=$validated_POST['second-language'];
$country_id=$validated_POST['country-id'];
$allergies=$validated_POST['allergies'];
$conditions=$validated_POST['conditions'];
$medicare_no=$validated_POST['medicare-no'];
$medicare_exp=$validated_POST['medicare-exp'];


// Family details
$mothers_name=$validated_POST['mothers-name'];
$mothers_address=$validated_POST['mothers-address'];
$mothers_phone=(int)$validated_POST['mothers-phone'];
$fathers_name=$validated_POST['fathers-name'];
$fathers_address=$validated_POST['fathers-address'];
$fathers_phone=(int)$validated_POST['fathers-phone'];
$acc_responsibility=$validated_POST['acc-responsibility'];
$billing_address=$validated_POST['billing-address'];
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
	VALUES ('$first_name','$middle_name','$last_name',
	'$mothers_name','$mothers_address','$mothers_phone',
	'$fathers_name','$fathers_address','$fathers_phone',
	'$acc_responsibility','$billing_address','$signature',
	'$date_of_birth','$address','$post_code',
	'$phone_number','$mobile_number','$gender',
	'$country_id','$second_language','$username',
	'$medicare_no','$medicare_exp')";


mysqli_query($con,$sql);
require_once('../pagecomponents/closeConnection.php');
?>
