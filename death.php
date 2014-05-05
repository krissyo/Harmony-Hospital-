<?php
$pagetitle="Death Form";
include("pagecomponents/head.php");
?>

		<div id="wrapper">
		<div id="header">
			<h1>Death</h1>
            
		</div>
		<div id="content">
			<form id="death" action="submit/deathsubmit.php" method="post">
                <input type="hidden" >
			<table><h3><th colspan="2" class="userdetails">Notification of Death</th></h3>
               
            <tr><td>Patient Id:</td> <td><input class="rounded" type="text" name="PatientId" id="PatientId" required></td></tr>
            <tr><td>Authorising person: </td> <td><input class="rounded" type="text" name="authorising" id="Authorising" required></td></tr>
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
        $( "#death" ).validate({
          rules: {
            PatientId: {
              required: true,
               digits: true
            },
            Authorising: {
              required: true,
                minlength: 3
           
            }
          }
        })
        </script>







    </body>
</html>