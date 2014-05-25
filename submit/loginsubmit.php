<?php session_start();
// @author: Krissy O'Farrell, 08854114
// Last modified on: 25/05/2014
require_once('../pagecomponents/validate.php');
// This is the only place in out APP where
// the connection to the database is established via the include file
require_once('../pagecomponents/connectDB.php');
	
$validate = new Validate();
$validated_POST = $validate->post();
$username = $validated_POST["username"];
$password = $validated_POST["password"];

$result = mysqli_query($con, "SELECT first_name, staff_id, username, password, salt, role_id FROM staff_details WHERE username = '$username'");

$record = mysqli_fetch_array($result);

//$salt = "cevwac8sy3298ervfn8y4fa8yeiuwxrnw8c7tywqouhfalsiufxp79wyapcr7tewqob";
$salt = $record['salt'];
//$salt = base64_encode($salt);
$hash = crypt($password, '$5$'.$salt.'$');
//$hash = crypt($password,$salt); 



if ($record['username'] == $username && $record['password'] == $hash) {
	//echo "Welcome! You are now logged in!"; 

    $_SESSION["userID"] = $record["staff_id"];
    $_SESSION["roleID"] = $record["role_id"];
    //use on anypage and users name will appear provided they are logged in
    $_SESSION["Name"] = $record["first_name"];

    header('Location: ../index.php');
    die();
}

else {

	echo "Username or password is incorrect!";
}

require_once('../pagecomponents/closeConnection.php');
?>

<html>
	<head>
		<title>Harmony | Welcome</title>
        <link rel="shortcut icon" href="bandaid_bird_48x48.ico" type="image/x-icon" />
	</head>


</html>
