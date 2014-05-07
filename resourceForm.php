<?php
session_start();
require_once ("pagecomponents/connectDB.php");

if (ISSET($_SESSION['objectId'])) {

	if ($_SESSION['objectId'] == 0) {
	
		$newBed = $_SESSION['newBedName'];
		$prefix = '';
		
		if ($_SESSION['object'] == 'Bed')
			$description = $newBed;
		else
			$description = '';		
		
	} else {
		if ($_SESSION['object'] == 'Department') {
			$sql = 'SELECT department_description as description, department_prefix as prefix
					FROM departments 
					WHERE department_id = ' . $_SESSION['objectId'];
		} else if ($_SESSION['object'] == 'Ward') {
			$sql = 'SELECT ward_description as description, ward_prefix as prefix 
					FROM wards 
					WHERE ward_id = ' . $_SESSION['objectId'];
		} else if ($_SESSION['object'] == 'Bed') {
			$sql = 'SELECT bed_description as description
					FROM beds 
					WHERE bed_id = ' . $_SESSION['objectId'];
			echo $sql;
		}

		$result = mysqli_query($con,$sql);
		$row = mysqli_fetch_array($result);
		
		if ($row !== false) {
			$description = $row['description'];
			$prefix = $row['prefix'];
			$newBed = '';
		}
	}
} else {
	echo 'objectId is not set';
}

?>

<form method="post" action = "processBeds.php" onsubmit="validate()">
<table>
	<tr>
		<td>
			<?php
			echo $_SESSION['object'] . ' Description';
			?>
		</td>
		<td>
			<?php
			echo '<input type = "text" name = "description" value = "' . $description . '" />';
			
			if (ISSET($errors['description'])) {
				$error = $errors['description'];
			} else {
				$error = '';
			}
			echo "<span id='descriptionError'>$error</span>";
			?>
		</td>
	</tr>
	
	<tr>
		<td>
			<?php
			if ($_SESSION['object'] != 'Bed')
				echo $_SESSION['object'] . ' Prefix';
			?>
		</td>
		<td>
			<?php
			if ($_SESSION['object'] != 'Bed') {
				echo '<input type = "text" name = "prefix" value = "' . $prefix . '" />';
				
				if (ISSET($errors['prefix'])) {
					$error = $errors['prefix'];
				} else {
					$error = '';
				}	
				echo "<span id='prefixError'>$error</span>";
			}
			?>
		</td>
	</tr>

	<tr><td></td>               
		<td><input class="rounded" type="submit" name="submit" id="submit" value="Submit">
		<input class="rounded" type="submit" name="submit" id="cancel" value="Cancel"></td>
    </tr>
</table>
</form>