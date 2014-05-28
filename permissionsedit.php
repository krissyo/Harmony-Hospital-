<?php
session_start();

// Author: Kristen O'Farrell
// Modified by: Armin Khoshbin
// Last modified by Kira Jamison, 08795428

if (isset($_SESSION['userID']))
	{
		$userId = $_SESSION['userID'];
	}
$current_page = basename($_SERVER['PHP_SELF']);
require 'include/check_access.inc';
if (check_access($userId, $current_page) == false)
{
	die("Sorry, You don't have access to this page!");
}
	$pagetitle="Edit Permissions";	
    include ("pagecomponents/indexinclude.php");

//checking top_nav has been submitted
if(isset($_POST['top_nav'])){
    $name = $_POST['name'];
    $url = $_POST['url'];
    $role = $_POST['role'];
    $html = $_POST['html'];
    $sql1 = "INSERT INTO top_nav(name, url, role_id, html_id) VALUES('$name', '$url', $role, '$html')";
    $result=mysqli_query($con,$sql1)
        or die("Error: ".mysqli_error($con));     
}
//checking sub_nav has been submitted
if(isset($_POST['sub_nav'])){
    $name = $_POST['name'];
    $url = $_POST['url'];
    $role = $_POST['role'];
    $top_nav_id = $_POST['top_nav_id'];
    $sql1 = "INSERT INTO sub_nav (name, url, top_nav_id, role_id) VALUES ('$name', '$url', $top_nav_id, $role)";
	
    $result=mysqli_query($con,$sql1)
        or die("Error: ".mysqli_error($con));        
}
//checking remove_nav has been submitted
if(isset($_POST['remove_nav'])){
    $id = $_POST['id'];
    $remove_id = $_POST['remove_id'];
    if($remove_id == 'top'){
        $sql1 = "DELETE FROM top_nav WHERE id=$id AND role_id = " . $_POST['role'];
    }
    if($remove_id == 'sub'){
        $sql1 = "DELETE FROM sub_nav WHERE id=$id AND role_id = " . $_POST['role'];
    }
    $result=mysqli_query($con,$sql1)
        or die("Error: ".mysqli_error($con)); 
}

require 'include/prefill_permissions.php';
?>

<script>
// AJAX routine to dynamically display
// existing sub navigation options
// for the selected role
function displaySubNavs(roleId) {
	
	  if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	  } else { // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		  document.getElementById("existing_sub_nav").innerHTML=xmlhttp.responseText;
		}
	  }
	  xmlhttp.open("GET","getSubNavs.php?q="+roleId,true);
	  xmlhttp.send();
	  
	  //Fire up another AJAX routine
	  // to dynamically populate the drop-down list
	  // of sub-nav links filtering out the existing links
	  // so they will not be doubled-up
	  
	  displayNewSubNavs(roleId);
}

function displayTopNavs(roleId) {
	  if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp4=new XMLHttpRequest();
	  } else { // code for IE6, IE5
		xmlhttp4=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  xmlhttp4.onreadystatechange=function() {
		if (xmlhttp4.readyState==4 && xmlhttp4.status==200) {
		  document.getElementById("existing_top_nav").innerHTML=xmlhttp4.responseText;
		}
	  }
	  xmlhttp4.open("GET","getTopNavs.php?q="+roleId,true);
	  xmlhttp4.send();
	  
	  //Fire up another AJAX routine
	  // to dynamically populate the drop-down list
	  // of top-nav links filtering out the existing links
	  // so they will not be doubled-up
	  
	  displayNewTopNavs(roleId);
}

function displayNewTopNavs(roleId) {

	  if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp5=new XMLHttpRequest();
	  } else { // code for IE6, IE5
		xmlhttp5=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  xmlhttp5.onreadystatechange=function() {
		if (xmlhttp5.readyState==4 && xmlhttp5.status==200) {
		  document.getElementById("top_nav_name").innerHTML=xmlhttp5.responseText;
		}
	  }
	  xmlhttp5.open("GET","getNewTopNavs.php?q="+roleId,true);
	  xmlhttp5.send();
}

function displayNewSubNavs(roleId) {

	  if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp2=new XMLHttpRequest();
	  } else { // code for IE6, IE5
		xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  xmlhttp2.onreadystatechange=function() {
		if (xmlhttp2.readyState==4 && xmlhttp2.status==200) {
		  document.getElementById("sub_nav_name").innerHTML=xmlhttp2.responseText;
		}
	  }
	  xmlhttp2.open("GET","getNewSubNavs.php?q="+roleId,true);
	  xmlhttp2.send();
}

