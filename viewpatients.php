<?php
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
    
    
$sql = "SELECT * FROM patient_details";
$result=mysqli_query($con,$sql);
     $total = mysqli_num_rows($result);
  if($total > 0){
        while($row = mysqli_fetch_array($result)){
            echo '<table class="patientTable">';
            echo '<tr></tr>';
            echo '<td>'. $row['first_name'] . ' ' . $row['last_name'];
            echo "<td> <a href='nursenotes.php?id=" . $row['patient_id'] . "'>Nurses Notes</a> </td>";
            echo "<td> <a href='doctorsnotes.php?id=" . $row['patient_id'] . "'>Doctors Notes</a> </td>";
            echo "<td> <a href='patientprofile.php?id=" . $row['patient_id'] . "'>Profile</a> </td>";
            
        }
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