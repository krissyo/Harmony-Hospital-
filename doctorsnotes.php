<?php
$permissions=[3,4];
$pagetitle="Doctors Notes";
include("pagecomponents/head.php");
?>
    <body>
      
		<div id="wrapper">
		<div id="header"> 
			<h1>Doctor's Notes</h1>
            
		</div>
		<div id="content">
            
         <form id="doctorsnotes" action="submit/doctorsnotessubmit.php" method="post">
                <input type="hidden" >
            
            
			<table><h3><th colspan="2" class="userdetails">Patient Details</th></h3>
               
     
            <tr><td>First Name</td> <td><input class="rounded" type="text" name= "FirstName" id="FirstName" required></td></tr>
            <tr><td>Last Name:</td> <td> <input class="rounded" type="text" name="LastName" id="LastName" required></td></tr>   
            <tr><td>Current Medication:</td> <td> <input class="rounded" type="Medication" name="Medication" id="Medication"></td></tr>
            <tr><td>Notes:</td> <td> <textarea rows="4" cols="50" placeholder="Start typing here..." name="notes" required></textarea></td></tr>  
   
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
        $( "#doctorsnotes" ).validate({
          rules: {
            FirstName: {
              required: true,
                minlength: 3
            },
            LastName: {
              required: true,
                minlength: 3
            },
            Medication: {
                minlength: 3
            },
              Notes:{
                required: true,  
              
            }
          }
        })
        </script>

    </body>
</html>