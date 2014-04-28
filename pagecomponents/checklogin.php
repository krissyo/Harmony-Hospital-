<?php 
        if(isset($_SESSION["userID"])){
        echo "you're logged in as " . $_SESSION["Name"];
        }else{
        echo "<a href='login.php'>You are not logged in. Please Login here to continue </a>";
        }
?>
