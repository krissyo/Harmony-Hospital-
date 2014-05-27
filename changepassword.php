<?php
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
$pagetitle="Change Password";
include("pagecomponents/head.php");
?>
    <body>
        
		<div id="wrapper">
		<div id="header">
			<h1>Change Password</h1>
            
		</div>
		<div id="content">
            
            <form id="changepassword" action="submit/changepasswordsubmit.php" method="post">
                <input type="hidden" >

			<table><h3><th colspan="2" class="userdetails">Patient Details</th></h3>
                <tr><td>Old Password:</td> <td><input class="rounded" type="password" name="OldPassword" id="OldPassword" required placeholder="Old Password"></td></tr>
                <tr><td>New Password:</td> <td> <input class="rounded" type="password" name="NewPassword1" id="NewPassword1" required placeholder="New Password"></td></tr>
                <tr><td>New Password Again:</td> <td> <input class="rounded" type="password" name="NewPassword2" id="NewPassword2" required placeholder="New Password"></td></tr>
                    <td></td>
                    <td><input class="rounded" type="submit" name="sumbit" id="submit" value="Submit"></td>
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
    </body>
</html>
