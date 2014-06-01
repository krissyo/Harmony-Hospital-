<?php
include("pagecomponents/permissioncheckscript.php");
$pagetitle="Death Form";
include("pagecomponents/head.php");
$patientid = $_SESSION["patient_id"]; 
$sql="SELECT * from patient_details where patient_id ='$patientid'";
				$result=mysqli_query($con,$sql);
                $row = mysqli_fetch_array($result);
?>

		<div id="wrapper">
		<div id="header">
			<h1>Death</h1>
            
		</div>
		<div id="content">
			<form id="death" action="submit/deathsubmit.php" method="post">
                <input type="hidden" >
			<table><h3><th colspan="2" class="userdetails">
                <?php
                    echo $row['first_name'] . ' ' . $row['last_name'];    
                ?>
                </th></h3>
               
            <tr><td>Date of Death</td> <td><input class="rounded" type="date" name="DOD" id="DOD" value="<?php echo $row['date_of_death'];?>  " required></td></tr>   
            <tr><td> Authorising person:</td> <td><select class="rounded" name="AuthPerson" id="AuthoPerson">
                <?php
                            require_once('pagecomponents/connectDB.php');
							$sql="SELECT staff_id, first_name,last_name FROM staff_details WHERE role_id = 4";
                            $result=mysqli_query($con,$sql);
                            while($row = mysqli_fetch_array($result)){
                            echo "<option value='" . $row["staff_id"] . "'>" . $row["first_name"] . ' ' .$row['last_name'] .  "</option>";
                	}								
						  ?>
                </select></td>
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
        $( "#death" ).validate({
          rules: {
            PatientId: {
              required: true,
               digits: true
            },
            Authorising: {
              required: true,
                minlength: 3
           
            }
          }
        })
        </script>







    </body>
</html>