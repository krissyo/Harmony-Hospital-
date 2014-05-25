<?php
	$pagetitle="Search Results";		
    include ("../pagecomponents/indexinclude.php");
?>
<?php
require_once('../pagecomponents/validate.php');

require_once('../harmonyhospital/pagecomponents/connectDB.php');

$validate = new Validate();
$validated_GET = $validate->get();
$patientid=(int)$validated_GET["patientId"];
$surname=$validated_GET["surname"];
if((strlen($surname)==0 && strlen($patientid)==0)){
    echo 'No value specified.';
    die();
}else{
    if (strlen($surname)>0) {
        $sql="SELECT * FROM patient_details WHERE last_name LIKE '%$surname%'";
    }elseif (strlen($patientid)>0) {
        $sql="SELECT * FROM patient_details WHERE patient_id = '$patientid'";
    }
    $result=mysqli_query($con,$sql)
        or die("Error: ".mysqli_error($con)); 
    $total = mysqli_num_rows($result);
    if($total > 0){
        while($row = mysqli_fetch_array($result)){
            echo '<div class="searchResults"><a href="'. '../profile.php?patientid=' . $row['patient_id'] . '">' . $row['first_name'] . ' ' . $row['last_name'].'</a></div>';
        }
    }else{
        echo '<div class="noResults">No results found.</div>';   
    }
}

require_once('../harmonyhospital/pagecomponents/closeConnection.php');

?>
<script>
var stringToColour = function(str) {

    // str to hash
    for (var i = 0, hash = 0; i < str.length; hash = str.charCodeAt(i++) + ((hash << 5) - hash));

    // int/hash to hex
    for (var i = 0, colour = "#"; i < 3; colour += ("00" + ((hash >> i++ * 8) & 0xFF).toString(16)).slice(-2));

    return colour;
}
function invertColor(hexTripletColor) {
    var color = hexTripletColor;
    color = color.substring(1);           // remove #
    color = parseInt(color, 16);          // convert to integer
    color = 0xFFFFFF ^ color;             // invert three bytes
    color = color.toString(16);           // convert to hex
    color = ("000000" + color).slice(-6); // pad with leading zeros
    color = "#" + color;                  // prepend #
    return color;
}
$(document).ready(function(){
    $(".searchResults").each(function(){
        var col = stringToColour($(this).text())
        var text = invertColor(col);
        $(this).css('background-color',col);
        $(this).css('border-color',text);
        $(this).children().css('color',text);   
    })
})
</script>
