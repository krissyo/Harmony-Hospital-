<?php
	$pagetitle="Welcome";	
    include ("pagecomponents/indexinclude.php");
    require ('include/home_page.php');
	

		?>     
        <!--PHP INJECTION FOR CONTENT -->
        <head><title>Main Menu</title>
	<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.js"></script>
        </head>
    </div><!-- this div closes the content column --> 

        <?php 
		if (ISSET($_SESSION['roleID'])) {
	
			// Extract the home page info from DB
			$home_page = getHomePage($_SESSION['roleID']);
		} else {
			$home_page = "'search.inc'"; // default page
		}

		require ($home_page);
	?>
         </div>
        
    <form id="index">
    </form>

     <?php include ("pagecomponents/footer.php"); ?>   
    </body>
    
</html>
