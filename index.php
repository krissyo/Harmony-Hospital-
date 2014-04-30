<?php
	$pagetitle="Welcome";	
    include ("pagecomponents/indexinclude.php");
	
	// This is the only place in out APP where
	// the connection to the database is established via the include file
	include ("pagecomponents/connectDB.php");
		?>
               
        <!--PHP INJECTION FOR CONFTENT -->
        
    </div><!-- this div closes the content column --> 

        
         </div>
        
    <form id="index">
		<?php
		include ("pagecomponents/load_permissions.php");
		//include("pagecomponents/welcome_user.php");
		?>
    </form>

        
    </body>
    
</html>