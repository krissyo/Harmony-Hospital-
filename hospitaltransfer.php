<?php
$pagetitle="Hospital Transfer";
include("pagecomponents/head.php");
?>

		<div id="wrapper">
		<div id="header">
			<h1>Hospital Transfer</h1>
            
		</div>
		<div id="content">
            <form id="HospitalTransfer" action="submit/hospitaltransfersubmit.php" method="post">
                <input type="hidden" >
			<table><h3><th colspan="2" class="userdetails">Transfer Details</th></h3>
                <?php 
                //use this code where ever session storage is needed 
                    include("pagecomponents/checklogin.php");
                ?>
                <tr><td>Patient ID:</td> <td><input class="rounded" type="text" name="PatientId" id="PatientId" required></td></tr>
                <tr><td>Last Name:</td> <td> <input class="rounded" type="text" name="LastName" id="LastName" required></td></tr>
                <tr><td>Date of Discharge:</td> <td> <input class="rounded" type="date" name="DateDis" id="DateoDis" required></td></tr>
                <tr><td>Transferee Hospital:</td> <td> <input class="rounded" type="text" name="Transfer" id="Transfer" required></td></tr>
                <tr><td>Notes:</td> <td> <textarea rows="4" cols="50" placeholder="Start typing here..." name='notes' required></textarea></td></tr>   
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

