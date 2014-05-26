<?php
// Author James Clelland n8888141
// Last modified by Armin Khoshbin on 25/05/2014
// Last modified by James Clelland on 26/05/2014
$permissions=[3,4];
$pagetitle="Doctors Notes";
include("pagecomponents/head.php");
$patientid = $_SESSION["patient_id"]; 


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

                
                
                <?php
                    $sql=" SELECT doctors_notes, nurses_notes, last_updated_by, time_stamp FROM medical_history WHERE patient_id=" . $patientid .'';
                    $result = mysqli_query ($con, $sql) ;
                    while($row = mysqli_fetch_array($result)){
		    if ( !empty($row['time_stamp']) )
		    {
		    echo '<p>This note last time has been changed by <b>'. $row['last_updated_by']. '</b> at <b>'. $row['time_stamp']. '</b></p>';
		    }
		    echo '<tr><td>Notes:</td> <td>';
                    echo 'Doctors Notes:'. $row['doctors_notes'] . ' <br>  Nurses Notes:' . $row['nurses_notes'];
                    }              
                ?>
            <tr><td> Add Notes:</td> <td> <textarea rows="4" cols="50" placeholder="Start typing here..." name="notes" required>
                <?PHP
                $sql=" SELECT doctors_notes FROM medical_history WHERE patient_id=" . $patientid .'';
                    $result = mysqli_query ($con, $sql) ;
                    while($row = mysqli_fetch_array($result)){
                    echo  $row['doctors_notes'] ;   
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
