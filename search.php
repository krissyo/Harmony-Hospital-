<?php
$pagetitle="Search";
include("pagecomponents/head.php");
?>
<script>
$(document).ready(function()
{
	// sending an ajax request and waiting for the result
	$.ajax({
		    // sending the request to the following URL
                    url: "pagecomponents/searchautocomplete.php",
		    // expecting a json file as a result(response)
                    dataType: "json",
		    // Showing the autocomplete after receiving the json file
                    success: function(data){
    			$("#search").autocomplete(
    			{
        		source: data,
        		minLength: 2,
			appendTo: "#autocomplete"
    			});
			}
	});
});
</script>
        	<div id="header">
            		<h1>Search Patient Form</h1>
        	</div>
        	<div id="content">

            <form id="searchPatientForm" method="get" action="submit/searchsubmit.php">
            <table> 
            
                <tr><td><div class="options"><b>Search:</b></div></td></tr></tr>
                <tr>
                    <td colspan="2"><input name="search" id="search" type="text" placeholder="Search" required style="color:#000;"></td>
                </tr>
		<tr>
		<td><div id="autocomplete"></div></td>
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
