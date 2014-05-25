<?php
session_start();
require_once('../pagecomponents/validate.php');
require_once('../pagecomponents/connectDB.php');

$validate = new Validate();
$validated_POST = $validate->post();

$keywords= array("insert","update","delete","drop");
$notes =$validated_POST["notes"];
//$notes=$_POST["notes"];
$lowernotes= strtolower($notes);
$notestoarray = explode(" ", $lowernotes);

if (array_intersect($keywords,$notestoarray)){
	
	echo "SQL Prohibited";
	
}else{
    
    $result=mysqli_query($con,$notes);
         if (!$result) {
                die('Query incorrent please try again ' . mysql_error());
         }else{
        while($row = mysqli_fetch_array($result)){
            echo $row['first_name'];
        }
    
        
         }
}

 




?>