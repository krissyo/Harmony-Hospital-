<?php session_start();
if(!isset($_SESSION['userID'])){
    header('Location: http://trustinblack.com/harmonyhospital/login.php');
} 
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- meta -->
        <meta name="viewport" content="width=device-width, user-scalable=no"/>
        <!--<link href="<?php $_SERVER["DOCUMENT_ROOT"] ?>/Harmony_main.css" rel="stylesheet" type="text/css" />-->
        <link href="<?php $_SERVER["DOCUMENT_ROOT"] ?>/harmonyhospital/globalstyle.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="<?php $_SERVER["DOCUMENT_ROOT"] ?>/harmonyhospital/bandaid_bird_48x48.ico" type="image/x-icon" />
        
        <!-- Javascript -->        
        <script src="<?php $_SERVER["DOCUMENT_ROOT"] ?>/harmonyhospital/lib/jquery-1.11.0.min.js"></script>
        <!--<script src="<?php $_SERVER["DOCUMENT_ROOT"] ?>/lib/mainpage.js"></script>-->
<!--        <script src="<?php $_SERVER["DOCUMENT_ROOT"] ?>/harmonyhospital/lib/buttons.js"></script>-->
              
    </head> 
    
    <body>
       <?php include("buttons.php"); 
        ?>
