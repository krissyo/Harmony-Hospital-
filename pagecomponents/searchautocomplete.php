<?php
$mysqli = new mysqli('localhost', 'trustinb_harmony', 'inb201', 'trustinb_harmonyhospital');
$text = $mysqli->real_escape_string($_GET['term']);
 
$query = "SELECT first_name FROM staff_details WHERE first_name LIKE '%$text%' ORDER BY first_name ASC";
$result = $mysqli->query($query);
$json = '[';
$first = true;
while($row = $result->fetch_assoc())
{
    if (!$first) { $json .=  ','; } else { $first = false; }
    $json .= '{"value":"'.$row['name'].'"}';
}
$json .= ']';
echo $json; 
?>