<?php
$pagetitle="New Staff";
include("pagecomponents/head.php");

function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
$password=randomPassword();
 ?>
		<div id="wrapper">
		<div id="header">
			<h1>Create a new user</h1>
            
		</div>
		<div id="content">
			<form id="loginform" method="post" action="submit/newstaffsubmit.php">
                <input type="hidden" value="<?php echo $password ?>" name="password">
			<table><h3><th colspan="2" class="userdetails">User Details</th></h3>
               
            <tr><td>First Name:</td> <td><input class="rounded" type="text" name="FirstName" id="FirstName" required></td></tr>
            <tr><td>Middle Name:</td> <td> <input class="rounded" type="text" name="MiddleName" id="MiddleName"></td></tr>
            <tr><td>Last Name:</td> <td> <input class="rounded" type="text" name="LastName" id="LastName" required></td></tr>
            <tr><td>Date Of Birth:</td> <td> <input class="rounded" type="date" name="DateOfBirth" id="DateOfBirth" required></td></tr>
            <tr><td>Address:</td> <td> <input class="rounded" type="text" name="Address" id="Address" required></td></tr>
            <tr><td>Post Code: </td> <td><input class="rounded" type="text" name="PostCode" id="PostCode" required></td></tr>
            <tr><td>Phone Number:</td> <td> <input class="rounded" type="text" name="PhoneNumber" id="PhoneNumber" required></td></tr>
            <tr><td>Mobile Number: </td> <td><input class="rounded" type="text" name="MobileNumber" id="MobileNumber" required></td></tr>
            <tr><td>Role: </td> <td><select class="rounded" name="Role" id="Role">
                <?php
							$sql="SELECT role_id, role_description FROM roles";
							
							require_once('pagecomponents/connectDB.php');
							
							$result=mysqli_query($con,$sql);
							while($row = mysqli_fetch_array($result)){
								echo "<option value='" . $row["role_id"] . "'>" . $row["role_description"] . "</option>";
							}								
						  ?>
                </select></td>
            <tr><td>Gender: </td> <td>
					<input type="radio" name="sex" value="male" checked>Male
                    <input type="radio" name="sex" value="female">Female</td></tr>
            <tr><td>Second Language:</td> <td> <input class="rounded" type="text" name="SecondLanguage" id="SecondLanguage" required> </td></tr>
            <tr><td>Email Address: </td> <td><input class="rounded" type="text" name="EmailAddress" id="EmailAddress" required></td></tr>
            <tr><td>Blue Card: </td> <td>
					<input type="radio" name="yes" value="yes" checked>Yes
                    <input type="radio" name="yes" value="no">No</td></tr>
                <tr>
                    <td></td>
                    <td><input class="rounded" type="submit" name="sumbit" id="submit" value="CreateUser"></td>
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
        $( "#loginform" ).validate({
          rules: {
            FirstName: {
              required: true
            },
            MiddleName: {
               required: true
             },
            DateOfBirth: {
                required: true,
                date:true
            },

            PostCode: {
               required: true,
                minlength:4,
                maxlength:4,
                digits: true
            },
           PhoneNumber: {
                required: true,
                minlength:8,
                maxlength:8,
                digits: true
           },
            MobileNumber: { 
                required: true,
                minlength:10,
                maxlength:10,
                digits: true
            },
            EmailAddress:{
                required: true,
                email:true
              
            }
          }
        })
        </script>








	</body>
</html>
