<div id="wrapper">
		<div id="header">
			<h1>Surgery Bookings for the upcoming week</h1>
            <div id="content">
			<form id="dpt_bookings" enctype="multipart/form-data">
                
			<table>
			<?php
			require_once('pagecomponents/connectDB.php');
			// Find out the user's department
			if (ISSET($_SESSION['userID'])) {
				$sql = 'SELECT department_id FROM staff_details WHERE staff_id = ' . $_SESSION['userID'];
				$result = mysqli_query($con,$sql);
				if ($result !== false) {
					$row = mysqli_fetch_array($result);
					$depId = $row['department_id'];
					
					// Query the DB to get a list of bookings
					// for the user's department
					// for today
					// end of week calculation
					$end_date = date('Y-m-d');
					$end_date = strtotime($end_date);
					$end_date = strtotime("+7 day", $end_date);
					$end_date = date('M d, Y', $end_date);
					echo 'Upcoming week from ' . date('M d, Y') . ' to ' . $end_date;
					
					$sql = "SELECT booking_date, start_time, admissions.patient_id, 
					CONCAT(pd.last_name, ', ', pd.first_name) as patient_name, 
					procedure_listing.procedure_description,
					CONCAT(staff_details.last_name, ', ', staff_details.first_name) as staff_name 
					from bookings
					inner join admissions on bookings.admission_id = admissions.admission_id
					inner join patient_details pd on pd.patient_id = admissions.patient_id
					inner join procedure_listing on bookings.procedure_id = procedure_listing.procedure_id
					inner join resources on bookings.resource_id = resources.resource_id
					inner join staff_details on bookings.staff_id = staff_details.staff_id
					where bookings.procedure_id IN (1, 2, 5) AND 
					resources.department_id = " . $depId .
					" AND (booking_date >= '" . date('Y-m-d') .
					"' AND booking_date <= '" . $end_date .
					"') ORDER BY booking_date, start_time";
					
					$result = mysqli_query($con,$sql);

					if ($result !== false) {
						while ($row = mysqli_fetch_array($result)) {
							echo '<tr>';
							
								echo '<td>' . $row['booking_date'] . '</td>';
								echo '<td>' . $row['start_time'] . '</td>';								
								echo '<td>' . $row['patient_name'] . '</td>';
								echo '<td>' . $row['procedure_description'] . '</td>';
								echo '<td>' . $row['staff_name'] . '</td>';
					
							echo '</tr>';
						}
					} else {
						// No bookings for today
							echo '<tr>';
							
								echo '<td>No surgery bookings on record.</td>';
					
							echo '</tr>';
					}
				} else {
					// department Id is not set for this user
						echo '<tr>';
							
							echo '<td>Department Id is not set for your username.</td>';
					
						echo '</tr>';
				}
				
			} else {
				// Session variable for User id is not set
				echo '<tr>';
							
					echo '<td>User Id is not set.</td>';
					
				echo '</tr>';
			}

			?>
            </table>
			</form>
		</div>
		<div id="sidebar">
		</div>
		<div id="footer">
		</div>
            
            <?php
			require_once('pagecomponents/closeConnection.php');
	    ?>
