<?php
	$pagetitle="Welcome";	
    include ("pagecomponents/indexinclude.php");
    
	

		?>     
        <!--PHP INJECTION FOR CONTENT -->
        <head><title>Main Menu</title>
	<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.js"></script>
        </head>
    </div><!-- this div closes the content column --> 

        <?php 
		$roleId = $_SESSION['roleID'];
		switch ($roleId)
		{
			case 1:
				require 'nurse_index.inc';
			break;
			case 2:
				require 'headnurse.inc';
			break;
			case 3:
                require 'viewpatients.inc';
            	break;
			case 4:
                require 'head_doctor_index.php';
            	break;
			case 6:
				require 'query.inc';
				break;
			case 7:
                require 'newstaff.inc';
				break;

			case 8:
				require 'newpatient.inc';
				break;
			case 9:
				require 'testresults.inc';
				break;
            
		}
	?>
         </div>
        
    <form id="index">
    </form>

     <?php include ("pagecomponents/footer.php"); ?>   
    </body>
    
</html>
