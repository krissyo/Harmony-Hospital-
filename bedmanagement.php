<?php
$pagetitle="Bed Management Form";
include("pagecomponents/head.php");
include("lib/bedManagementScript.php");
?>

	<script>
	
	// Central function for
	// dynamic querying on Dept drop-down click
	function displayWards(departmentId) {
	
		// Display wards in the drop-down list
		displayWardList(departmentId);
		
		// Display the list of wards in the main content
		displayWardDetails(departmentId);
	}
	
	// Populates the wards drop-down list 
	// for the selected Department
	function displayWardList(departmentId) {
	
	  if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp2=new XMLHttpRequest();
	  } else { // code for IE6, IE5
		xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  xmlhttp2.onreadystatechange=function() {
		if (xmlhttp2.readyState==4 && xmlhttp2.status==200) {
		  document.getElementById("ward_drop_down_list").innerHTML=xmlhttp2.responseText;
		}
	  }
	  xmlhttp2.open("GET","getWardList.php?q="+departmentId,true);
	  xmlhttp2.send();
	}
	
	// Populates the wards table
	// for the selected Department
	function displayWardDetails(departmentId) {
	
	  if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	  } else { // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		  document.getElementById("detailsTable").innerHTML=xmlhttp.responseText;
		}
	  }
	  xmlhttp.open("GET","getWardDetails.php?q="+departmentId,true);
	  xmlhttp.send();
	}
	
		// Display wards for the selected Department
	function displayBedsDetails(wardId) {
	
	  if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	  } else { // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		  document.getElementById("bed_drop_down_list").innerHTML=xmlhttp.responseText;
		}
	  }
	  xmlhttp.open("GET","getBedDetails.php?q="+wardId,true);
	  xmlhttp.send();
	}
	</script>
	
    <div id="wrapper">
        <div id="header">
            <h1>MANAGE RESOURCES</h1>
        </div>
        <div id="content">
            <div name=" buttonWrapper" id="centre">

            <!--<button  id="wardMgmtBtn" class="linkingButtons">Ward Management</button>
            <button  id="deptMgmtBtn" class="linkingButtons">Department management</button>-->
            
                </div>
            <br /><br />
            <form id="manageBedsForm" method="post" action="submit/manageBedssubmit.php">
            <input type="hidden">
            <table>
                <?php 
                //use this code where ever session storage is needed 
                    include("pagecomponents/checklogin.php");
                ?>
				<!-- Displaying 3 drop-down lists in one line -->
                <tr>
                    <td>
						<select name="selectDpmnt" id="selectDpmnt" onchange="displayWards(this.value);" required>
							<option value="deptDefault">-- please select a department --</option>
							<?php
							// When the form first loads, populate the list of departments
								populate_department_list();
								?>
                        </select>
                    </td>
					<td>
						<select name="selectDpmnt" id="ward_drop_down_list" onchange="displayBedsDetails(this.value);" required>
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
				<td>New Bed:</td>
				<td><input type="text" name="bedDescription" id="bed_description"></td>
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