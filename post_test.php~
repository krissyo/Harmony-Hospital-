<?php
    include ("pagecomponents/connectDB.php");
	
    if(!$con )
    {
      die('Could not connect: ' . mysql_error());
    }
    function validate_post_data(){
        $result = array();
        foreach($_POST as $key=>$value){
            $new_value = str_replace("'",'',$value);
            $result[$key] = $new_value;
        } 
        return $result;
    }
    print_r(validate_post_data());
    echo "<br/>------------------------------<br/>";  
    foreach(validate_post_data() as $item){
        echo $item . "<br/>";   
    }
    $post_data = validate_post_data();
    $firstname = $post_data['FirstName'];
    echo "<br/>------------------------------<br/>";     
    echo $firstname;
    echo "<br/>------------------------------<br/>";
    $sql = "select first_name, last_name from staff_details where first_name LIKE '$firstname'";
    $result=mysqli_query($con,$sql)
        or die("Error: ".mysqli_error($con));   
    while($row = mysqli_fetch_array($result)){
        print_r($row);
        echo "<br/>";
    }	
?>