<?php
session_start();
$pagetitle="Patient's Account";
include("pagecomponents/head.php");
?>
	<body>
		<div id="wrapper">
			
			<div id="header">
				<h1>Patient's Account</h1>
			
				<div id="content">
				<form id="accountForm" method="post" action="update_patient_service.php">
				
					<?php 
					// get the patient info from the DB
					$patient_details = array();
					require ("pagecomponents/patient_basic_details.php"); 
					pull_details($patient_details);
					
					// set the admission record session variable
					$_SESSION[admission_id] = $patient_details['admission_id'];
					?>
					
					<table>
					<tr><td>Patient's ID</td><td>
						<input type="text" class="rounded" name="PatientId" id="PatientId" value="<?php echo $_SESSION['patient_id']; ?>">
						</td></tr>						
					<tr><td>Patient's Name</td><td>
						<input class="rounded" type="text" name="PatientName" id="PatientName" value="<?php echo $patient_details['full_name']; ?>">
						</td></tr>
						
					<tr><td>Date Of Birth</td><td> 
						<?php
						echo '<input class="rounded" type="date" name="DateOfBirth" id="DateOfBirth"value="' . 
							$patient_details["date_of_birth"] . '">';
						?>
						</td></tr>
					</table>
					
					<input type="hidden" name="AdmissionId" id="AdmissionId" value="<?php echo $patient_details['admission_id']; ?>">
					<input type="hidden" name="recordId" id="recordId" value="0">
					
					<table id="accountTable">
					<h3><th colspan="9">Services / Procedures</th></h3>
					
					<tr>
					<th scope="col">Id</th><th>Select</th><th scope="col">Start Date</th><th scope="col">End Date</th>
					<th scope="col">Service</th>
					<th scope="col">Fee</th><th scope="col">Subtotal</th>
					
					<th scope="col">Rebate</th><th scope="col">Subtotal</th>
					<th scope="col">Days</th>
					</tr>
					
					<?php
					
					$_SESSION['feesGrandTotal'] = 0;
					$_SESSION['medicareGrandTotal'] = 0;
					
					// Special conversion used to convert 
					// date difference into days
					$CONVERSION = 86400;
					
					// Testing with AddmissionId = 1
					if (!isSet($_SESSION[admission_id])) {
						$_SESSION[admission_id]  = $patient_details['admission_id'];
					} 
					
					//extract info from DB
					require_once ('pagecomponents/connectDB.php');
					
					$sql = 'SELECT patient_procedure_id, 
							service_start_date, service_end_date,
							procedure_description, procedure_fee, 
							medicare_rebate
							FROM patient_services 
							INNER JOIN procedure_listing
							ON patient_services.procedure_id = procedure_listing.procedure_id
							WHERE admission_id = ' . $patient_details['admission_id'] . ' ORDER BY service_start_date;';
							
					$result=mysqli_query($con,$sql);
					
					$rowCount = 0;
					
					// Display info in the table
					while($row = mysqli_fetch_array($result)){
					
						// Variables to store the Fees / Rebate amounts
						$feesTotal = 0;
						$medicareTotal = 0;
						
						if ($rowCount % 2 == 0) {
							echo '<tr class = "altRow">';
						} else {
							echo '<tr>';
						}
						
						echo "<td>" . $row['patient_procedure_id'] . "</td>";
						
						// For the first radio-button make it selected by default
						// also insert the patient_procedure_id into the hidden field
						// for the Update Service Form
						if ($rowCount == 0) {
							echo "<script>document.getElementById('recordId').value = '" . $row['patient_procedure_id'] . "'</script>";
							echo "<td><input type='radio' name='record_id' value='" . $row['patient_procedure_id'] . "' checked ";
						} else {
							echo "<td><input type='radio' name='record_id' value='" . $row['patient_procedure_id'] . "' ";
						}
						echo "onclick = 'setRecordId(this.value);'/></td>";
						
						$startDate = date("d/m/Y", strToTime($row['service_start_date']));
						echo "<td>" . $startDate . "</td>";
						
						if (!is_null($row['service_end_date'])) {
							
							$endDate = date("d/m/Y", strToTime($row['service_end_date']));
						} else {
							
						}
						
						echo "<td>" . $endDate . "</td>
						<td>" . $row['procedure_description'] . "</td>
						<td>$" . number_format($row['procedure_fee'], 2) . "</td>";
							
						
						
						// Add to the running totals
						if (is_null($row['service_end_date'])) {
						
							// Calculate fees as at today's date
							$row['service_end_date'] = date('Y-m-d');
						} 		

						if ($row['service_start_date'] == $row['service_end_date']) {
						
							$days = 1;
							
						} else {

							$days = round(abs(strtotime($row['service_start_date'])-strtotime($row['service_end_date']))/$CONVERSION);
						}
						
						$feesTotal = $row['procedure_fee'] * $days;
						$medicareTotal = $row['medicare_rebate'] * $days;
						
						$_SESSION['feesGrandTotal'] += $feesTotal;
						$_SESSION['medicareGrandTotal'] += $medicareTotal;

						echo "<td>$" . number_format($feesTotal, 2) . "</td>";
						
						echo "<td>$" . number_format($row['medicare_rebate'], 2) . "</td>";
						
						echo "<td>$" . number_format($medicareTotal, 2) . "</td>";
						
						echo "<td>$days</td>";
						
						echo '</tr>';
						$rowCount += 1;
					} //end while loop
					
					?>

					</table>
					
					<?php
						// Display the Grand Total amounts
						echo '<br />';
						echo '<p>Grand Total Fees: $' . number_format($_SESSION['feesGrandTotal'], 2) . '</p>';
						echo '<p>Grand Total Rebates: $' . number_format($_SESSION['medicareGrandTotal'], 2) . '</p>';
						echo '<p>Gap Amount Total: $' . number_format(($_SESSION['feesGrandTotal'] - $_SESSION['medicareGrandTotal']), 2) . '</p>';
					?>
					
					<input class="rounded" type="button" name="invoiceBtn" id="generateInvoice" value="Invoice"
									onclick="location.href = 'services_invoice.php'">
					<input class="rounded" type="submit" name="updateBtn" id="updateService" value="Update Service">
				<script>
				function setRecordId(radioBtnValue) {
					document.getElementById("recordId").value = radioBtnValue;
				}
				</script>	
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