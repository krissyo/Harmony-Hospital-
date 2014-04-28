<?php
        session_start();
	session_unset();
	session_destroy();
	$dbConnections = array("$con", "$connection");
	foreach ($dbConnections as $dbConnection) {
		mysql_close($dbConnection);
	}
	header("location: login.html");
?>
