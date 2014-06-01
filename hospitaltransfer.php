<?php
include("pagecomponents/permissioncheckscript.php");
$pagetitle="Hospital Transfer";
include("pagecomponents/head.php");


$patientid = $_SESSION["patient_id"];
date_default_timezone_set('Australia/Brisbane');
$date = date('Y-m-d');

	if (!isset($patientid)){
        echo " Patient id is not set";
    }else{
        $sql= " SELECT A.patient_id,
                        A.first_name,
                        A.last_name,
                        B.patient_id,
                        B.discharge_date
                        FROM patient_details A
                        JOIN admissions B ON B.patient_id = A.patient_id
                        WHERE B.patient_id = '$patientid';";
                        $result=mysqli_query($con,$sql);
                        $row = mysqli_fetch_array($result);
?>

		<div id="wrapper">
		<div id="header">
			<h1>Hospital Transfer</h1>
            
		</div>
		<div id="content">
            <form id="HospitalTransfer" action="submit/hospitaltransfersubmit.php" method="post">
                <input type="hidden" >
			<table>
                <h3><th colspan="2" class="userdetails"> <?php echo $row['first_name'] . ' ' . $row['last_name'];?> </th></h3>
                <tr><td>Date of Discharge:</td> <td> <input class="rounded" type="date" max="<?PHP echo $date;?>" name="DateDis" id="DateoDis" value="<?php echo $row['discharge_date'];?>"required></td></tr>           
                <tr><td> Transferee Hospital:</td> <td><select class="rounded" name="hospital" id="hospital">
                <?php
                        
							$sql="SELECT *  FROM hospitals";
                            $result=mysqli_query($con,$sql);
                            while($row = mysqli_fetch_array($result)){
                            echo "<option value='" . $row["hospital_name"] . "'>" . $row["hospital_name"] . "</option>";
                	}								
						  ?>
                </select></td>
                <tr><td>Notes:</td> <td> <textarea rows="4" cols="50" placeholder="Start typing here..." name='notes' required></textarea></td></tr>   
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
        $( "#HospitalTransfer" ).validate({
          rules: {
              DateDis: {
                 required: true,
                 date: true 
              },
              Transfer: {
                required: true
              },
              notes: {
                required: true  
            }
          }
        })
        </script>
    </body>
</html>

