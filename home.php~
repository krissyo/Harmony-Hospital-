<?php

include ("pagecomponents/connectDB.php");
/*
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
*/

session_start();
if(isset($_SESSION['role'])) {

$RoleId = $_SESSION['role'];

}

$result = mysqli_query($con, "SELECT RoleId, RoleDescription FROM Roles WHERE RoleId = '$RoleId'");

$record = mysqli_fetch_array($result);

if($record['RoleDescription'] == " SYSTEM ADMINISTRATOR") {
    header('Location: admin.php');
    die();
    
}
    
elseif($record['RoleDescription'] == " HEAD DOCTOR") {
    header('Location: Hdoc.php');
    die();
    
}
elseif($record['RoleDescription'] == " DOCTOR") {
    header('Location: Doc.php');
    die();
    
}
elseif($record['RoleDescription'] == " HEAD NURSE") {
    header('Location: Hnurse.php');
    die();
    
}
elseif($record['RoleDescription'] == " NURSE") {
    header('Location: Nurse.php');
    die();
    
}
elseif($record['RoleDescription'] == " HOSPITAL MANAGER") {
    header('Location: Hmanager.php');
    die();
}
    
?>

<html>
	<head>
		<title>Harmony Children Hospital | Welcome </title>
	</head>

	<body>

	</body>
</html>
