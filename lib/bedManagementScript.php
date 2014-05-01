    <?php
	
	
    
    $deptPrefix = "none";
    $deptPrefixArray = array();
    $wardPrefix = "blank";
    $wardPrefixArray = array();

    function populate_department_list(){
	
		require_once ('pagecomponents/connectDB.php');
		
		$sqldepartment="SELECT department_id, department_description, department_prefix from departments ORDER BY department_id";
		$result=mysqli_query($con,$sqldepartment);
		
		while($row = mysqli_fetch_array($result)){
			echo "<option value='" . $row["department_id"] . "'>" . $row["department_description"] . "</option>";
			$deptPrefixArray[$row["department_id"]] = $row["department_prefix"];
		}
    
} 
    
    ?>