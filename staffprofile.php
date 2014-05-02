<?php
    $pagetitle="Staff Profile";
    include("pagecomponents/indexinclude.php");
require_once('pagecomponents/connectDB.php');

if(!$con )
{
  die('Could not connect: ' . mysql_error());
}
$staffid=$_GET["staffid"];
if(isset($staffid)){
    $sql = "SELECT * FROM staff_details WHERE staff_id = $staffid";
    $result=mysqli_query($con,$sql)
        or die("Error: ".mysqli_error($con)); 
    $total = mysqli_num_rows($result);
    if($total > 0){
        while($row = mysqli_fetch_array($result)){
            echo '<div class="itemName">' . $row['first_name'] . ' ' . $row['last_name'].'</div>';
            echo '<table class="patientTable">';
            echo '<tr></tr>';
            echo '<tr><th>Mobile #:</th><td>'.$row['mobile_number'].'</td></tr><tr><th>Department:</th><td>'.$row['department_id'].'</td></tr><tr><th>Email:</th><td>'.$row['email_address'].'</td></tr>';
            echo '</table>';
        }
    }
}else{
    echo "<div class='noResults'>No staff member specified.</div>";   
}
?>