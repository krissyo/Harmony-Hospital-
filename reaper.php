<?php
include("pagecomponents/permissioncheckscript.php");
$pagetitle="Reaper Form";
include("pagecomponents/head.php");
?>

		<div id="wrapper">
		<div id="header">
			<h1>Reaper Form</h1>
            
		</div>
		<div id="content">
			<form id="newpatient" method="post" action="submit/newpatientsubmit.php">
                <input type="hidden" >
			<table><h3><th colspan="2" class="userdetails">Patient Details</th></h3>
                <?php 
                //use this code where ever session storage is needed 
                    include("pagecomponents/checklogin.php");
                ?>
            <tr><td>First Name:</td> <td><input class="rounded" type="text" name="first-name" id="first-name" required></td></tr>
            <tr><td>Last Name:</td> <td> <input class="rounded" type="text" name="last-name" id="last-name" required></td></tr>
            <tr><td>Date Of Birth:</td> <td> <input class="rounded" type="date" name="date-of-birth" id="date-of-birth" required></td></tr>
            <tr><td>Address:</td> <td> <input class="rounded" type="text" name="address" id="address" required></td></tr>
			<tr><td>Identification Number: </td> <td><input class="rounded" type="text" name="identification-no" id="identification-no" required></td></tr>
            <tr><td>Name of Veteran: </td> <td><input class="rounded" type="text" name="veteran" id="veteran" required></td></tr>
            <tr><td>Gaurdian's Signature to verify information provided is true: </td> <td><input class="rounded" type="text" name="signature" id="signature" required></td></tr>
            <tr>
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