<?php
	// @author: Jesse Cunningham-Creech 05420687
        session_start();
		session_unset();
		session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
<link type="text/css" rel="stylesheet" href="http://trustinblack.com/harmonyhospital/globalstyle.css" > 
<title> LOGGED OUT</title>
</head>
<body>
<div class="gradient"></div>
<div class="wrapper">
<a href="http://trustinblack.com/harmonyhospital/login.php"><img class="centre" src="http://trustinblack.com/harmonyhospital/images/harmony_logout_logo.png" width="600" height="275"></a>
<div class="centre"><h3> YOU HAVE SUCCESSFULLY LOGGED OUT OF <br> THE HARMONY CHILDRENS HOSPITAL MANAGEMENT SYSTEM</h3></div>
</div>
</body>
</html>
