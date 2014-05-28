<?php
	function check_access($userId)
	{
		$current_page = echo basename($_SERVER['PHP_SELF']);
		require_once('../pagecomponents/connectDB.php');
		$sql = 'SELECT access_levels FROM roles WHERE role_id = (SELECT role_id FROM staff_details WHERE staff_id = ' . $userId .  ')';
		$result = mysqli_query($con, $sql);
		$access_levels = mysqli_fetch_array($result);
			if (in_array($current_page, $access_levels)
			{
				return true;
			}
			else
			{
				return false;
			}
		require_once('../pagecomponents/closeConnection.php');
		}
	}

?>
