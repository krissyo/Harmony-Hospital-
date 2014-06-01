<?php
include("pagecomponents/permissioncheckscript.php");
$pagetitle="Admissions History";
include("pagecomponents/head.php");
?>
	<body>
		<div id="wrapper">
			
			<div id="header">
				<h1>Patient's Admissions History</h1>
			
				<div id="content">
				<form id="admissionHistoryForm">
				
					<?php 
					
					// get the patient info from the DB
					$patient_details = array();
					require ("pagecomponents/patient_basic_details.php"); 
					pull_details_basic($patient_details);

					?>
					
					<table>
					<tr><td>Patient's ID</td><td>
						<label><?php echo $_SESSION['patient_id']; ?></label>
						</td></tr>						
					<tr><td>Patient's Name</td><td>
						<label><?php echo $patient_details['full_name']; ?></label>
						</td></tr>
						
					<tr><td>Date Of Birth</td><td> 
						<?php
						echo '<label>' . 
							date("d/m/Y", strToTime($patient_details["date_of_birth"])). '</label>';
						?>
						</td></tr>
					</table>
					
					<table id="admHistory">

						<?php
						// get data from DB
						require_once('include/getAdmissionsHistory.inc');
						
						getHistory($_SESSION['patient_id']);
					?>

					</table>

					
					<input type="button" onclick="location.href = 'patientdetail.php'"
					name="backToAccount" id="backToAccount" value="Back to Patient Details Form">

	
				</form>
			</div>
			
			<div id="sidebar">
			</div>
			
			<?php
			include("pagecomponents/footer.php");
			?>		
			</div>
		</div>
	</body>
</html>