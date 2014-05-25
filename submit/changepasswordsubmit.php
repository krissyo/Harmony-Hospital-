<?php 
// @author: Krissy O'Farrell, 08854114
// Last modified on: 25/05/2014
session_start();
//include("../pagecomponents/indexinclude.php");
require_once('../pagecomponents/validate.php');
require_once('../pagecomponents/connectDB.php');
$pagetitle="Password Changed";	
    include ("../pagecomponents/indexinclude.php");
$passwordOld=$_POST["OldPassword"];
$passwordNew1=$_POST["NewPassword1"];
$passwordNew2=$_POST["NewPassword2"];

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

$newSalt = randomSalt();
//$salt = base64_encode($salt);
//$hash = crypt($password, '$2y$10$'.$salt.'$');
?>
<div class="noResults">
<?php
    // Checking if the user logged in
    if(isset($_SESSION["userID"])){
        // Grabbing current values of hashed password and salt from database for the user
        $sql = "SELECT password, salt FROM staff_details WHERE staff_id = ".$_SESSION["userID"];
        $result=mysqli_query($con,$sql);
        while($row = mysqli_fetch_array($result)){ 
	    // Checking if the Old password entered by user match the value from database
	    $hash = crypt($passwordOld, '$5$'.$row['salt'].'$');
            if($hash == $row['password']){
                $correct_pass = true;   
            }
	    else{
		$correct_pass = false;  
	    }
        }
     }
     // Show a message if the user is not logged in
     else{
        echo "You are not logged in! Please <a href='http://trustinblack.com/harmonyhospital/login.php'>Login</a> first";  
    }
// If the old password entered by the user is correct do the following
if($correct_pass){
        if($passwordNew1 == $passwordNew2){
	    // Hash the new password
	    $hash = crypt($passwordNew1, '$5$'.$newSalt.'$');
	    // Update the values for password and salt on database with the new hashed password and
	    // the new salt generated
            $sql="UPDATE staff_details SET password = ". "'". $hash. "'". ", salt = ". "'". $newSalt. "'". " WHERE staff_id = ".$_SESSION["userID"];
            $result=mysqli_query($con,$sql);
	    // Show a success message
            echo "You have successfully changed your password!<br />";
            echo "Go back to <a href='http://trustinblack.com/harmonyhospital/index.php'>Main Page</a>";     
        }
	  else{
            echo "Passwords were not the same.";   
        }
}
// Show a message if the old password entered doesn't match with the current password
else{
    echo "The password entered was not correct.";   
}

require_once('../pagecomponents/closeConnection.php');
?>
</div>
