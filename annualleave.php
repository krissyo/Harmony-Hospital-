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
$pagetitle="Annual Leave";
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
			<h1>Annual Leave</h1>
            
		</div>
		<div id="content">
			<form id="annualleave" action="submit/annualsubmit.php" method="post">
                <input type="hidden" >
			<table>
<!--<h3><th colspan="2" class="userdetails"></th></h3>-->
                 
               
                
            <tr><td>Start Date:</td> <td> <input class="rounded" type="date" name="AnnualLeaveStart" id="StartDate" min="<?php
              $todaysdate=date('Y-m-d');
              echo $todaysdate;
              ?>" required></td></tr>
            <tr><td>End Date:</td> <td> <input class="rounded" type="date" name="AnnualLeaveEnd" id="EndDate" onchange="numberOfDays();" min="<?php
              $todaysdate=date('Y-m-d');
              echo $todaysdate;
              ?>"required></td></tr>
            <tr><td>Number of Days Absent:</td> <td> <input class="rounded" type="NoAbsent" name="NoAbsent" id="NoAbsent" required></td></tr>
            <tr><td>Approving Officer: </td> <td><select class="rounded" type="text" name="ApprovingOfficer" id="ApprovingOff" required>
            <option value="">Please select your approving officer</option>
            <?php
              include_once 'pagecomponents/connectDB.php';
              $sql="SELECT first_name, last_name, staff_id FROM staff_details WHERE role_id in (4, 2, 5)";
              $result=mysqli_query($con,$sql);
              foreach($result as $personel)
              {
                echo '<option value="'.$personel['staff_id'].'">'.$personel['first_name'].' '.$personel['last_name'].'</option>';
              }
            ?>
            </select>
            </td></tr>
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
