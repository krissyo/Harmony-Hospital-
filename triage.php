<?php
$pagetitle="Triage Form";
include("pagecomponents/head.php");
?>
		<div id="wrapper">
		<div id="header">
			<h1>Triage Form</h1>
            
		</div>
		<div id="content">
  
                
                <form id="triage" action="submit/triagesubmit.php" method="post">
                <input type="hidden" >
       
			<table><h3><th colspan="2" class="userdetails">Patient Details</th></h3>
                <?php 
                //use this code where ever session storage is needed 
                    include("pagecomponents/checklogin.php");
                ?>
                <tr><td>First Name:</td> <td><input class="rounded" type="text" name="fname" id="FirstName" required></td></tr>
                <tr><td>Last Name:</td> <td> <input class="rounded" type="text" name="lname" id="LastName" required></td></tr>
                <tr><td>Date of Birth:</td> <td> <input class="rounded" type="date" name="DateofBirth" id="DateofBirth" required></td></tr>
                <tr><td>Date Admitted:</td> <td> <input class="rounded" type="date" name="Date" id="Date" required></td></tr>
                <!--<tr><td>Condition of Patient:</td> <td> <input class="rounded" type="Condition" name="Condition" id="Condition" required></td></tr>-->
                
                
                
                   
                
                <tr><td>Allergies:</td> <td> 
                
        <?php

                require_once('pagecomponents/connectDB.php');
				$sql="SELECT name from allergies_conditions where description ='Allergy'";
				$result=mysqli_query($con,$sql);
				while($row = mysqli_fetch_array($result)){
                echo "<input type=\"checkbox\" name=\"Aname[]\" value=\"{$row['name']}\" /> {$row['name']}<br />";
    }

?>

<tr><td> Conditions:</td> <td> 
     <?php            
				$sql="SELECT name from allergies_conditions where description ='Condition'";
				$result=mysqli_query($con,$sql);
				while($row = mysqli_fetch_array($result)){
                echo "<input type=\"checkbox\" name=\"Cname[]\" value=\"{$row['name']}\" /> {$row['name']}<br />";
    }

?>      
                
                
                
                
                <!--<tr><td>Distress Level:</td> <td> <input class="rounded" type="Distress" name="Distress" id="Distress" required></td></tr>
                <tr><td>Conscious: </td><td><input type="radio" name="certificate" value="yes">Yes </input></td>
                    <td><input id="no" type="radio" name="certificate" value="No">No</input></td></tr>
                <tr><td>Specialist Refferal:</td> <td> <input class="rounded" type="Specialist" name="Specialist" id="Specialist" required></td></tr>
                <tr>
                    <td></td>-->
                    <td><input class="rounded" type="submit" name="sumbit" id="submit" value="Submit"></td>
                </tr>
            </table>
			
			</form>
		</div>
		<div id="sidebar">
		</div>
			<?php
			require_once('pagecomponents/closeConnection.php');
include("pagecomponents/footer.php");
?>
		</div>
    </body>
</html>

