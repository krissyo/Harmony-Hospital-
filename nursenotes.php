<?php
// Last modified by Armin Khoshbin on 1/06/2014
session_start();
if (isset($_SESSION['userID']))
	{
		$userId = $_SESSION['userID'];
	}
$current_page = basename($_SERVER['PHP_SELF']);
require 'include/check_access.inc';
if (check_access($userId, $current_page) == false)
{
	die("Sorry, You don't have access to this page!");
}
	if (isset($_SESSION["patient_id"]))
	{
		$patientid = $_SESSION["patient_id"];
	}
	else
	{
		header('Location: search.php');
	}
$pagetitle="Nurse Notes";
include("pagecomponents/head.php");
?>
    <body>
        
		<div id="wrapper">
		<div id="header">
			<h1>Nurses's Notes</h1>
            
		</div>
		<div id="content">
            
            <form id="nursesnotes" action="submit/nursenotessubmit.php" method="post">
                <input type="hidden" >

            <table><h3><th colspan="2" class="userdetails">
                <?php
                    $sql=" SELECT first_name, last_name FROM patient_details WHERE patient_id=" . $patientid .'';
                    $result = mysqli_query ($con, $sql) ;
                    while($row = mysqli_fetch_array($result)){
                    echo $row['first_name'] . ' ' . $row['last_name'];
                    }              
                ?>
                </th></h3>
		
		<?php
                    $sql=" SELECT last_updated_by_nurse , time_stamp_nurse FROM medical_history WHERE patient_id=" . $patientid .'';
                    $result = mysqli_query ($con, $sql) ;
                    while($row = mysqli_fetch_array($result)){
		    	if ( !empty($row['time_stamp_nurse']) )
		    	{
			    echo '<tr><p>This note last time has been changed by <b>'. $row['last_updated_by_nurse']. '</b> at <b>'. $row['time_stamp_nurse']. '</b></p></tr>';
		    	}

		    }
		?>
		
                
                <tr><td>Doctors Notes:</td> <td>
                
                <?php
                    $sql=" SELECT doctors_notes FROM medical_history WHERE patient_id=" . $patientid .'';
                    $result = mysqli_query ($con, $sql) ;
                    while($row = mysqli_fetch_array($result)){
                    echo  $row['doctors_notes'];
                    
                        
                    }              
                ?>
                    
                    <tr><td>Nurses Notes:</td> <td>
                
                <?php
                    $sql=" SELECT nurses_notes FROM medical_history WHERE patient_id=" . $patientid .'';
                    $result = mysqli_query ($con, $sql) ;
                    while($row = mysqli_fetch_array($result)){
                    echo  $row['nurses_notes'] . '.';
                    
                        
                    }              
                ?>

                <tr><td>Add Notes:</td> <td> <textarea rows="4" cols="50" name="notes" required >
                   <?php
                    $sql=" SELECT nurses_notes FROM medical_history WHERE patient_id=" . $patientid .'';
                    $result = mysqli_query ($con, $sql) ;
                    while($row = mysqli_fetch_array($result)){
                    echo  $row['nurses_notes'] ;      
                    }
                ?> 
                </textarea></td></tr>
               <tr>
                    <td></td>
                    <td><input class="rounded" type="submit" name="sumbit" id="submit" value="Submit"></td>
                </tr>                
            </table>
			</form>
		</div>
		<div id="sidebar">
		</div>
			<?php
include("pagecomponents/footer.php");
?>
		</div>
        
        <script> 
        jQuery.validator.setDefaults({
          debug: false,
          success: "valid"
        });
        $( "#nursesnotes" ).validate({
          rules: {
            Notes: {
                required: true
               
           
              
            }
          }
        })
        </script>
        
        
        
        
        
        
        
        
        
    </body>
</html>
