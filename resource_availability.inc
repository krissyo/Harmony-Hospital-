<script>
	// Display available times and bookings 
		// for the selected Resource and Date
	function displayDetails(resourceId, bookingDate) {
	
	  if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	  } else { // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		  document.getElementById("availabilityTable").innerHTML=xmlhttp.responseText;
		}
	  }
	  xmlhttp.open("GET","getAvailabilityDetails.php?q="+resourceId+"&second_param="+bookingDate,true);
	  xmlhttp.send();
	}
	</script>
		<div id="wrapper">
			<div id="header">
				<h1>View Resource Availability</h1>
			</div>
			
			<div id="content">
				<form name="resource_availability">
				
					<table id="availability_main_table">
						<tr><td>Facility</td>
						<td><select class="rounded" id ="ResourceId" name="ResourceId" 
						onchange="displayDetails(this.value, document.getElementById('StartDate').value);">
						
						<?php
							$sql="SELECT department_description, resource_id, resource_description FROM departments Natural Join resources";
							
							$result=mysqli_query($con,$sql);
							while($row = mysqli_fetch_array($result)){
								echo "<option value='" . $row["resource_id"] . "'>" . $row["department_description"] . " " . $row["resource_description"] . "</option>";
							}
						?>
						</select></td></tr>
						<tr><td>Select Date</td>
							<td><input class="rounded" type="date" name="StartDate" id="StartDate" 
								onchange="displayDetails( document.getElementById('ResourceId').value, this.value);"
								value="<?php echo date('Y-m-d'); ?>">	
						</td></tr>
						<tr><td></td><td><input class="rounded" type="button" name="backToBookingsBtn" id="backToBookings" 
						value="Back to Bookings" onclick=""></td></tr>
					</table>
		<!-- Dynamic querying of the database-->				
					<div id="availabilityTable"></div>	
		<!-- history(0)??? to go back to the previous page -->		

				</form>	
			</div>
			<div id="sidebar">
			</div>