function displayURLdetails(name) {

	  if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp3=new XMLHttpRequest();
	  } else { // code for IE6, IE5
		xmlhttp3=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  xmlhttp3.onreadystatechange=function() {
		if (xmlhttp3.readyState==4 && xmlhttp3.status==200) {
		  document.getElementById("URLdetails").innerHTML=xmlhttp3.responseText;
		}
	  }
	  xmlhttp3.open("GET","getURLinfo.php?q="+name,true);
	  xmlhttp3.send();
}
function display_top_URLdetails(name) {

	  if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp6=new XMLHttpRequest();
	  } else { // code for IE6, IE5
		xmlhttp6=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  xmlhttp6.onreadystatechange=function() {
		if (xmlhttp6.readyState==4 && xmlhttp6.status==200) {
		  document.getElementById("top_URLdetails").innerHTML=xmlhttp6.responseText;
		}
	  }
	  xmlhttp6.open("GET","get_top_URLinfo.php?q="+name,true);
	  xmlhttp6.send();
}
</script>
<!-- add top nav items -->
    <div id="wrapper">
    <h1>Add Top Navigation Item</h1>
    <form method="post" action="permissionsedit.php" style="border: 1px solid grey; width: 60%;">
		<label><b>Select a role</b></label><br/>
	    <?php
			drop_down_ajax('role', 'displayTopNavs(this.value);');
		?><br/>
        <label><b>Existing Items</b></label><br/>
		<textarea id = "existing_top_nav" style="width: 400px;"></textarea><br/>
		<div id="top_nav_name"></div><br/>	
		<div id="top_URLdetails"></div><br/>
        <input type="submit" name="top_nav">
    </form>
    <!-- add sub nav items -->
    <h1>Add Sub Navigation Item</h1>
    <form method="post" action="permissionsedit.php" style="border: 1px solid grey; width: 60%;">
		<label><b>Select a role</b></label><br/>
	    <?php
			drop_down_ajax('role', 'displaySubNavs(this.value);');
		?><br/>
		<label><b>Existing Items</b></label><br/>
		<textarea id = "existing_sub_nav" style="width: 400px;"></textarea><br/>		
        <div id="sub_nav_name"></div><br/>	
		<div id="URLdetails"></div><br/>
        <input type="submit" name="sub_nav">
    </form>
    <!-- remove nav items -->
    <h1>Remove Navigation Item</h1>
    <form method="post" action="permissionsedit.php" style="border: 1px solid grey; width: 60%;">
        <select name="remove_id">
            <option value="top">Top Navigation</option>
            <option value="sub">Sub Navigation</option>
        </select><br/>
		<?php
			drop_down_list('role');
		?><br/>
		<label><b>Item Id</b></label><br/>
        <input type="text" name="id"><br/>
        <input type="submit" name="remove_nav"><br/>
    </form>    
    <table id="admin-table">
    <?php
    //selects everything from top_nav
        $sql1 = "SELECT top_nav.*, roles.role_description 
				FROM top_nav 
				INNER JOIN roles on top_nav.role_id = roles.role_id";
        $result=mysqli_query($con,$sql1)
            or die("Error: ".mysqli_error($con)); 
        //counts number of rows to see if larger than 0
        $total = mysqli_num_rows($result);
        if($total > 0){
            while($row = mysqli_fetch_array($result)){
                $sql2 = "SELECT sub_nav.*, roles.role_description 
				FROM sub_nav
				INNER JOIN roles 
				on sub_nav.role_id = roles.role_id";
                $result2=mysqli_query($con,$sql2)
                    or die("Error: ".mysqli_error($con)); 
                $total2 = mysqli_num_rows($result2);
                ?>
<!--   prints id, name and role id for top_nav     -->
        <tr>
            <td><b>
                <?php echo $row['id'];?>
            </b></td>
            <td colspan="2"><b>
                <?php echo $row['name'];?>
            </b></td>
            <td><b>
                <?php echo $row['role_description'];?>
            </b></td>
        </tr>
                <?php
                if($total2 > 0){
                    while($sub_row = mysqli_fetch_array($result2)){
                        //if the top_nav_id matches the current top nav id, then execute following piece of js
                        if($sub_row["top_nav_id"] == $row["id"]){
                        ?>
<!--   prints id, name and role id to page for sub_nav     -->
        <tr>
            <td colspan="2">
                <?php echo $sub_row['id'];?>
            </td>
            <td>
                <?php echo $sub_row['name'];?>
            </td>
            <td>
                <?php echo $sub_row['role_description'];?>
            </td>
        </tr>
                        <?php
                        }
                    }
                }
            }
        }
    ?>
    </table>
</div>
</div>
     <?php include ("pagecomponents/footer.php"); ?>   
</body>
</html>