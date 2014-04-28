<?php
class ResourceAvailability {
    public function post(){
        $doubleBooking = 0;
        // Query DB to return a record for this ResourceID, this BookingDate
		// WHERE (POST.StartTime > StartTime AND POST.StartTime < FinishTime) OR
		// (POST.StartTime < StartTime AND POST.FinishTime > StartTime AND POST.FinishTime <= FinishTime)
        // if ($result returns a record
		//$doubleBooking = 1 else $doubleBooking = 0
		
		$con=mysqli_connect("mysql.Firelabs.com.au","inb201harmony","6wxPSiPp","inb201harmony");
        $sql="SELECT booking_id, resource_id FROM bookings 
			WHERE resource_id = " . $_POST['ResourceId'] . " AND booking_date = '" . $_POST['StartDate'] . 
			"' AND (('" . $_POST['StartTime'] . "' > start_time AND '". $_POST['StartTime'] . "' < finish_time) OR 
				('" . $_POST['StartTime'] . "' < start_time AND '". $_POST['FinishTime'] . "' > start_time AND '" . $_POST['FinishTime'] . "' <= finish_time)
				OR (start_time = '" . $_POST['StartTime'] . "') 
				OR (finish_time = '" . $_POST['FinishTime'] . "'));";
		
		
		$result=mysqli_query($con, $sql);
		
		$num_rows = mysqli_num_rows($result);
		
		if ($num_rows == 0) {
				$doubleBooking = 0;
		} else {
			$doubleBooking = 1;
		}
		
		mysqli_close($con);
		
        return $doubleBooking;        
    }
}
?>