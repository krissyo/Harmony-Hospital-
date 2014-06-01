<?php
// @author: Krissy O'Farrell, 08854114
// Last modified on: 26/05/2014
require('connectDB.php');
?>
<script>
$(document).ready(function()
{
	// sending an ajax request and waiting for the result
	$.ajax({
		    // sending the request to the following URL
                    url: "http://trustinblack.com/harmonyhospital/pagecomponents/searchautocomplete.php",
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
<div class="gradient"></div>
<!-- this div creates the header bar -->
<div class="headerBar">

    <div id="harmony_logo">

        <a href="/harmonyhospital/index.php"><img src="<?php $_SERVER["DOCUMENT_ROOT"] ?>/harmonyhospital/images/hch_lockup_180px.png"></a>

    </div>
    <div id="welcome_user_text">
        <p>
            <?php echo $_SESSION["Name"];
                if (isset($_SESSION['patient_id'])){ echo " [<a href='http://trustinblack.com/harmonyhospital/patientprofile.php?id=".$_SESSION['patient_id'] ."'>Patient: ". $_SESSION['patient_name'] . "</a>]";} ?>
        </p>
    </div>
    <div id="harmonyNamebar">
    <img src="images/hch_lockup.png">
    </div>   
    <!-- containing DIV for top menu bar in header -->
    <div id="TopMenuBar"> 
        <form id="searchPatientForm" method="get" action="http://trustinblack.com/harmonyhospital/submit/searchsubmit.php" style="float:left;">
        <input name="search" id="search" type="text" placeholder="  search" required>
        <div id="autocomplete"></div>
     </form> 
        <div class="action_buttons" id="HelpButton">
            <a href="http://trustinblack.com/harmonyhospital/doc/"><h1>HELP</h1></a>
        </div> 
        <div class="action_buttons" id="LogoutButton">
            <a action="<?php $_SERVER["DOCUMENT_ROOT"] ?>/harmonyhospital/submit/logout.php" href="<?php $_SERVER["DOCUMENT_ROOT"] ?>/harmonyhospital/submit/logout.php"><h1>LOG OUT</h1></a>
        </div>
    </div><!-- closes DIV for top menu bar -->

</div><!-- closes the header bar -->
<div class="sidebarColumn">


<!-- Containing DIV for side menu *CONVERT TO PHP AFTER FINALISED*--> 
<div id="SideMenu"> 
<?php
    $sql1 = "SELECT * FROM top_nav";
    $result=mysqli_query($con,$sql1)
        or die("Error: ".mysqli_error($con)); 
    $total = mysqli_num_rows($result);
    if($total > 0){
        while($row = mysqli_fetch_array($result)){
            if($row["role_id"] == $_SESSION["roleID"] || $row["role_id"]==0){    
    ?>
        <div class="tab_box" id="<?php echo $row["html_id"] ?>" >
            <div class="tab_box_text">
            <a href="<?php echo $row["url"]; ?>"><h1><?php echo $row["name"]?></h1></a>
            </div>
        </div>
    <?php
            }
        }
    }
    ?>
</div><!-- Closes side Menu DIV-->

</div> <!-- this div closes the side bar column -->
<div class="Container">
        
        
    <!-- this div creates the side bar column -->
            <div class="menuresize">
                <a href="#" id="menutoggle">Menu</a>
            </div>
    <script>
        // krissy

        slide = 0

//        $("#menutoggle").on("tap",function(){
//            $(".sidebarColumn").slideToggle();
//        });    

    $(document).ready(function(){

/*-- Index Buttons --*/

/* loads the content for the admin tab*/
<?php
//selects everything from top_nav
    $sql1 = "SELECT * FROM top_nav";
    $result=mysqli_query($con,$sql1)
        or die("Error: ".mysqli_error($con)); 
    //counts number of rows to see if larger than 0
    $total = mysqli_num_rows($result);
    if($total > 0){
        while($row = mysqli_fetch_array($result)){
        ?>
            //selecting id of element and applying mouse over event handler
            $("#<?php echo $row["html_id"] ?>").mouseenter(function(){
                <?php
                $sql2 = "SELECT * FROM sub_nav";
                $result2=mysqli_query($con,$sql2)
                    or die("Error: ".mysqli_error($con)); 
                $total2 = mysqli_num_rows($result2);
                if($total2 > 0){
                    while($sub_row = mysqli_fetch_array($result2)){
                        //if the top_nav_id matches the current top nav id, then execute following piece of js
                        if($sub_row["top_nav_id"] == $row["id"] && ($sub_row["role_id"]==$_SESSION["roleID"] || $sub_row["role_id"]==0 )){
                ?>
                // if above is true, show this js
                $(this).append("<a href='<?php echo $sub_row["url"]; ?>'><?php echo $sub_row["name"] ?></a><br/>");
                <?php
                        }
                    }
                }
                ?>
            });    
            //select id, then applying mouseleave event handler
            $("#<?php echo $row["html_id"]?>").mouseleave(function(){
                $(this).html("<h1><?php echo $row["name"] ?></h1>");
            });           
        <?php
        }
    }
?>
//        $(".sidebarColumn").slideUp();
        $(".menuresize").on("touch",function(){
            $(".sidebarColumn").slideToggle();
        })

});
   
    </script>
    <!-- this div creates the content column -->   
<!--    <div class="contentColumn" id="contentColumn">-->