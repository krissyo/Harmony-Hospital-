<?php
session_start();
if (isset($_SESSION['userID']))
	{
		$userId = $_SESSION['userID'];
	}
$current_page = basename($_SERVER['PHP_SELF']);
require 'include/check_access.inc';
if (check_access($userId, $current_page) == false)
{
	die("Sorry, You don't have access to this page!");
}
$pagetitle="Update Patient Service";
include("pagecomponents/head.php");

if(isset($_POST['recordId'])) {
    $_SESSION['patientProcedureId'] = $_POST['recordId'];
	
	require_once('pagecomponents/connectDB.php');
	$sql="SELECT * FROM patient_services 
			WHERE patient_procedure_id = " . $_SESSION['patientProcedureId'];
	$result=mysqli_query($con,$sql);
	
	while($row = mysqli_fetch_array($result)){
		$_SESSION['procedure_id'] = $row['procedure_id'];
		$_SESSION['staff_id'] = $row['staff_id'];
		$_SESSION['service_start_date'] = $row['service_start_date'];
		$_SESSION['service_end_date'] = $row['service_end_date'];
		$_SESSION['signature'] = $row['guardian_signature'];
		$_SESSION['consent_date'] = $row['consent_date'];
	}
}
?>
    <body>
		<div id="wrapper">
			<div id="header">
				<h1>Update Patient Services Form</h1>
			</div>
			
			<div id="content">
				<form id="patient_services" method="post" action="submit/patient_services_submit.php">
					<?php 
					$patient_details = array();
					require ("pagecomponents/patient_basic_details.php"); 
					pull_details($patient_details);
					?>
					
					<input type="hidden" name="AdmissionId" id="AdmissionId" value="<?php echo $patient_details['admission_id']; ?>">
					<input type="hidden" name="patientProcedureId" id="patientProcedureId" value="<?php echo $_SESSION['patientProcedureId']; ?>">
					
					<table>
					
					<h3><th colspan="2" class="bookingdetails">Services Details</th></h3>

					<tr><td>Patient's ID</td> <td>
						<input type="text" class="rounded" name="PatientId" id="PatientId" value="<?php echo $_SESSION[patient_id]; ?>">
						</td></tr>	
						
					<tr><td>Patient's Full Name</td> <td>
						<input class="rounded" type="text" name="PatientName" id="PatientName" value="<?php echo $patient_details['full_name']; ?>">
						</td></tr>		
						
					<tr><td>Date Of Birth</td> <td> 
						<input class="rounded" type="date" name="DateOfBirth" id="DateOfBirth"value="<?php echo $patient_details['date_of_birth']; ?>">
						</td></tr>
						
					<tr><td>Service Type</td> <td><select class="rounded" name="ProcedureId">					
					<?php 
					$sql="SELECT procedure_id, procedure_description FROM procedure_listing";
					$result=mysqli_query($con,$sql);
					while($row = mysqli_fetch_array($result)){
						if ($row['procedure_id'] == $_SESSION['procedure_id']) {
							echo "<option value='" . $row["procedure_id"] . "' selected>" . $row["procedure_description"] . "</option>";
						} else {
							echo "<option value='" . $row["procedure_id"] . "'>" . $row["procedure_description"] . "</option>";
						}
						
					} ?>
					</select></td></tr>
					
					<tr><td>Specialist</td> <td><select class="rounded" name="SpecialistId">					
					<?php 
					$sql="SELECT staff_id, first_name, last_name from staff_details;";
					$result=mysqli_query($con,$sql);
					
					while($row = mysqli_fetch_array($result)){
						if ($row['staff_id'] == $_SESSION['staff_id']) {
							echo "<option value='" . $row["staff_id"] . "' selected>" . $row["last_name"] . ", " . $row["first_name"] . "</option>";
						} else {
							echo "<option value='" . $row["staff_id"] . "'>" . $row["last_name"] . ", " . $row["first_name"] . "</option>";
						}
						
					} ?>
					</select></td></tr>
					
					<tr><td>Service Start Date</td> <td> 
						<input class="rounded" type="date" name="StartDate" id="StartDate" value="<?php echo $_SESSION['service_start_date']; ?>">
					</td></tr>
					
					<tr><td>Service End Date</td> <td> 
						<input class="rounded" type="date" name="EndDate" id="EndDate" value="<?php echo $_SESSION['service_end_date']; ?>">
					</td></tr>
					
					<tr><td></td><td><a href="terms_and_conditions.php" title="T & C" style="font-size: 0.5em;">Terms and Conditions</a></td></tr>
					
<!--					<tr><td>Signature of Parent/Legal Guardian:</td> <td> <input class="rounded" type="text" 
						name="Signature" id="Signature" value="<?php echo $_SESSION['signature']; ?>"></td>
-->


					<tr><td>Signature of Parent/Legal Guardian:</td> <td><img src="signatureimg/<?php echo $_SESSION['signature'];?>">
					</td>
					</tr>
					<tr>
					<td>Date:</td> <td> <input class="rounded" type="date" name="ConsentDate" id="ConsentDate" 
						value="<?php echo $_SESSION['consent_date']; ?>">
						</td></tr>
					<tr>
                    <td></td>
                    <td><input class="rounded" type="submit" name="submit" id="submit" value="Update"></td>
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