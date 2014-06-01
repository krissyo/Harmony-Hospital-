<?php
// @author: Krissy O'Farrell, 08854114
// Last modified on: 25/05/2014
include("pagecomponents/permissioncheckscript.php");
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

<script> 
        jQuery.validator.setDefaults({
          debug: false,
          success: "valid"
        });
        $( "#changepassword" ).validate({
          rules: {
            OldPassword: {
              required:true
            },
              NewPassword1: {
              required:true
            },
              NewPassword2: {
              required:true
         
            }
          }
        })
        </script>
    </body>
</html>
