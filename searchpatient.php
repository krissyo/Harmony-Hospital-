<?php
$pagetitle="Search Patient";
include("pagecomponents/head.php");
?>

        	<div id="header">
            		<h1>Search Patient Form</h1>
        	</div>
        	<div id="content">

            <form id="searchPatientForm" method="get" action="submit/searchpatientsubmit.php">
            <table> 
                <?php 
                //use this code where ever session storage is needed 
                    include("pagecomponents/checklogin.php");
                ?>
		<tr><td><div class="options"><b>Search By</b></div></td></tr>
                <tr>
                    <td>PatientId: </td>
                    <td><input name="patientId" id="patientId" type="text"></input></td>
                    </tr>
                <tr><td><div class="options"><b>or</b></div></td></tr>
                <tr>
                    <td>Surname: </td>
                    <td><input name="surname" id="surname" type="text"></input></td>
                    </tr> 
                <tr>
                    <td></td>
                    <td><input class="rounded" type="submit" name="sumbit" id="submit"></td>
                </tr>
            </table>
			</form>
        
        </div>
    	<?php
include("pagecomponents/footer.php");
?>
    </div>
    
    	</body>
</html>
