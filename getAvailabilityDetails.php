<?php
$resourceId = intval($_GET['q']);
$bookingDate = $_GET['second_param'];

// Array of time intervals
$intervals = array('00:00:00', '01:00:00','02:00:00', '03:00:00', '04:00:00', 
			'05:00:00', '06:00:00', '07:00:00', '08:00AM', '09:00:00', '10:00:00',
			'11:00:00', '12:00:00', '13:00:00', '14:00:00', '15:00:00', '16:00:00',
			'17:00:00', '18:00:00', '19:00:00', '20:00:00', '21:00:00', '22:00:00',
			'23:00:00', '24:00:00');

include ("pagecomponents/connectDB.php");

if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

$sql="SELECT start_time, finish_time 
	FROM bookings WHERE resource_id = '" . $resourceId . "' 
	AND booking_date = '" . $bookingDate . "' 
	ORDER BY start_time;";
	
// Format the Booking date to "dd/mm/yyyy" style
$strDate = date("d/m/Y", strToTime($bookingDate));

echo "<table border='1' id='availability'>
<tr>
<th>Date</th>
<th>From</th>
<th>Until</th>
<th>Available?</th>
</tr>";

// Fetch results
$result = mysqli_query($con,$sql);
$num_rows = mysqli_num_rows($result);
$resultCount = 0;
$nextTimeSlot = 0;
	
if ($num_rows == 0) {

	// No bookings exist for this facility for this date
	// Display a list of vacancies.
	for ($index = 0; $index < sizeof($intervals) - 1; $index++) {

		echo "<tr>";
		echo "<td>" . $strDate . "</td>";
		echo "<td>" . $intervals[$index] . "</td>";
		
		echo "<td>" . $intervals[$index + 1] . "</td>";	
		
		echo "<td style='background-color: #CCFFCC;'>vacancy</td>";
		echo "</tr>";
	}
	
} else {
	// Loop through each booking, display vacancy between bookings
	$index = 0;
	
	while($row = mysqli_fetch_array($result)) {
	
		//output the vacancy up to midnight of the next day			
		while ($index < (sizeOf($intervals) - 1)) {
		
			//vacancy is well clear of the existing booking
			if (($intervals[$index] < $row['start_time']) && ($intervals[$index+1] <= $row['start_time'])) {
				echo "<tr>";
				echo "<td>" . $strDate . "</td>";
				echo "<td>" . $intervals[$index] . "</td>";
				echo "<td>" . $intervals[$index+1] . "</td>";
				echo "<td style='background-color: #CCFFCC;'>vacancy</td></tr>";
			
			// the booking starts in the middle/part of the hour
			} elseif (($intervals[$index] < $row['start_time']) && ($intervals[$index+1] > $row['start_time'])) {
				echo "<tr>";
				echo "<td>" . $strDate . "</td>";
				echo "<td>" . $intervals[$index] . "</td>";
				echo "<td>" . $row['start_time'] . "</td>";
				echo "<td style='background-color: #CCFFCC;'>vacancy</td></tr>";
				$index++;
				break; // exit the while ($index ...) loop
			} else {
				$index++;
				break;
			}			
			
			$index++;
		}

		// output the booking
		echo "<tr>";
		echo "<td>" . $strDate . "</td>";
		echo "<td>" . $row['start_time'] . "</td>";
		echo "<td>" . $row['finish_time'] . "</td>";
		echo "<td style='background-color: #FFCCCC;'>already booked</td></tr>";
		
		$nextTimeSlot = $row['finish_time']; 
		
		while ($index < (sizeOf($intervals) - 1)) {
			// go to the next time slot in the array for time comparison
			if (($nextTimeSlot > $intervals[$index]) && ($nextTimeSlot >= $intervals[$index+1])){
				$index++;
			} elseif ($nextTimeSlot < $intervals[$index]) {
				$index--;
			} else {
				break;
			}
		}
		
		$intervals[$index] = $nextTimeSlot;
		
		// for the last booking output the remaining vacancy time slots
		if ($resultCount == ($num_rows-1)) {
			//this is the last booking
			$firstVacancy = true;
			while ($index < (sizeOf($intervals) - 1)) {

				echo "<tr>";
				echo "<td>" . $strDate . "</td>";
				if ($firstVacancy === true) {
					echo "<td>" . $nextTimeSlot . "</td>";
					$firstVacancy = false;
				} else {
					echo "<td>" . $intervals[$index] . "</td>";
				}
				
				echo "<td>" . $intervals[$index+1] . "</td>";	
				echo "<td style='background-color: #CCFFCC;'>vacancy</td></tr>";					
				
				$index++;

			} //end while loop through intervals
		}
		
		$resultCount += 1;
	} //end while loop through all bookings
} //end if-else

echo "</table>";

include ("pagecomponents/closeConnection.php");
?>