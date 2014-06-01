<?php
	function check_access($userId)
	{
		$current_page = '/harmonyhospital/'. basename($_SERVER['PHP_SELF']);
		require('pagecomponents/connectDB.php');
		//$sql = 'SELECT access_levels FROM roles WHERE role_id = (SELECT role_id FROM staff_details WHERE staff_id = ' . $userId .  ')';
		
		$sql = "SELECT url FROM sub_nav
		WHERE (role_id = 0 or role_id = 
		(SELECT role_id from staff_details WHERE staff_id = " . $userId . "))
		AND url = '" . $current_page . "'";
		
		$result = mysqli_query($con, $sql);
		/*
		$access_levels = mysqli_fetch_array($result);
			if (in_array($current_page, $access_levels)
			{
				return true;
			}
			else
			{
				return false;
			}
		*/
		if (mysqli_num_rows($result) > 0) {
			return true;
		} else {
			return false;
		}
		require_once('pagecomponents/closeConnection.php');
		
	}

?>
