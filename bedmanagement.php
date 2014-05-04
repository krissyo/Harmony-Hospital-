<?php
$pagetitle="Bed Management Form";
include("pagecomponents/head.php");
include("lib/bedManagementScript.php");
?>
	<script src="<?php $_SERVER["DOCUMENT_ROOT"] ?>/harmonyhospital/lib/buttonClickLink.js"></script>
	<script>
	
	// Central function for
	// dynamic querying on Dept drop-down click
	function displayWards(departmentId) {
	
		// display the Ward drop-down list as per the search criteria
		displayDetails("ward_drop_down_list", "getWardList.php?q=" + departmentId);
		
		// Display a detailed list of wards for this department
		displayDetails("detailsTable", "getWardDetails.php?q=" + departmentId);
		
		// Clear the New Bed Textbox value
		clearNewBedValue();
	}
	
	// Populates the specified HTML form control
	// as per the selection from the drop-down list (Wards, Beds)
	function displayDetails(html_id, php_file) {
	
	  if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	  } else { // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		  document.getElementById(html_id).innerHTML=xmlhttp.responseText;
		}
	  }
	  xmlhttp.open("GET", php_file, false);
	  xmlhttp.send();
	}
	
	// Display wards for the selected Department
	function displayBeds(wardId) {
		
		// display the Bed drop-down list as per the search criteria
		displayDetails("bed_drop_down_list", "getBedList.php?q=" + wardId);
		
		// Display a detailed list of wards for this department
		displayDetails("detailsTable", "getBedDetails.php?q=" + wardId);
		
		// Auto-populate the New Bed text-box with Dpt_Ward_Bed prefix
		populateNewBed();
	}
	
	// Insert the next Bed description (auto-populated)
	// based on the prefix fields in Departments & Wards tables.
	function populateNewBed() {
		var wardId, dptId;
		
		dptId = document.getElementById('dpt_drop_down_list').value;
		wardId = document.getElementById('ward_drop_down_list').value;
		
		displayDetails("bed_description", "getNewBedName.php?q=" + dptId + "&second_param="+ wardId);
	}
	
	// Clear the value in New Bed Description text-box
	// when a ward list is being displayed
	function clearNewBedValue() {
		document.getElementById('bed_description').innerHTML = "";	
	}
	</script>
	
    <div id="wrapper">
        <div id="header">
            <h1>MANAGE RESOURCES</h1>
        </div>
        <div id="content">
            <div name=" buttonWrapper" id="centre">

            <button  id="resourcesAvailButton" class="linkingButtons">Resource Availability</button>
            <button  id="resourcesAvailButton" class="linkingButtons">Add Resource</button>
            
                </div>
            <br /><br />
            <form id="manageBedsForm" method="post" action="submit/manageBedssubmit.php">
            <input type="hidden">
            <table>
            
				<!-- Displaying 3 drop-down lists in one line -->
                <tr>
                    <td>
						<select name="selectDpmnt" id="dpt_drop_down_list" onchange="displayWards(this.value);" required>
							<option value="deptDefault">-- please select a department --</option>
							<?php
							// When the form first loads, populate the list of departments
								populate_department_list();
								?>
                        </select>
                    </td>
					<td>
						<select name="selectWard" id="ward_drop_down_list" onchange="displayBeds(this.value);" required>
							<option value="WardDefault">-- please select a ward --</option>
						</select>
					</td>					
					<td>
						<select name="selectBed" id="bed_drop_down_list" required>
							<option value="BedDefault">-- please select a bed --</option>
						</select>
					</td>
				</tr>
			</table>

			<!-- When the form first loads, a list of departments is displayed here
			As soon as the user selects a Department or Ward or Bed
			some dynamic querying of the database is displayed below DIV id=detailsTable-->
			
			<div id="detailsTable">
			<h3>Departments</h3>
				<?php
				// When the form first loads, populate the list of departments
					populate_dpt_details();
					?>			
			</div>
			
			<table>
                <tr> 
				<!-- auto-populated New Bed Description -->
				<div id = "bed_description"></div>
                </tr>
				<!-- Three buttons in one line -->
                <tr>                
                    <td><input class="rounded" type="submit" name="update" id="update" value="Update"></td>
                    <td><input class="rounded" type="submit" name="create" id="create" value="Create New"></td>
					<td><input class="rounded" type="submit" name="delete" id="delete" value="Delete"></td>
                </tr>
            </table>
			</form>
        
        </div>
    	<?php
include("pagecomponents/footer.php");
?>
    </div>

    
    </body>


</html>