<div id="wrapper">
		<div id="header"> 
			<h1>View Patients</h1>
            
		</div>
		<div id="content">
            
         <form id="viewpatient" action="" method="">
                <input type="hidden" >
			<table><h3><th colspan="2" class="userdetails"> <?php echo $_SESSION["Name"] ?></th></h3>
                
                 <?php
$sql = "SELECT  A.first_name AS fname,
                A.last_name As lname,
                A.patient_id,
                B.staff_id,
                C.first_name,
                C.last_name
                FROM patient_details A
                JOIN admissions B ON B.patient_id = A.patient_id
           		JOIN staff_details C ON C.staff_id=B.staff_id
                WHERE C.role_id ='3'; ";


$result=mysqli_query($con,$sql);
        while($row = mysqli_fetch_array($result)){
                echo '<table class="patientTable">';
                echo '<tr>';
                    echo '<td>' . $row['fname'] . ' ' . $row['lname'] . '</td>' ;
                    echo '<td>' . $row['first_name'] . ' ' . $row['last_name'] . '</td>' ;
                    echo "<td> <a href='nursenotes.php?id=" . $row['patient_id'] . "'>Nurses Notes</a> </td>";
                   
                echo '</tr>';
                    }
?>
                
                </table>
			</form>
		</div>
		<div id="sidebar">
		</div>