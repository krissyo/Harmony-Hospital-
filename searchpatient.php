<?php
$pagetitle="Search Patient";
include("../harmonyhospital/pagecomponents/head.php");
?>

        	<div id="header">
            		<h1>Search Patient Form</h1>
        	</div>
        	<div id="content">

            <form id="searchPatientForm" method="get" action="../harmonyhospital/submit/searchpatientsubmit.php">
            <table> 
                <?php 
                //use this code where ever session storage is needed 
                    include("../harmonyhospital/pagecomponents/checklogin.php");
                ?>
                <tr><td><div class="options"><b>Search:</b></div></td></tr></tr>
                <tr>
                    <td colspan="2"><input name="search" id="search" type="text" placeholder="Search" required ></td>
                </tr> 
                <tr>
                    <td></td>
                    <td><input class="rounded" type="submit" name="sumbit" id="submit"></td>
                </tr>
            </table>
			</form>
        
        </div>
    	<?php
include("../harmonyhospital/pagecomponents/footer.php");
?>
    </div>
    
    	</body>
</html>
