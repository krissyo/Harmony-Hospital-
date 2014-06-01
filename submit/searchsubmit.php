<?php
session_start();
// @author: Krissy O'Farrell, 08854114								//
// Last modified on: 01/06/2014										//
// Last modified by: Kira Jamison, 08795428							//
//					now setting a session variable for PatientId	//
//																	//
	$pagetitle="Search Results";		
    include ("../pagecomponents/indexinclude.php");
?>
<?php
require_once('../pagecomponents/validate.php');

require_once('../pagecomponents/connectDB.php');

?>
<h2>Patient Results</h2>
<?php

$validate = new Validate();
$validated_GET = $validate->get();
$search=$validated_GET["search"];
if((strlen($search)==0)){
    echo 'No value specified.';
    die();
}else{
    if ($search > 0) {
        $sql="SELECT * FROM patient_details WHERE patient_id = '$$search'";
    }
    else if (strlen($search)>0) {
        $sql="SELECT * FROM patient_details WHERE first_name LIKE '%$search%'";
    }
    ?>
<div>
    <?php
    $result=mysqli_query($con,$sql)
        or die("Error: ".mysqli_error($con)); 
    $total = mysqli_num_rows($result);
    if($total > 0){
        while($row = mysqli_fetch_array($result)){
			
            echo '<div class="searchResults"><a href="'. 
				'../patientprofile.php?id=' . $row['patient_id'] . 
				'">' . $row['first_name'] . ' ' . $row['last_name'].'</a></div>';
        }
    }else{
		$_SESSION['patient_id'] = 0;
        echo '<div class="noResults">No results found.</div>';   
    }
}
?>
    </div>
<div>
<h2 style="width:89%;float:left;">Staff Results</h2>
<?php
if((strlen($search)==0)){
    echo 'No value specified.';
    die();
}else{
    if ($search > 0) {
        $sql="SELECT * FROM staff_details WHERE staff_id = '$search'";
    }
    else if (strlen($search)>0) {
        $sql="SELECT * FROM staff_details WHERE first_name LIKE '%$search%'";
    }
    $result=mysqli_query($con,$sql)
        or die("Error: ".mysqli_error($con)); 
    $total = mysqli_num_rows($result);
    if($total > 0){
        while($row = mysqli_fetch_array($result)){
            echo '<div class="searchResults"><a href="'. 
				'../staffprofile.php?staffid=' . $row['staff_id'] . '">' 
				. $row['first_name'] . ' ' 
				. $row['last_name'].'</a></div>';
        }
    }else{
        echo '<div class="noResults">No results found.</div>';   
    }
}
?>
    </div>
<?php
require_once('../pagecomponents/closeConnection.php');

?>

<?php include ("../pagecomponents/footer.php"); ?>
