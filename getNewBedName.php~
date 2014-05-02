<?php
$dptId = intval($_GET['q']);
$wardId = intval($_GET['second_param']);

$newBedNum = 0;

$dptPrefix = '';
$wardPrefix = '';

require_once ("pagecomponents/connectDB.php");

// extract department's prefix
$sql='SELECT department_prefix from departments 
	WHERE department_id = ' . $dptId;
	
$result=mysqli_query($con,$sql);

if ($row = mysqli_fetch_array($result)){
	$dptPrefix = $row['department_prefix'];
}

// extract ward's prefix
$sql='SELECT ward_prefix from wards 
	WHERE ward_id = ' . $wardId;
	
$result=mysqli_query($con,$sql);

if ($row = mysqli_fetch_array($result)){
	$wardPrefix = $row['ward_prefix'];
}

// calculate the next bed id
$sql='SELECT count(bed_id) as num_beds from beds 
	WHERE ward_id = ' . $wardId;
	
$result=mysqli_query($con,$sql);

if ($row = mysqli_fetch_array($result)){
	$newBedNum = $row['num_beds'] + 1;
}

// display the new bed description in the text-box
echo '<td>New Bed:</td>';
echo '<td><input type="text" name="new_bed" id="new_bed" value = "' . $dptPrefix . '_' . $wardPrefix . '_' . $newBedNum . '"></td>';

?>