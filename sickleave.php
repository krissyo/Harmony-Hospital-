<?php
include("pagecomponents/permissioncheckscript.php");
$pagetitle="Sick Leave";
include("pagecomponents/head.php");
?>
<script>
	function numberOfDays() {
	  var date1 = Date.parse(document.getElementById("StartDate").value);
	  var date2 = Date.parse(document.getElementById("EndDate").value);
	  //Get 1 day in milliseconds
	  var one_day=1000*60*60*24;

	  // Calculate the difference in milliseconds
	  var difference_ms = ( date2 - date1 );
	    
	  // Convert back to days and return
	  var number_of_days = Math.round(difference_ms/one_day) + 1;

	  document.getElementById("NoAbsent").value = number_of_days;
}
</script>
		<div id="wrapper">
		<div id="header">
			<h1>Sick Leave</h1>
            
		</div>
		<div id="content">
			<form id="sickleave" action="submit/sicksubmit.php" method="post">
                <input type="hidden" >
			<table>
<!--                <h3><th colspan="2" class="userdetails">To be completed by the employee who has taken Sick Leave </th></h3>-->
               
            <tr><td>Start Date:</td> <td> <input class="rounded" type="date" name="StartDate" id="StartDate" required></td></tr>
            <tr><td>End Date:</td> <td> <input class="rounded" type="date" name="EndDate" id="EndDate" onchange="numberOfDays();" required></td></tr>
            <tr><td>Number of Days Absent:</td> <td> <input class="rounded" type="NoAbsent" name="NoAbsent" id="NoAbsent" required></td></tr>
            <tr><td>Doctor's Certificate: </td> <td><input type="radio" name="certificate" value="yes">Yes<br>
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
