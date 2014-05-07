    <?php


    function populate_department_list(){
	
		require ('pagecomponents/connectDB.php');
		
		$sqldepartment="SELECT department_id, department_description, department_prefix from departments ORDER BY department_id";
		$result=mysqli_query($con,$sqldepartment);
		
		while($row = mysqli_fetch_array($result)){
			echo "<option value='" . $row["department_id"] . "'>" . $row["department_description"] . "</option>";
			
		}
    
	}
	
	function populate_dpt_details() {
		
		require ('pagecomponents/connectDB.php');
		$firstRow = true;

		$sql = 'SELECT department_id, department_description, 
		department_prefix, Count(wards.ward_id) as number_of_wards
		FROM departments 
		natural join wards 
		Group BY department_id, 
		department_description, department_prefix';
		
		$result = mysqli_query($con, $sql);
		
		echo '<table id="details" style = "border: 1px solid grey; font-size: 1em;">';
		echo '<tr><th>Select</th><th>Prefix</th><th>Desc</th><th>Num of wards</th><th>Admissions</th></tr>';
		
		while($row = mysqli_fetch_array($result)){
			echo '<tr>';
			if ($firstRow) {
				echo '<td><input type="radio" name="record_id" id = "record_id" value="' . $row['department_id'] . '" checked></td>';
				$firstRow = false;
			} else {
				echo '<td><input type="radio" name="record_id" id = "record_id" value="' . $row['department_id'] . '"></td>';
			}
			echo '<td>' . $row["department_prefix"] . '</td>';
			echo '<td>' . $row["department_description"] . '</td>';
			echo '<td>' . $row["number_of_wards"] . '</td>';
			
			// display number of admissions for this department
			$sql = 'SELECT Count(admission_id) as num_adm from admissions
				natural join beds natural join wards 
				where department_id = ' . $row["department_id"];
			
			$record = mysqli_query($con,$sql);				
			$num_rows = mysqli_num_rows($record);
			
			
			if ($num_rows > 0) {
				$count = mysqli_fetch_array($record);
				echo '<td>' . $count["num_adm"] . '</td>';
			} else {
				echo '<td>0</td>';
			}
				
			echo '</tr>';
		}
		echo '</table>';
	}
    
    ?>