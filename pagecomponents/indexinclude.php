<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <!--<link href="<?php $_SERVER["DOCUMENT_ROOT"] ?>/Harmony_main.css" rel="stylesheet" type="text/css" />-->
        <link href="<?php $_SERVER["DOCUMENT_ROOT"] ?>/harmonyhospital/globalstyle.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="<?php $_SERVER["DOCUMENT_ROOT"] ?>/harmonyhospital/bandaid_bird_48x48.ico" type="image/x-icon" />
        
        <!-- Javascript -->        
        <script src="<?php $_SERVER["DOCUMENT_ROOT"] ?>/harmonyhospital/lib/jquery-1.11.0.min.js"></script>
        <!--<script src="<?php $_SERVER["DOCUMENT_ROOT"] ?>/lib/mainpage.js"></script>-->
        <script src="<?php $_SERVER["DOCUMENT_ROOT"] ?>/harmonyhospital/lib/adminInclude.js"></script>
              
    </head>
    
    <body>
        <div class="Container">

            <!-- this div creates the header bar -->
            <div class="headerBar">
        
                <div id="harmony_logo">
                    <a href="http://www.trustinblack.com/harmonyhospital/index.php"><img src="<?php $_SERVER["DOCUMENT_ROOT"] ?>/harmonyhospital/images/bandaid_bird_90px.png"></a>
                </div>
                <div id="welcome_user_text">
                    <p>
                        <?php echo $pagetitle . ", " . $_SESSION["Name"] ?>
                    </p>
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
                        <a action="<?php $_SERVER["DOCUMENT_ROOT"] ?>/harmonyhospital/submit/logout.php" href="loggedoff.html"><h1>LOG OUT</h1></a>
                    </div>
                    <div id="MailBox"><img src="<?php $_SERVER["DOCUMENT_ROOT"] ?>/harmonyhospital/images/mail_box.png"/>
                    </div>
                </div><!-- closes DIV for top menu bar -->
                
            </div><!-- closes the header bar -->
        
        
    <!-- this div creates the side bar column -->
            <div class="menuresize">
            <input type="button" value="menu" id="menutoggle">
            </div>
            <div class="sidebarColumn">
            
                
            <!-- Containing DIV for side menu *CONVERT TO PHP AFTER FINALISED*--> 
            <div id="SideMenu">    
                <div class="tab_box" id="home_tab" >
                    <div class="tab_box_text">
                    <a href="http://www.trustinblack.com/harmonyhospital/index.php"><h1> HOME </h1></a>
                    </div>
                </div>
                
                <div id="adminButton" class="tab_box">                    
                    <div  class="tab_box_text">
                    <h1> ADMIN </h1>        
                    </div>
                    
                </div>
                
                <div class="tab_box">
                    <div class="tab_box_text">
                    <h1> PATIENT </h1>        
                    </div>
                </div>

                <div  id="doctorButton"class="tab_box">
                    <div  class="tab_box_text">
                    <h1> DOCTORS </h1>        
                    </div>
                </div>
                
                <div id="nurseButton" class="tab_box">
                    <div  class="tab_box_text">
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
    <script>
        // krissy
    $("#menutoggle").click(function(){
        $(".sidebarColumn").slideToggle();
    })
    </script>
    <!-- this div creates the content column -->   
    <div class="contentColumn" id="contentColumn">
    </div>
            