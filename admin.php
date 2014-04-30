<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>ADMIN MENU</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="bandaid_bird_48x48.ico" type="image/x-icon" />
        
        <!-- Javascript -->        
        <script src="lib/jquery-1.11.0.min.js"></script>
        <script src="lib/mainpage.js"></script>
        
        
             
    </head>
    
    <body>
        <div class="Container">

            <!-- this div creates the header bar -->
            <div class="headerBar">
        
                <div id="harmony_logo">
                    <a href="http://www.trustinblack.com/harmonyhospital/index.php"><img src="images/bandaid_bird_90px.png"></a>
                </div>
                <div id="welcome_user_text">
                    <p>WELCOME JESSE</p>
                </div>
                <div id="welcome_user_last_login">
                    <p>your last login was 140314 @ 14:33</p>
                </div><!-- close welcome_user_text-->
                    
                <!-- containing DIV for top menu bar in header -->
                <div id="TopMenuBar">
                    <div class="action_buttons" id="ProfileButton">
                        <a><h1>PROFILE</h1></a>
                    </div>  
                    <div class="action_buttons" id="HelpButton">
                        <a><h1>HELP</h1></a>
                    </div> 
                    <div class="action_buttons" id="LogoutButton">
                        <a action="submit/logout.php" href="loggedoff.html"><h1>LOG OUT</h1></a>
                    </div>
                    <div id="MailBox"><img src="images/mail_box.png"/>
                    </div>
                </div><!-- closes DIV for top menu bar -->
                
            </div><!-- closes the header bar -->
        
        
    <!-- this div creates the side bar column -->
        <div class="sidebarColumn">
                
            <!-- Containing DIV for side menu *CONVERT TO PHP AFTER FINALISED*--> 
            <div id="SideMenu">    
                <div class="tab_box" id="home_tab" >
                    <div class="tab_box_text">
                    <a href="http://www.trustinblack.com/harmonyhospital/index.php"><h1> HOME </h1></a> 
                    </div>
                </div>
                
                <div class="tab_box">
                    <div class="tab_box_text">
                    <h1> ADMIN </h1>        
                    </div>
                </div>
                
                <div class="tab_box">
                    <div class="tab_box_text">
                    <h1> PATIENT </h1>        
                    </div>
                </div>

                <div class="tab_box">
                    <div class="tab_box_text">
                    <h1> DOCTORS </h1>        
                    </div>
                </div>
                
                <div class="tab_box">
                    <div class="tab_box_text">
                    <h1> NURSES </h1>        
                    </div>
                </div>
                
                <div class="tab_box">
                    <div class="tab_box_text">
                    <h1> COSTS </h1>        
                    </div>
                </div>
                
                <div class="tab_box">
                    <div class="tab_box_text">
                    <h1> SURGERY </h1>        
                    </div>
                </div>
                
                <div class="tab_box">
                    <div class="tab_box_text">
                    <h1> FACILITIES </h1>        
                    </div>
                </div>
            </div><!-- Closes side Menu DIV-->
                 
        </div> <!-- this div closes the side bar column -->
    
    <!-- this div creates the content column -->   
    <div class="contentColumn">
                <!-- first row of buttons -->
                <div class="contentLinkingBox">
                    <a href="http://www.trustinblack.com/harmonyhospital/newpatient.php" target="_blank"><h1>ADMIT NEW <br />PATIENT</h1></a>
                </div>
        
                <div class="contentLinkingBox">
                    <a href="http://www.trustinblack.com/harmonyhospital/patientdetail.php" target="_blank"><h1>UPDATE PATIENT <br /> DETAILS</h1>                     </a>
                </div>
        
                <div class="contentLinkingBox">
                    <a href="http://www.trustinblack.com/harmonyhospital/searchpatient.php" target="_blank"><h1>SEARCH FOR<br />A PATIENT</h1></a>
                </div><!-- ends first row of buttons -->
        
                <!-- second row of buttons -->
                <div class="contentLinkingBox">
                    <a href="http://www.trustinblack.com/harmonyhospital/consent.php" target="_blank"><h1>PATIENT CONSENT <br /> FORM</h1></a>
                </div>
        
                <div class="contentLinkingBox">
                    <a href="http://www.trustinblack.com/harmonyhospital/terms_and_conditions.php" target="_blank"><h1>TERMS AND
                    <br />CONDITIONS</h1></a>
                </div><!-- ends second row of buttons -->
        
        
    </div><!-- this div closes the content column --> 

        
        
      
        
        
         </div>
        
    <form id="index">
		<?php
		include ("pagecomponents/load_permissions.php");
		include("pagecomponents/welcome_user.php");
		?>
    </form>

        
    </body>
    
</html>