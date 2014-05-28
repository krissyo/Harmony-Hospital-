<?php
// @author: Krissy O'Farrell, 08854114
// Last modified on: 25/05/2014
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
    $fp = fopen('file.csv', 'w');
    //get the query page
    $sql="INSERT INTO roles (role_description, access_level) VALUES ('".$_POST["role_description"]."', '".$_POST["access_level"]."')";


    //check if the sql query is valid
    $result=mysqli_query($con,$sql)
        or die("Error: ".mysqli_error($con));

}
    ?>  
	    <form method="post" action="newrole.php">
        Role Description: <input type="text" name="role_description">
        Access Level: <textarea rows="2" cols="20" name="access_level"></textarea>
		<input type="submit" name="Submit">
	    </form>    
	    
	     <?php include ("pagecomponents/footer.php"); ?>
	    </body>
	    
	</html>