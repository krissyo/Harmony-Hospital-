<?php
include("pagecomponents/permissioncheckscript.php");
$pagetitle="View Patients";
include("pagecomponents/head.php");
?>
 <body>
      
		<div id="wrapper">
		<div id="header"> 
			<h1>View Patients</h1>
            
		</div>
		<div id="content">
            
         <form id="viewpatient" action="" method="">
                <input type="hidden" >
			<table><h3><th colspan="2" class="userdetails"> <?php echo $_SESSION["Name"] ?></th></h3>
                
                <?php
$sql = "SELECT  A.staff_id,
                A.bed_id,
                A.discharge_date,
                B.patient_id,
                B.first_name,
                B.last_name,
                C.bed_description
                FROM admissions A
                JOIN patient_details B on B.patient_id =A.patient_id
                JOIN beds C on C.bed_id = A.bed_id
                WHERE A.discharge_date IS NULL AND A.staff_id =" . $_SESSION["userID"] . '' ;        // Once patient is discharge name will be taken off
                
$result=mysqli_query($con,$sql);
        while($row = mysqli_fetch_array($result)){
                echo '<table class="patientTable">';
                echo '<tr>';
                    echo '<td>' . $row['first_name'] . ' ' . $row['last_name'] . '</td>' ;
                    echo '<td>'. $row['bed_description'] . '</td>' ;
                    echo "<td> <a href='doctorsnotes.php?id=" . $row['patient_id'] . "'>Doctors Notes</a> </td>";
                     echo "<td> <a href='viewpatientresults.php?id=" . $row['patient_id'] . "'> View Results</a> </td>";
                    echo "<td> <a href='patientprofile.php?id=" . $row['patient_id'] . "'>Profile</a> </td>";
                echo '</tr>';
                    }
?>
                
                </table>
			</form>
		</div>
		<div id="sidebar">
		</div>
			<?php
include("pagecomponents/footer.php");
?>
		</div>
     
    </body>
</html> 
<!--     Author James Clelland -->
