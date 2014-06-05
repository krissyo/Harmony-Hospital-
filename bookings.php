<?php 
include("pagecomponents/permissioncheckscript.php");
$pagetitle="Book a Procedure";
include("pagecomponents/head.php");

?>
	<body>
		<div id="wrapper">
			
			<div id="header">
				<h1>Patient Bookings</h1>
			</div>
				<div id="content">
				<form id="bookingsform" class="sigPad" method="post" action="submit/bookingsubmit.php">
					<?php 
					$patient_details = array();
					require ("pagecomponents/patient_basic_details.php"); 
					pull_details($patient_details);
					
					if (count($patient_details) !== 0) {
						?>
						
						<input type="hidden" name="AdmissionId" id="AdmissionId" value="<?php echo $patient_details['admission_id']; ?>">
						<table id = "bookingTable">
						<h3><th colspan="2" class="bookingdetails">Booking Details</th></h3>
						
						<tr><td>Patient's ID</td><td>
							<input type="text" class="rounded" name="PatientId" id="PatientId" value="<?php echo $_SESSION['patient_id']; ?>">
							</td></tr>						
						<tr><td>Patient's Name</td><td>
							<input class="rounded" type="text" name="PatientName" id="PatientName" value="<?php echo $patient_details['full_name']; ?>">
							</td></tr>
							
						<tr><td>Date Of Birth</td><td> 
							<input class="rounded" type="date" name="DateOfBirth" id="DateOfBirth"value="<?php echo $patient_details["date_of_birth"]; ?>">
							</td></tr>
						<tr><td>Specialist</td><td><select class="rounded" name='StaffId'>
							<?php
							
								require_once('pagecomponents/connectDB.php');
								
								$sql="SELECT staff_id, first_name, last_name from staff_details;";
								$result=mysqli_query($con,$sql);
								while($row = mysqli_fetch_array($result)){
									echo "<option value='" . $row["staff_id"] . "'>" . $row["last_name"] . ", " . $row["first_name"] . "</option>";
							}
							?>
							</select></td></tr>
						<tr><td>Procedure</td><td><select class="rounded" name="ProcedureId">
						<?php include ("pagecomponents/procedure_type.php"); ?>
						</select></td></tr>
						<tr><td>Facility</td><td><select class="rounded" name="ResourceId">
						<?php
							$sql="SELECT department_description, resource_id, resource_description FROM departments Natural Join resources";
							$result=mysqli_query($con,$sql);
							while($row = mysqli_fetch_array($result)){
								echo "<option value='" . $row["resource_id"] . "'>" . $row["department_description"] . " " . $row["resource_description"] . "</option>";
							}
						?>
						</select></td></tr>
						<tr><td>Booking Date</td><td>
						<input class="rounded" type="date" name="StartDate" id="StartDate" value="<?php echo date('Y-m-d'); ?>" required>
						</td></tr>					
						<tr><td>Start Time</td><td><input type="time" name="StartTime" id="StartTime" required></td></tr>
							
						<tr><td>Finish Time</td><td><input type="time" name="FinishTime" id="FinishTime" required></td></tr>
						
						<tr><td></td><td><a href="terms_and_conditions.php" title="T & C" style="font-size: 0.5em;">Terms and Conditions</a></td></tr>
						
						<tr><td>Guardian's Name:</td> <td><select class="rounded" name="GuardianName">
						<?php
							$sql="SELECT carer1_name, carer2_name, send_bill_to FROM patient_details 
									WHERE patient_id = " . $_SESSION['patient_id'];
							$result=mysqli_query($con,$sql);
							
							while($row = mysqli_fetch_array($result)){
								if (ISSET($row["carer1_name"]))
									echo "<option value='" . $row["carer1_name"] . "'>" . $row["carer1_name"] . "</option>";
								if (ISSET($row["carer2_name"]))
									echo "<option value='" . $row["carer2_name"] . "'>" . $row["carer2_name"] . "</option>";
								if (ISSET($row["send_bill_to"])) {
									if (($row["send_bill_to"] !== $row["carer1_name"]) && ($row["send_bill_to"] !==$row["carer2_name"]))
										echo "<option value='" . $row["send_bill_to"] . "'>" . $row["send_bill_to"] . "</option>";
								}
							}
						?>					
						</select></td></tr>					
						<tr><td>Signature of Parent/Guardian:</td> <td><div class="sig sigWrapper">
						<canvas class="pad" width="198" height="60" name="signiture"></canvas>
						<script> $(document).ready(function () {
						$('.sigPad').signaturePad({drawOnly:true});
						}); </script>
						<input type="hidden" name="output" class="output" required></div></td></tr>
						<tr><td>Date:</td> <td> <input class="rounded" type="date" name="ConsentDate" id="ConsentDate" value="<?php echo date('Y-m-d'); ?>"></td></tr>
						
						<tr><td></td><td><input class="rounded" type="submit" name="submit" id="submit" value="Make a Booking"></td></tr>
						</table>
				<?php
				} else {
					echo 'Sorry, cannot perform a booking for a discharged patient.';
				
				}
				?>
				</form>
			</div>
			
			<div id="sidebar">
			</div>
			
			<?php
			include("pagecomponents/footer.php");
			require_once('pagecomponents/closeConnection.php');
			?>		
			
		</div>
        
        <script> 
        jQuery.validator.setDefaults({
          debug: false,
          success: "valid"
        });
        $( "#bookingsform" ).validate({
          rules: {
            PatientId: {
              required: true,
               digits: true
            },
            PatientName: {
              required: true,
                minlength: 3
            },
            DateOfBirth: {
                required: true,
                date: true
            },
             StartDate:{
                required: true,
                date: true
             },
              ConsentDate:{
                required: true,
                date: true  
            }
          }
        })
        </script>

	</body>
</html>
