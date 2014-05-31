<?php
// @author: Krissy O'Farrell, 08854114
// Last modified on: 31/05/2014
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
$pagetitle="New Role";
include ("pagecomponents/indexinclude.php");

if (isset($_POST["query"])){
    //open ftp file
    //get the query page
    $sql="INSERT INTO roles(role_description,home_page) VALUES('".$_POST["role_description"]."','".$_POST["home_page"]."')";


    //check if the sql query is valid
    $result=mysqli_query($con,$sql)
        or die("Error: ".mysqli_error($con));

}
    ?>  
	    <form method="post" action="newrole.php">
        Role Description: <input type="text" name="role_description">
        <select class="rounded" name="home_page" id="Role">
                <?php
							$sql="SELECT DISTINCT home_page FROM roles";
							
							require_once('pagecomponents/connectDB.php');
							
							$result=mysqli_query($con,$sql);
							while($row = mysqli_fetch_array($result)){
								echo "<option value='" . $row["home_page"] . "'>" . $row["home_page"] . "</option>";
							}								
						  ?>
                </select>
		<input type="submit" name="query">
	    </form>    
	    
	     <?php include ("pagecomponents/footer.php"); ?>
	    </body>
	    
	</html>