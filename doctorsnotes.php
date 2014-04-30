<?php
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
                <?php 
                //use this code where ever session storage is needed 
                    include("pagecomponents/checklogin.php");
                ?>
     
            <tr><td>First Name</td> <td><input class="rounded" type="text" name= "FirstName" id="FirstName" required></td></tr>
            <tr><td>Last Name:</td> <td> <input class="rounded" type="text" name="LastName" id="LastName" required></td></tr>   
            <tr><td>Current Medication:</td> <td> <input class="rounded" type="Medication" name="Medication" id="Medication" required></td></tr>
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
    </body>
</html>