<?php
		
	// Connection
	require_once('connectDB.php');
	
	if (isset($_SESSION["roleID"])) {
		$sql="SELECT access_area FROM roles WHERE role_id = ".$_SESSION["roleID"].";";
	} else {
		$sql="SELECT access_area FROM roles WHERE role_id = 6;";
	}
	
	$result=mysqli_query($con,$sql);
	
	$row = $result->fetch_row();
	
	if ($row) {
		$permissionsList = $row[0];
		$permissions = explode(';', $permissionsList);
	}
	
	foreach ($permissions as $value) {
		if ($value == 'admin_tab') { ?>
			<script type="text/javascript">document.getElementById('admin_tab').style.display='block';</script>
		<?php }
		elseif ($value == 'patient_tab') { ?>
			<script type="text/javascript">document.getElementById('patient_tab').style.display='block';</script>
		<?php }
		elseif ($value == 'doctors_tab') { ?>
			<script type="text/javascript">document.getElementById('doctors_tab').style.display='block';</script>
		<?php }
		elseif ($value == "nurses_tab") { ?>
			<script type="text/javascript">document.getElementById('nurses_tab').style.display='block';</script>
		<?php }
		elseif ($value == 'costs_tab') { ?>
			<script type="text/javascript">document.getElementById('costs_tab').style.display='block';</script>
		<?php }
		elseif ($value == 'surgery_tab') { ?>
			<script type="text/javascript">document.getElementById('surgery_tab').style.display='block';</script>
		<?php }
		elseif ($value == 'facilities_tab') { ?>
			<script type="text/javascript">document.getElementById('facilities_tab').style.display='block';</script>
<?php } 
	} 
	require_once('closeConnection.php');
	?>