<?php

    function populate_department_list(){
    
    $sqldepartment="SELECT department_id, department_description from departments ORDER BY department_id";
    $result=mysqli_query($con,$sqldepartment);
	while($row = mysqli_fetch_array($result)){
    echo "<option value='" . $row["department_id"] . "'>" . $row["department_description"] . "</option>";
	}	
}
    function populate_ward_list(){
    
    $sql="SELECT ward_id, ward_description from wards ORDER BY ward_id";
	$result=mysqli_query($con,$sql);
	while($row = mysqli_fetch_array($result)){
	echo "<option value='" . $row["ward_id"] . "'>" . $row["ward_description"] . "</option>";
    }
}
    
    ?>