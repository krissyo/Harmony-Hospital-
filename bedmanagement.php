<?php
$pagetitle="Bed Management Form";
include("pagecomponents/head.php");
include("lib/bedManagementScript_Kira.php");
?>

	<script>
	// Display wards for the selected Department
	function displayWardsDetails(departmentId) {
	
	  if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	  } else { // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		  document.getElementById("ward_drop_down_list").innerHTML=xmlhttp.responseText;
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
            <h1>MANAGE BEDS FORM</h1>
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
                <tr>
                    <td> Select Department </td>
                    <td><select name="selectDpmnt" id="selectDpmnt" onchange="displayWardsDetails(this.value);" required>
                        <option value="deptDefault">-- please select a department --</option>
                        <?php
							populate_department_list();
                            ?>
                        </select>
                        </td>
                    </tr>
				<tr>
					<td>Select Ward</td>
					<td><select name="selectDpmnt" id="ward_drop_down_list" onchange="displayBedsDetails(this.value);" required>
					<option value="WardDefault">-- please select a ward --</option>
					</select>
					</td>
				</tr>
                <tr>
                <td>Select Bed</td>    
					
					<td><select name="selectBed" id="bed_drop_down_list" required>
					<option value="BedDefault">-- please select a bed --</option>
					</select>
					</td>
					
                </tr>
                <tr> 
				<td>Bed Description:</td>
				<td><input type="text" name="bedDescription" id="bed_description"></td>
                </tr>
                <tr>
                
                    <td></td>
                    <td><input class="rounded" type="submit" name="sumbit" id="submit" value="Create New Bed"></td>
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