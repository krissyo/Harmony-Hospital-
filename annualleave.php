<?php
$pagetitle="Annual Leave";
include("pagecomponents/head.php");
?>

		<div id="wrapper">
		<div id="header">
			<h1>Annual Leave</h1>
            
		</div>
		<div id="content">
			<form id="annualleave" action="submit/annualsubmit.php" method="post">
                <input type="hidden" >
			<table><h3><th colspan="2" class="userdetails">To be completed by the employee applying for Annual Leave </th></h3>
                 
                <?php 
                //use this code where ever session storage is needed 
                    include("pagecomponents/checklogin.php");
                ?>
                
            <tr><td>Start Date:</td> <td> <input class="rounded" type="date" name="AnnualLeaveStart" id="StartDate" required></td></tr>
            <tr><td>End Date:</td> <td> <input class="rounded" type="date" name="AnnualLeaveEnd" id="EndDate" required></td></tr>
            <tr><td>Number of Days Absent:</td> <td> <input class="rounded" type="NoAbsent" name="NoAbsent" id="NoAbsent" required></td></tr>
            <tr><td>Approving Officer: </td> <td><input class="rounded" type="text" name="ApprovingOfficer" id="ApprovingOff" required></td></tr>
            <tr>
                    <td></td>
                    <td><input class="rounded" type="submit" name="sumbit" id="submit" value="Submit"></td>
                </tr>
                </table>
			</form>
		</div>
		<div id="sidebar">
		</div>
		<div id="footer">
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
        $( "#annualleave" ).validate({
          rules: {
            AnnualLeaveStart: {
              required: true,
              date: true
            },
            AnnualLeaveEnd: {
              required: true,
              date: true
            }
          }
        })
        function calculatedate(date1,date2){
            $(this).value.date2-date1;   
        }
            
        </script>
    </body>
</html>