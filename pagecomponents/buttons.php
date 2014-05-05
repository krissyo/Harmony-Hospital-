<div class="Container">

            <!-- this div creates the header bar -->
            <div class="headerBar">
        
                <div id="harmony_logo">
<<<<<<< HEAD
                    <a href="/harmonyhospital/index.php"><img src="<?php $_SERVER["DOCUMENT_ROOT"] ?>/harmonyhospital/images/bandaid_bird_90px.png"></a>
=======
                    <a href="http://www.trustinblack.com/harmonyhospital/index.php"><img src="<?php $_SERVER["DOCUMENT_ROOT"] ?>/harmonyhospital/images/bandaid_bird_90px.png"></a>
>>>>>>> 5ab3ad551cc2479e016054f04113e2d8773d43da
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

                 <div  id="employmentButton" class="tab_box">
                    <div  class="tab_box_text">
                    <h1>Employment</h1>        
                    </div>
                </div>
                
                <div id="adminButton" class="tab_box">                    
                    <div  class="tab_box_text">
                    <h1>Admin</h1>        
                    </div>
                    
                </div>
                
                <div id="patientButton" class="tab_box">
                    <div class="tab_box_text">
                    <h1>Patient</h1>        
                    </div>
                </div>
                
                <div class="tab_box">
                    <div class="tab_box_text">
                    <h1>Costs</h1>        
                    </div>
                </div>
                
                <div id="resourceButton" class="tab_box">
                    <div class="tab_box_text">
                    <h1>Resources</h1>        
                    </div>
                </div>
                
                <div class="tab_box">
                    <div class="tab_box_text">
                    <h1>System Admin</h1>        
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