<?php session_start();
if(!isset($_SESSION['userID'])){
header('Location: http://trustinblack.com/harmonyhospital/login.php');
}
if (isset($permissions)){
    if (isset($_SESSION["roleID"])){
        if(!in_array($_SESSION["roleID"],$permissions)){
            header('Location: http://trustinblack.com/harmonyhospital/index.php');
        }
    } 
}
?>
<!DOCTYPE html>
<html>
    <head>  <title><?php echo $pagetitle; ?></title>
            <link rel="shortcut icon" href="../harmonyhospital/bandaid_bird_48x48.ico" type="image/x-icon" />
            <link href="../harmonyhospital/globalstyle.css" rel="stylesheet" type="text/css" />
	    <link rel="../harmonyhospital/stylesheet" href="signaturePad/assets/jquery.signaturepad.css">
            <script src="http://code.jquery.com/jquery-2.1.0.min.js" type="text/javascript"></script>
            <script src="../harmonyhospital/js/jquery.validate.min.js" type="text/javascript"></script>
            <script src="../harmonyhospital/js/additional-methods.min.js" type="text/javascript"></script>
	    <script src="../harmonyhospital/signaturePad/assets/flashcanvas.js" type="text/javascript"></script>
            <script src="../harmonyhospital/signaturePad/jquery.signaturepad.min.js" type="text/javascript"></script>
            <script src="../harmonyhospital/signaturePad/assets/json2.min.js" type="text/javascript"></script>
        <script src="/harmonyhospital/lib/buttons.js"></script>
    </head>
<body>
    <?php include("buttons.php");?>
<!--    <img src="../harmonyhospital/bird.jpg" height="142" width="242" />-->
