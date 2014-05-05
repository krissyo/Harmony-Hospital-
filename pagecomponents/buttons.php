<div class="Container">

            <!-- this div creates the header bar -->
            <div class="headerBar">
        
                <div id="harmony_logo">

                    <a href="/harmonyhospital/index.php"><img src="<?php $_SERVER["DOCUMENT_ROOT"] ?>/harmonyhospital/images/bandaid_bird_90px.png"></a>

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
                <?php echo $_SESSION["roleID"]; ?>
                <div class="tab_box" id="home_tab" >
                    <div class="tab_box_text">
                    <a href="/harmonyhospital/index.php"><h1>Home</h1></a>
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
                
                <div id="costButton" class="tab_box">
                    <div class="tab_box_text">
                    <h1>Costs</h1>        
                    </div>
                </div>
                
                <div id="resourceButton" class="tab_box">
                    <div class="tab_box_text">
                    <h1>Resources</h1>        
                    </div>
                </div>
                <?php  if ($_SESSION["roleID"]==6){ ?>
                <div class="tab_box">
                    <div id="systemAdminButton" class="tab_box_text">
                    <h1>System Admin</h1>        
                    </div>
                </div>
                <?php }?>
            </div><!-- Closes side Menu DIV-->
                 
        </div> <!-- this div closes the side bar column -->
    <script>
        // krissy
    $("#menutoggle").click(function(){
        $(".sidebarColumn").slideToggle();
    })
    
    $(document).ready(function(){

/*-- Index Buttons --*/

/* loads the content for the admin tab*/
home_tab
$("#home_tab").mouseenter(function(){
    $(this).append("<a href='changepassword.php'>Change Password</a><br/>");
    $(this).append("<a href='#'>Profile</a><br/>");
    $(this).append("<a href='search.php'>Search</a><br/>");
});
$("#home_tab").mouseleave(function(){
    $(this).html("<h1>Home</h1>");
});
        
$("#employmentButton").mouseenter(function(){
    $(this).append("<a href='annualleave.php'>Annual Leave</a><br/>");
    $(this).append("<a href='sickleave.php'>Sick Leave</a><br/>");
    
});
$("#employmentButton").mouseleave(function(){
    $(this).html("<h1>Employment</h1>");
});

$("#adminButton").mouseenter(function(){
    <?php  if($_SESSION["roleID"]==4  || $_SESSION["roleID"]==3 ){ ?>
    $(this).append("<a href='doctorsnotes.php'>Doctors Notes</a><br/>");
    <?php } ?>
    <?php  if($_SESSION["roleID"]==1  || $_SESSION["roleID"]==2){ ?>
    $(this).append("<a href='nursesnotes.php'>Nurses Notes</a><br/>");
    <?php } ?>
    <?php  if($_SESSION["roleID"]==4  || $_SESSION["roleID"]==3 ){ ?>
    $(this).append("<a href='hospitaltransfer.php'>Hospital Transfer</a><br/>");
    <?php } ?>
    <?php  if($_SESSION["roleID"]==6){ ?>
    $(this).append("<a href='newstaff.php'>New Staff</a><br/>");
    <?php } ?>
});
$("#adminButton").mouseleave(function(){
    $(this).html("<h1>Admin</h1>");
});

$("#patientButton").mouseenter(function(){
    <?php  if($_SESSION["roleID"]==4  || $_SESSION["roleID"]==3 || $_SESSION["roleID"]==1  || $_SESSION["roleID"]==2 ){ ?>
    $(this).append("<a href='triage.php'>Triage Form</a><br/>");
    <?php } ?>
    <?php  if($_SESSION["roleID"]==1 || $_SESSION["roleID"]==2){ ?>
    $(this).append("<a href='newpatient.php'>New Patient</a><br/>");
    <?php } ?>
    <?php  if($_SESSION["roleID"]==4  || $_SESSION["roleID"]==3 || $_SESSION["roleID"]==1 ){ ?>
    $(this).append("<a href='admission.php'>admissions</a><br/>");
    <?php } ?>
    $(this).append("<a href='patientdetail.php'>Patient Details</a><br/>");
    <?php  if($_SESSION["roleID"]==4  || $_SESSION["roleID"]==3 || $_SESSION["roleID"]==1 ){ ?>
    $(this).append("<a href='testresults.php'>Test Results</a><br/>");
    <?php } ?>
    $(this).append("<a href='death.php'>Death</a><br/>");
    <?php  if($_SESSION["roleID"]==4  || $_SESSION["roleID"]==3 || $_SESSION["roleID"]==1 ){ ?>
    $(this).append("<a href='#'>Discharge</a><br/>");
    <?php } ?>
});
$("#patientButton").mouseleave(function(){
    $(this).html("<h1>Patient</h1>");
});

$("#costButton").mouseenter(function(){
    <?php  if($_SESSION["roleID"]==4){ ?>
    $(this).append("<a href='patient_account.php'>Patient Account</a><br/>");
    <?php } ?>
    <?php  if($_SESSION["roleID"]==4){ ?>
    $(this).append("<a href='services_invoice.php'>Services Invoice</a><br/>");
    <?php } ?>
});
$("#costButton").mouseleave(function(){
    $(this).html("<h1>Costs</h1>");
});
     
$("#resourceButton").mouseenter(function(){
    $(this).append("<a href='resource_availability.php'>Resource Availability</a><br/>");
    <?php  if($_SESSION["roleID"]==4  ||  $_SESSION["roleID"]==6){ ?>
    $(this).append("<a href='bedmanagement.php'>Bed Management</a><br/>");
    <?php } ?>
    <?php  if($_SESSION["roleID"]==5){ ?>
    $(this).append("<a href='addresources.php'>Add Resources</a><br/>");
    <?php } ?>
    <?php  if($_SESSION["roleID"]==1 || $_SESSION["roleID"]==2 || $_SESSION["roleID"]==3){ ?>
    $(this).append("<a href='bookings.php'>Bookings</a><br/>");
    <?php } ?>
    <?php  if($_SESSION["roleID"]==4  ||  $_SESSION["roleID"]==5){ ?>
    $(this).append("<a href='#'>Reports</a><br/>");
    <?php } ?>
});
$("#resourceButton").mouseleave(function(){
    $(this).html("<h1>Resources</h1>");
});
     
$("#systemAdminButton").mouseenter(function(){
    <?php  if($_SESSION["roleID"]==6){ ?>
    $(this).append("<a href='#'>Queries</a><br/>");
    <?php } ?>
});
$("#systemAdminButton").mouseleave(function(){
    $(this).html("<h1>System Admin</h1>");
});


    

});
    
    </script>
    <!-- this div creates the content column -->   
    <div class="contentColumn" id="contentColumn">
    </div>