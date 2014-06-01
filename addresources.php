<?php
// Author James Clelland 08888141
session_start();
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
$pagetitle="Add Resources";
include("pagecomponents/head.php");
?>

    <body>
      
		<div id="wrapper">
		<div id="header">
			<h1>Add Resources</h1>
            
		</div>
		<div id="content">
            
         <form id="addresources" action="submit/addresourcessubmit.php" method="post">
                <input type="hidden" >
             
            <table><h3><th colspan="2" class="Resources">
               
        
<tr><td> Select Department :</td> <td><select class="rounded" name="departmentid" id="departmentid">
                <?php
                            require_once('pagecomponents/connectDB.php');
							
							$sql="SELECT * FROM departments";
                            $result=mysqli_query($con,$sql);
                            while($row = mysqli_fetch_array($result)){
                            echo "<option value='" . $row["department_id"] . "'>" . $row["department_description"] . "</option>";
                	}								
						  ?>
                </select></td> 
                
<tr id="resourcename"><td>Resource Name</td><td>   
    <input class="rounded" name="resourcename" type="text" /></td></tr>
                
<tr><td><input id="submit"  name="submit" type="submit" value="Submit" /></td></tr>
                </tr>
            </table>
			</form>
		</div>
		<div id="sidebar">
		</div>
			<?php
include("pagecomponents/footer.php");
?>
		</div>

<script> 
        jQuery.validator.setDefaults({
          debug: false,
          success: "valid"
        });
        $( "#addresources" ).validate({
          rules: {
            resourcename: {
              required: true
            }
          }
        })
        </script>
    </body>
</html>
