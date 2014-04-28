<?php 
session_start();
//include("../pagecomponents/indexinclude.php");
require_once('../pagecomponents/validate.php');
$con=mysqli_connect("mysql.Firelabs.com.au","inb201harmony","6wxPSiPp","inb201harmony");
if(!$con )
{
  die('Could not connect: ' . mysql_error());
}
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

$salt = randomSalt();
//$salt = base64_encode($salt);
//$hash = crypt($password, '$2y$10$'.$salt.'$');
?>
<div class="noResults">
<?php
if(correct_pass){
    if(isset($_SESSION["userID"])){
        $hash = crypt($passwordOld, '$5$'.$salt.'$');
        $sql = "SELECT password FROM staff_details WHERE staff_id = ".$_SESSION["userID"];
        $result=mysqli_query($con,$sql);
        while($row = mysqli_fetch_array($result)){ 
            if($hash == $row['password']){
                $correct_pass = true;   
            }
        }
        $hash = crypt($passwordNew1, '$5$'.$salt.'$');
        if($passwordNew1 == $passwordNew2){
            $sql="UPDATE staff_details SET password = $passwordNew1 WHERE staff_id = ".$_SESSION["userID"];
            $result=mysqli_query($con,$sql);
            echo "hi";
            echo $result;     
        }else{
            echo "Passwords were not the same.";   
        }
    }else{
        echo "You are not logged in.";   
    }
}else{
    echo "The password entered was not correct.";   
}
?>
</div>