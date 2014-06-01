<?php 
// @author: Krissy O'Farrell, 08854114
// Last modified on: 25/05/2014
$pagetitle="Patient has been added to the system";	
    include ("../pagecomponents/indexinclude.php");
require_once('../pagecomponents/connectDB.php');

require_once('../pagecomponents/validate.php');

//patient details
$validate= new Validate();
$validated_POST=$validate->post();
$first_name=$validated_POST['firstname'];
$middle_name=$validated_POST['middlename'];
$last_name=$validated_POST['lastname'];
$date_of_birth=$validated_POST['dateofbirth'];
$address=$validated_POST['address'];
$post_code=(int)$validated_POST['postcode'];
$phone_number=(int)$validated_POST['phonenumber'];
$mobile_number=(int)$validated_POST['mobilenumber'];
$second_language=$validated_POST['secondlanguage'];
$country_id=$validated_POST['countryid'];
$allergies=$validated_POST['allergies'];
$conditions=$validated_POST['conditions'];
$medicare_no=$validated_POST['medicareno'];
$medicare_exp=$validated_POST['medicareexp'];


// Family details
$mothers_name=$validated_POST['mothersname'];
$mothers_address=$validated_POST['mothersaddress'];
$mothers_phone=(int)$validated_POST['mothersphone'];
$fathers_name=$validated_POST['fathersname'];
$fathers_address=$validated_POST['fathersaddress'];
$fathers_phone=(int)$validated_POST['fathersphone'];
$acc_responsibility=$validated_POST['accresponsibility'];
$billing_address=$validated_POST['billingaddress'];
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
<html>
    <head>
    </head>
    <body>
        Success, patients details have been added to the system. 
    </body>
</html>