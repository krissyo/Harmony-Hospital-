    <?php
	
	require_once ('pagecomponents/connectDB.php');
    
    $deptPrefix = "none";
    $deptPrefixArray = array();
    $wardPrefix = "blank";
    $wardPrefixArray = array();

    function populate_department_list(&$deptPrefixArray){
    
		$sqldepartment="SELECT department_id, department_description, department_prefix from departments ORDER BY department_id";
		$result=mysqli_query($con,$sqldepartment);
		
		while($row = mysqli_fetch_array($result)){
			echo "<option value='" . $row["department_id"] . "'>" . $row["department_description"] . "</option>";
			$deptPrefixArray[$row["department_prefix"]]=$row["department_id"];
		}
    print_r($deptPrefixArray);  
} 
  
    function populate_ward_list(&$wardPrefixArray){
    //$con=mysqli_connect("mysql.Firelabs.com.au","inb201harmony","6wxPSiPp","inb201harmony");
		$sql="SELECT ward_id,ward_description,department_id  from wards ORDER BY ward_id";
		$result=mysqli_query($con,$sql);
		while($row = mysqli_fetch_array($result)){
			echo "<option value='" . $row["department_id"] . "'>" . $row["ward_description"] . "</option>";
			$wardPrefixArray[$row["ward_id"]]=$row["ward_prefix"];
		}
    
	}

    function change_ward_list($deptID){
    //$con=mysqli_connect("mysql.Firelabs.com.au","inb201harmony","6wxPSiPp","inb201harmony");
		$sql="SELECT ward_id,ward_description,department_id  from wards ORDER BY ward_id";
		$result=mysqli_query($con,$sql);
		while($row = mysqli_fetch_array($deptID)){
			echo "<option value='" . $row["department_id"] . "'>" . $row["ward_description"] . "</option>";
			$wardPrefixArray[$row["ward_id"]]=$row["ward_prefix"];
		}
	}

 if(isset($_POST['deptID'])){
    $departmentPost = $_POST['deptID'];
    change_ward_list($deptID);
    echo $departmentPost;      
};
    

    /*$deptID = deptID;
    $departmentPost = $_POST['selectWard'];
    change_ward_list($deptID);
    echo $departmentPost;
    }*/
    
    ?>