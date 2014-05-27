<?php
$pagetitle="New Patient";
include("pagecomponents/head.php");
?>
		
		<div id="wrapper">
		<div id="header">
			<h1>New Patient</h1>
            
		</div>
		<div id="content">
			<form id="newpatient" method="post" action="submit/newpatientsubmit.php">
                <input type="hidden" >
			<table><h3><th colspan="2" class="userdetails">Patient Details</th></h3>
               
            <tr><td>First Name:</td> <td><input class="rounded" type="text" name="first-name" id="first-name" required></td></tr>
            <tr><td>Middle Name:</td> <td> <input class="rounded" type="text" name="middle-name" id="middle-name"></td></tr>
            <tr><td>Last Name:</td> <td> <input class="rounded" type="text" name="last-name" id="last-name" required></td></tr>
            <tr><td>Date Of Birth:</td> <td> <input class="rounded" type="date" name="date-of-birth" id="date-of-birth" max="<?php
              $todaysdate=date('Y-m-d');
              echo $todaysdate;
              ?>"
            required></td></tr>
            <tr><td>Address:</td> <td> <input class="rounded" type="text" name="address" id="address" required></td></tr>
            <tr><td>Post Code: </td> <td><input class="rounded" type="text" name="post-code" id="post-code" required></td></tr>
            <tr><td>Phone Number:</td> <td> <input class="rounded" type="text" name="phone-number" id="phone-number" required></td></tr>
            <tr><td>Mobile Number: </td> <td><input class="rounded" type="text" name="mobile-number" id="mobile-number" required></td></tr>
            <tr><td>Gender: </td> <td><input type="radio" name="sex" value="male" checked>Male<br>
			<input type="radio" name="sex" value="female">Female</td></tr>
            <tr><td>Second Language:</td> <td> <input class="rounded" type="text" name="second-language" id="second-language" required></td></tr>
			<tr><td>Country of Origin:</td> <td><select class="rounded" name='country-id'>
			<?php
							//DB connection 
							require_once('pagecomponents/connectDB.php');
							
							$sql="SELECT country_id, country_name from countries ORDER BY country_name";
							$result=mysqli_query($con,$sql);
							while($row = mysqli_fetch_array($result)){
								echo "<option value='" . $row["country_id"] . "'>" . $row["country_name"] . "</option>";
							}								
			?>
			</select></td>
            <tr><td>Allergies: </td> <td><input class="rounded" type="text" name="allergies" id="allergies" required></td></tr>
            <tr><td>Conditions: </td> <td><input class="rounded" type="text" name="conditions" id="conditions" required></td></tr>
            <tr><td>Medicare Number: </td> <td><input class="rounded" type="text" name="medicare-no" id="medicare-no" required></td></tr>
            <tr><td>Medicare Exp Date: </td> <td><input class="rounded" type="date" name="medicare-exp" id="medicare-exp" min="<?php
              $todaysdate=date('Y-m-d');
              echo $todaysdate;
              ?>"required></td></tr>
            <tr><td>Mother's Name: </td> <td><input class="rounded" type="text" name="mothers-name" id="mothers-name" required></td></tr>
            <tr><td>Mother's Address: </td> <td><input class="rounded" type="text" name="mothers-address" id="mothers-address" required></td></tr>
			<tr><td>Mother's Phone Number: </td> <td><input class="rounded" type="text" name="mothers-phone" id="mothers-phone" required></td></tr>
            <tr><td>Father's Name: </td> <td><input class="rounded" type="text" name="fathers-name" id="fathers-name" required></td></tr>
            <tr><td>Father's Address: </td> <td><input class="rounded" type="text" name="fathers-address" id="fathers-address" required></td></tr>
			<tr><td>Father's Phone Number: </td> <td><input class="rounded" type="text" name="fathers-phone" id="fathers-phone" required></td></tr>
            <tr><td>Name of person paying account: </td> <td><input class="rounded" type="text" name="acc-responsibility" id="acc-responsibility" required></td></tr>
            <tr><td>Billing Address: </td> <td><input class="rounded" type="text" name="billing-address" id="billing-address" required></td></tr>
            <tr><td>Mother's/Father's Signature to verify information provided is true: </td> <td><input class="rounded" type="text" name="signature" id="signature" required></td></tr>
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
