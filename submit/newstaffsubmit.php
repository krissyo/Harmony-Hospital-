
<?php 
require_once('../pagecomponents/validate.php');

if(!$con )
{
  die('Could not connect: ' . mysql_error());
}
$first_name=$_POST['FirstName'];
$middle_name=$_POST['MiddleName'];
$last_name=$_POST['LastName'];
$date_birth=$_POST['DateOfBirth'];
$address=$_POST['Address'];
$post_code= (int)$_POST['PostCode'];
$phone_number= (int)$_POST['PhoneNumber'];
$mobile_number= (int)$_POST['MobileNumber'];
$role=$_POST['Role'];
$gender=$_POST['sex'];
$bluecard=$_POST['yes'];
$second_language=$_POST['SecondLanguage'];
$email_address=$_POST['EmailAddress'];
$password=$_POST["password"];

$sql='SELECT staff_id FROM staff_details ORDER BY staff_id DESC LIMIT 1';

$result=mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result)){
    $staff_id=$row["staff_id"]+1; 
}			
echo $staff_id . "<br/>";
 
$user_name= substr($last_name, 0, 6) . substr($first_name, 0, 1) . $staff_id;

echo $user_name. "<br/>";

echo $password . "<br/>";

function randomSalt() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 20; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

$salt = randomSalt();
//$salt = base64_encode($salt);
//$hash = crypt($password, '$2y$10$'.$salt.'$');
$hash = crypt($password, '$5$'.$salt.'$');

echo $salt. "<br/>";
echo $hash;

$sql="INSERT INTO staff_details (username,password,salt,first_name,middle_name, 
last_name,date_of_birth,address_line,postcode,phone_number,mobile_number,role_id,
gender,second_language,email_address,blue_card) 
VALUES ('$user_name','$hash','$salt','$first_name','$middle_name','$last_name',
'$date_birth','$address','$post_code','$phone_number',
'$mobile_number','$role','$gender','$second_language','$email_address','$bluecard')";
$result=mysqli_query($con,$sql);
echo $result; 
?>
