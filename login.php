<?php
	$pagetitle="Login";
	include("pagecomponents/headlogin.php");
	
?>

<div class="gradient"></div>		
<div id="wrapper">
            
		<div id="header">
			<h1>Harmony Children's Hospital <br/ > Staff Login</h1>
		</div>
        <br />     
		<div id="content">
			
            <form id="loginForm" method="post" action="submit/loginsubmit.php">
			<table>
                <tr><td>Username:</td> <td><input class="rounded" type="text" name="username" id="username" required></td></tr>
			<tr><td>Password:</td><td> <input class="rounded" type="password" name="password" id="password" required></td></tr>
			<tr><td><td><input class="submit" type="submit" name="submit" id="submit" value="Login"></td></tr>
			</table>
            </form>
            
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
        $( "#loginForm" ).validate({
          rules: {
            username: {
              required: true,
               minlength: 3
            },
            password: {
              required: true

            }
          }
        })
        </script>



	</body>
</html>
  