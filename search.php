<?php
$pagetitle="Search";
include("../harmonyhospital/pagecomponents/head.php");
?>
<script>
$(document).ready(function()
{
    $('#search').autocomplete(
    {
        source: "pagecomponents/searchautocomplete.php",
        minLength: 3
    });
});
</script>
        	<div id="header">
            		<h1>Search Patient Form</h1>
        	</div>
        	<div id="content">

            <form id="searchPatientForm" method="get" action="../harmonyhospital/submit/searchsubmit.php">
            <table> 
            
                <tr><td><div class="options"><b>Search:</b></div></td></tr></tr>
                <tr>
                    <td colspan="2"><input name="search" id="search" type="text" placeholder="Search" required style="color:#000;"></td>
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