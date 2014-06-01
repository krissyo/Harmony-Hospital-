<?php
include("pagecomponents/permissioncheckscript.php");
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
			<table>
<!--                <h3><th colspan="2" class="userdetails">Patient Details</th></h3>-->
               
            <tr><td>First Name:</td> <td><input class="rounded" type="text" name="firstname" id="firstname" required></td></tr>
            <tr><td>Middle Name:</td> <td> <input class="rounded" type="text" name="middlename" id="middlename"></td></tr>
            <tr><td>Last Name:</td> <td> <input class="rounded" type="text" name="lastname" id="lastname" required></td></tr>
            <tr><td>Date Of Birth:</td> <td> <input class="rounded" type="date" name="dateofbirth" id="dateofbirth" max="<?php
              $todaysdate=date('Y-m-d');
              echo $todaysdate;
              ?>"
            required></td></tr>
            <tr><td>Address:</td> <td> <input class="rounded" type="text" name="address" id="address" required></td></tr>
            <tr><td>Post Code: </td> <td><input class="rounded" type="text" name="postcode" id="postcode" required></td></tr>
            <tr><td>Phone Number:</td> <td> <input class="rounded" type="text" name="phonenumber" id="phonenumber" required></td></tr>
            <tr><td>Mobile Number: </td> <td><input class="rounded" type="text" name="mobilenumber" id="mobilenumber" required></td></tr>
            <tr><td>Gender: </td> <td><input type="radio" name="sex" value="male" checked>Male<br>
			<input type="radio" name="sex" value="female">Female</td></tr>
            <tr><td>Second Language:</td> <td> <input class="rounded" type="text" name="secondlanguage" id="secondlanguage" required></td></tr>
			<tr><td>Country of Origin:</td> <td><select class="rounded" name='countryid'>
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
<!--
            <tr><td>Allergies: </td> <td><input class="rounded" type="text" name="allergies" id="allergies" required></td></tr>
            <tr><td>Conditions: </td> <td><input class="rounded" type="text" name="conditions" id="conditions" required></td></tr>
-->
            <tr><td>Medicare Number: </td> <td><input class="rounded" type="text" name="medicareno" id="medicareno" required></td></tr>
            <tr><td>Medicare Exp Date: </td> <td><input class="rounded" type="date" name="medicareexp" id="medicareexp" min="<?php
              $todaysdate=date('Y-m-d');
              echo $todaysdate;
              ?>"required></td></tr>
            <tr><td>Mother's Name: </td> <td><input class="rounded" type="text" name="mothersname" id="mothersname" required></td></tr>
            <tr><td>Mother's Address: </td> <td><input class="rounded" type="text" name="mothersaddress" id="mothersaddress" required></td></tr>
			<tr><td>Mother's Phone Number: </td> <td><input class="rounded" type="text" name="mothersphone" id="mothersphone" required></td></tr>
            <tr><td>Father's Name: </td> <td><input class="rounded" type="text" name="fathersname" id="fathersname" required></td></tr>
            <tr><td>Father's Address: </td> <td><input class="rounded" type="text" name="fathersaddress" id="fathersaddress" required></td></tr>
			<tr><td>Father's Phone Number: </td> <td><input class="rounded" type="text" name="fathersphone" id="fathersphone" required></td></tr>
            <tr><td>Name of person paying account: </td> <td><input class="rounded" type="text" name="accresponsibility" id="accresponsibility" required></td></tr>
            <tr><td>Billing Address: </td> <td><input class="rounded" type="text" name="billingaddress" id="billingaddress" required></td></tr>
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

<script> 
        jQuery.validator.setDefaults({
          debug: false,
          success: "valid"
        });
        $( "#newpatient" ).validate({
          rules: {
            firstname:{
                required:true
            },
            middlename: {
              required: false
            },  
              lastname: {
              required: true
            },
              address: {
              required: true
            },
               postcode:{
                required:true,
                digits:true ,
                maxlength:4,
                minlength:4
            },
               phonenumber:{
                required:false,
                digits:true,
                maxlength:8,
                minlength:8
            },
               mobilenumber:{
                required:true,
                digits:true,
                maxlength:10,
                minlength:10
            },
               secondlanguage:{
                required:false,
             },
               medicareno:{
                required:true,
                digits:true,
                maxlength:9,
                minlength:9      
            },
               mothersname:{
                required:false,

              },
               mothersaddress:{
                required:false,         
             },
               mothersphone:{
                required:false,
                digits:true,
                maxlength:10,
                minlength:10
             },
               fathersname:{
                required:false,     
              },
               fathersaddress:{
                required:false,
 
             },
               fathersphone:{
                required:false,
                digits:true,
                maxlength:10,
                minlength:10
             },
               accresponsibility:{
                required:true   
             },
               billingaddress:{
                required:true 
             },
               signature:{
                required:true       
     }
          }
            
        })

</script>




    </body>
</html>
