<?php
session_start();
if (isset($_SESSION['userID']))
	{
		$userId = $_SESSION['userID'];
	}
$current_page = basename($_SERVER['PHP_SELF']);
require("include/check_access.inc");
if (check_access($userId, $current_page) == false)
{
	header("Location: http://trustinblack.com/harmonyhospital/submit/invalidPermission.php");
}
?>