<?php
$permissions=[3,4];
$pagetitle="Doctors Notes";
include("pagecomponents/head.php");
$patientid = $_GET["id"];
$_SESSION['passingID'] = $patientid; // Passing ID to doctors notes submit

?>
    <body>
      
		<div id="wrapper">
		<div id="header"> 
			<h1>Doctor's Notes</h1>
            
		</div>
		<div id="content">
            
         <form id="doctorsnotes" action="submit/doctorsnotessubmit.php" method="post">
                <input type="hidden" >
            
            
			<table><h3><th colspan="2" class="userdetails">
                <?php
                    $sql=" SELECT first_name, last_name FROM patient_details WHERE patient_id=" . $patientid .'';
                    $result = mysqli_query ($con, $sql) ;
                    while($row = mysqli_fetch_array($result)){
                    echo $row['first_name'] . ' ' . $row['last_name'];
                    }              
                ?></th></h3>
<!--            <tr><td>Current Medication:</td> <td> <input class="rounded" type="Medication" name="Medication" id="Medication"></td></tr>-->
                
                <tr><td>Notes:</td> <td>
                
                <?php
                    $sql=" SELECT doctors_notes, nurses_notes FROM medical_history WHERE patient_id=" . $patientid .'';
                    $result = mysqli_query ($con, $sql) ;
                    while($row = mysqli_fetch_array($result)){
                    echo 'Doctors Notes:'. $row['doctors_notes'] . ' <br>  Nurses Notes:' . $row['nurses_notes'];
                    }              
                ?>
            <tr><td> Add Notes:</td> <td> <textarea rows="4" cols="50" placeholder="Start typing here..." name="notes" required></textarea></td></tr>  
   
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
        $( "#doctorsnotes" ).validate({
          rules: {
              Notes:{
                required: true
              
            }
          }
        })
        </script>

    </body>
</html>