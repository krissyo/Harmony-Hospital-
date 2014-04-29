<?php
// Include file to handle
// DB connection from one place in our application
//mysqli_connect(host,username,password,dbname);
//$con=mysqli_connect("mysql.Firelabs.com.au","inb201harmony","6wxPSiPp","inb201harmony");
//$con = mysqli_connect("http://trustinblack.com/phpmyadmin/","trustinb_harmony", "inb201", "trustinb_harmonyhospital");
$con = mysqli_connect('localhost', 'trustinb_harmony', 'inb201', 'trustinb_harmonyhospital');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

?>