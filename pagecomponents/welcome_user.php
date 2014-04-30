<?php
require_once('connectDB.php');

	$_SESSION["userId"] = 100056;
	if (isset($_SESSION["userID"])) {
		$sql="SELECT first_name FROM staff_details WHERE staff_id = " . $_SESSION['userID'].";";
		$result=mysqli_query($con,$sql);
		$row = $result->fetch_row();
		
		if ($row) { 
			echo '<script>document.getElementById("welcome_user_text").innerHTML="Welcome, ' . $row["first_name"] .'"</script>';
		} 
	} else { 
			echo '<script>document.getElementById("welcome_user_text").innerHTML="Welcome"</script>';
		}
		
require_once('pagecomponents/closeConnection.php');
?>