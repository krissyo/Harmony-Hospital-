<?php
$pagetitle="Sick Leave";
include("pagecomponents/head.php");
?>
		<div id="wrapper">
		<div id="header">
			<h1>Sick Leave</h1>
            
		</div>
		<div id="content">
			<form id="sickleave" action="submit/sicksubmit.php" method="post">
                <input type="hidden" >
			<table><h3><th colspan="2" class="userdetails">To be completed by the employee who has taken Sick Leave </th></h3>
                <?php 
                //use this code where ever session storage is needed 
                    include("pagecomponents/checklogin.php");
                ?>
            <tr><td>Start Date:</td> <td> <input class="rounded" type="date" name="StartDate" id="StartDate" required></td></tr>
            <tr><td>End Date:</td> <td> <input class="rounded" type="date" name="EndDate" id="EndDate" required></td></tr>
            <tr><td>Number of Days Absent:</td> <td> <input class="rounded" type="NoAbsent" name="NoAbsent" id="NoAbsent" required></td></tr>
            <tr><td>Doctor's Certificate: </td> <td><input type="radio" name="certificate" value="yes">Yes
                    <input type="radio" name="certificate" value="No">No</td></tr>
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