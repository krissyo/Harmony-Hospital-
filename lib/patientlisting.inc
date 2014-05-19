<?php
	

		// connect to the database
		require "pagecomponents/connectDB.php";

		$sql='SELECT patient_id, first_name, last_name from patient_details ORDER BY patient_id';
		
		$result=mysqli_query($con,$sql);
		
		while($row = mysqli_fetch_array($result))
		{
			echo "<option value='".$row['patient_id']."''>".$row['first_name'].' '.$row['last_name']."</option>";
    	}

		require_once('pagecomponents/closeConnection.php');

	
	?>