<?php
// Include file to handle
// DB connection from one place in our application
//mysqli_connect(host,username,password,dbname);
//$con=mysqli_connect("mysql.Firelabs.com.au","inb201harmony","6wxPSiPp","inb201harmony");
$con = mysqli_connect("http://trustinblack.com/phpmyadmin/","harmony", "admin2014", "inb201harmony");

if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

?>