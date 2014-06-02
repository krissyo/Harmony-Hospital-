<?php
include("pagecomponents/permissioncheckscript.php");
$pagetitle="Patient Detail Form";
include("pagecomponents/head.php");

// Check for a current admission for this patient

include("include/find_admission_id.inc");

require_once('pagecomponents/connectDB.php');

				
				if (ISSET($_SESSION['patient_id'])) {
					$sql="SELECT * from patient_details where patient_id =" . $_SESSION['patient_id'];
				}
				$result=mysqli_query($con,$sql);
                $row = mysqli_fetch_array($result);
?>

    <div id="wrapper">
        <div id="header">
            <h1>PATIENT DETAIL FORM</h1>
        </div>
        <div id="content">
            <div name=" buttonWrapper" id="centre">
			
			<?php
			if (ISSET($_SESSION['admission_id'])) {
			?>
				<button  id="curAdmissionBtn" class="linkingButtons" 
				onclick="location.href = 'processAdmission.php'">Current Admission</button>
			<?php
			} else {
			?>
				<button  id="admitBtn" class="linkingButtons"
				onclick="location.href = 'processAdmission.php'">New Admission</button>
			<?php
			}
			?>
			<button  id="admHistoryBtn" class="linkingButtons"
			onclick="location.href = 'patient_account.php'">Patient's Account</button>
			
            <button  id="admHistoryBtn" class="linkingButtons"
			onclick="location.href = 'view_admission_history.php'">
			Admissions History</button>
            
                </div>
            <br /><br />
            <form id="patientDetailForm" method="post" action="submit/patientdetailsubmit.php">
            <input type="hidden">
            <table>

                <tr>
               <td> First name: </td>
               <td><input name="first-name" id="first-name"  type="text" value="<?PHP echo $row['first_name']?>" required></td>
                </tr>
             
                <tr>
                    <td> Middle name: </td>
                    <td><input name="middle-name" id="middle-name"  type="text" value="<?PHP echo $row['middle_name']?>"></td>
                    </tr>
                
                <tr>
                    <td> Last name: </td>
                    <td><input name="last-name" id="last-name" type="text" value="<?PHP echo $row['last_name']?>" required></td>
                    </tr>
                <tr>
                    <td>Date of birth:</td>
                    <td><input name="DOB" id="DOB" type="date" value="<?PHP echo $row['date_of_birth']?>" required></td>
                </tr>
                  <tr>
                    <td>Date of death:</td>
                    <td><input name="DOD" id="DOD" type="date" value="<?PHP echo $row['date_of_death']?>"></td>
                </tr>
                   
                   <tr>
				   
				   <td>Gender: </td> 
				   <td style="border: 1px solid grey;"><input type="radio" name="sex" value="male" checked>Male<br>
					<input type="radio" name="sex" value="female">Female</td>
					
					</tr>
					
                 <tr>
                    <td> Allergies: </td>
                     <td style="border: 1px solid grey;"><?php

                require_once('pagecomponents/connectDB.php');
				// first check for any existing allergies
				$sql = "SELECT allergies, conditions FROM medical_history WHERE patient_id = " .$_SESSION['patient_id'];
				$result = mysqli_query($con,$sql);
				
				if ($result !== false) {	// fetch existing allergies
					$record = mysqli_fetch_array($result);
					if (ISSET($record['allergies']) && !IS_NULL($record['allergies'])) 
						$array_of_allergies = explode(",", $record['allergies']);
					if (ISSET($record['conditions']) && !IS_NULL($record['conditions'])) 
						$array_of_conditions = explode(",", $record['conditions']);
				}
					
				// display checkboxes to choose from
				$sql="SELECT name from allergies_conditions where description ='Allergy'";
				$result=mysqli_query($con,$sql);
				while($data = mysqli_fetch_array($result)){
					$name = $data['name'];
					if (in_array($name, $array_of_allergies)) {
						echo "<input type=\"checkbox\" name='Aname[]' value=\"$name\" checked />$name<br />";
					} else {
						echo "<input type=\"checkbox\" name='Aname[]' value=\"$name\" />$name<br />";
					}					
				}
				
				?>
                     
                    </td></tr>
                <tr>
                    <td> Conditions: </td>
                   <td style="border: 1px solid grey;"> <?php            
                require_once('pagecomponents/connectDB.php');
				$sql="SELECT name from allergies_conditions where description ='Condition'";
				$result=mysqli_query($con,$sql);
				while($data = mysqli_fetch_array($result)){
					$name = $data['name'];
					
					if (in_array($name, $array_of_conditions)) {
						echo "<input type=\"checkbox\" name=\"Cname[]\" value=\"$name\" checked />$name<br />";
					} else {
						echo "<input type=\"checkbox\" name=\"Cname[]\" value=\"$name\" />$name<br />";
					}

                }

                    ?>  
                    
                    </td></tr>
                <tr>
                    <td> Medicare Number: </td>
                    <td><input name="medicare-number" id="medicare-number" value="<?PHP echo $row['medicare_number']?>" required type="text"></td>
                    </tr>
                <tr>
                    <td> Medicare Exp Date:</td>
                    <td><input  type="date" name="medicare-exp" id="medicare-exp" value="<?PHP echo $row['medicare_expiry_date']?>" required></td>
                    </tr>
                <tr>
                    <td></td>
                    <td><input class="rounded" type="submit" name="submit" id="submit" value="Update"></td>
                </tr>
            </table>
			</form>
        
        </div>
    	<?php
include("pagecomponents/footer.php");
?>
    </div>
    
    </body></html>