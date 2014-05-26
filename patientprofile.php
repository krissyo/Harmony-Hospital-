<?php
// Author: Krissy O'Farrell
// Last modified on: 27/05/2014
// Last modified on: 26/05/2014
// Last modified by: by Kira Jamison, 08795428
$pagetitle="Patient Profile";
include("pagecomponents/indexinclude.php");
require_once('pagecomponents/connectDB.php');
?> 
        <div id="patientbuttons">
            <div class="tab_box">
                <a href="processAdmission.php">Admissions</a>
            </div>
            <div class="tab_box">
                <a href="patientdetail.php">Patient Details</a>
            </div>
            <div class="tab_box">
                    <a href="testresults.php">Test Results</a>
            </div>
            <div class="tab_box">
                    <a href="death.php">Death</a>
            </div>
            <div class="tab_box">
                    <a href="hospitaltransfer.php">Hospital Transfer</a>
            </div>
            <div class="tab_box">
                    <a href="doctorsnotes.php">Doctors Notes</a>
            </div>
            <div class="tab_box">
                    <a href="nursenotes.php">Nurses Notes</a>
            </div>
        </div>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<hr style="width:20%;">
<?php
//$patientid=$_GET["patientid"];
$patientid=$_GET["id"];
//echo $patientid;
// Setting the Session patient Id here [Kira J]
$_SESSION['patient_id'] = $patientid;
//$patientid=$_GET["patientid"];
$patientid=$_GET["id"];
// Setting the Session patient Id here [Kira J]
$_SESSION['patient_id'] = $patientid;

if(isset($patientid)){
    $sql = "SELECT * FROM patient_details WHERE patient_id = $patientid";
    $result=mysqli_query($con,$sql)
        or die("Error: ".mysqli_error($con)); 
    $total = mysqli_num_rows($result);
    if($total > 0){
        while($row = mysqli_fetch_array($result)){
            echo '<div class="itemName">' . $row['first_name'] . ' ' . $row['last_name'].'</div>';
            $_SESSION['patient_name'] = $row['first_name'] . ' ' . $row['last_name'];
            echo '<table class="patientTable">';
            echo '<tr></tr>';
            echo '<tr><th>Gender:</th><td>'.$row['gender'].'</td></tr><tr><th>Address:</th><td>'.$row['address_line'].'</td></tr><tr><th>Phone Number:</th><td>'.$row['phone_number'].'</td></tr><tr><th>Date of Birth:</th><td>'.$row['date_of_birth'].'</td></tr><tr><th>Date of Death:</th><td>'.$row['date_of_death'].'</td></tr><tr><th>Medicare Number:</th><td>'.$row['medicare_number'].'</td></tr><tr><th>Medicare Expiry:</th><td>'.$row['medicare_expiry_date'].'</td></tr><tr><th>Hospital Transfer:</th><td>'.$row['hospital_transfer'].'</td></tr>';
        }
    }
    $sql = "SELECT * FROM admissions WHERE patient_id = $patientid";
    $result=mysqli_query($con,$sql)
        or die("Error: ".mysqli_error($con)); 
    $total = mysqli_num_rows($result);
    if($total > 0){
        while($row = mysqli_fetch_array($result)){
            echo '<tr></tr>';
            echo '<tr><th>Bed:</th><td>'.$row['bed_id'].'</td></tr><tr><th>Admission Date:</th><td>'.$row['admission_date'].'</td></tr><tr><th>Dischange Date:</th><td>'.$row['dischange_date'].'</td></tr><tr><th>Notes:</th><td>'.$row['notes'].'</td></tr></tr>';
            echo '</table>';
        }
    }else{
        echo '';   
    }
}else{
    echo "<div class='noResults'>No patient specified.</div>";   
}

require_once('pagecomponents/closeConnection.php');
?>
