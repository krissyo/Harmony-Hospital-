<?php session_start();

require_once('../pagecomponents/validate.php');
// This is the only place in out APP where
// the connection to the database is established via the include file
require_once('../pagecomponents/connectDB.php');
	
$validate = new Validate();
$validated_POST = $validate->post();
$username = $validated_POST["username"];
$password = $validated_POST["password"];

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con, "SELECT first_name, staff_id, username, password, salt, role_id FROM staff_details WHERE username = '$username'");

$record = mysqli_fetch_array($result);

//$salt = "cevwac8sy3298ervfn8y4fa8yeiuwxrnw8c7tywqouhfalsiufxp79wyapcr7tewqob";
$salt = $record['salt'];
echo $salt . "<br/>";
//$salt = base64_encode($salt);
$hash = crypt($password, '$5$'.$salt.'$');
//$hash = crypt($password,$salt); 
echo $hash . "<br/>";
echo $record['password'] . "<br/>";


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


?>

<html>
	<head>
		<title>Harmony | Welcome</title>
        <link rel="shortcut icon" href="bandaid_bird_48x48.ico" type="image/x-icon" />
	</head>


</html>
