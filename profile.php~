<?php
    $pagetitle="Patient Profile";
    include("pagecomponents/indexinclude.php");
require_once('pagecomponents/connectDB.php');

if(!$con )
{
  die('Could not connect: ' . mysql_error());
}
$patientid=$_GET["patientid"];
if(isset($patientid)){
    $sql = "SELECT * FROM patient_details WHERE patient_id = $patientid";
    $result=mysqli_query($con,$sql)
        or die("Error: ".mysqli_error($con)); 
    $total = mysqli_num_rows($result);
    if($total > 0){
        while($row = mysqli_fetch_array($result)){
            echo '<div class="patientName">' . $row['first_name'] . ' ' . $row['last_name'].'</div>';
            echo '<table class="patientTable">';
            echo '<tr><th>Gender</th><th>Address</th><th>Phone Number</th><th>Date of Birth</th><th>Date of Death</th><th>Medicare Number</th><th>Medicare Expiry</th><th>Hospital Transfer</th></tr>';
            echo '<tr><td>'.$row['gender'].'</td><td>'.$row['address_line'].'</td><td>'.$row['phone_number'].'</td><td>'.$row['date_of_birth'].'</td><td>'.$row['date_of_death'].'</td><td>'.$row['medicare_number'].'</td><td>'.$row['medicare_expiry_date'].'</td><td>'.$row['hospital_transfer'].'</td></tr>';
            echo '</table>';
        }
    }
    $sql = "SELECT * FROM admissions WHERE patient_id = $patientid";
    $result=mysqli_query($con,$sql)
        or die("Error: ".mysqli_error($con)); 
    $total = mysqli_num_rows($result);
    if($total > 0){
        while($row = mysqli_fetch_array($result)){
            echo '<table class="patientTable">';
            echo '<tr><th>Bed ID</th><th>Admission Date</th><th>Dischange Date</th><th>Notes</th></tr>';
            echo '<tr><td>'.$row['bed_id'].'</td><td>'.$row['admission_date'].'</td><td>'.$row['dischange_date'].'</td><td>'.$row['notes'].'</td></tr>';
            echo '</table>';
        }
    }else{
        echo '';   
    }
}else{
    echo "<div class='noResults'>No patient specified.</div>";   
}
?>