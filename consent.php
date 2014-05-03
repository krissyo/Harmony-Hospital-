<?php
$pagetitle="Consent Form";
include("../harmonyhospital/pagecomponents/head.php");
?>

		<div id="wrapper">
		<div id="header">
			<h1>Consent Form</h1>
           <h3>Read and Sign for Consent</h3> <br /> 
            <div id="consent"> Bacon ipsum dolor sit amet pork loin beef ribs hamburger, kielbasa prosciutto shankle corned beef salami sausage biltong. Ham hock tail filet mignon shankle, ball tip capicola tongue leberkas short ribs porchetta meatloaf short loin chuck jowl. Brisket ribeye pork chop beef ribs ham hock shank chuck pig. Ribeye jerky t-bone leberkas turducken landjaeger ball tip tongue fatback shoulder pastrami tenderloin biltong tri-tip. T-bone shoulder sirloin tongue shank. <br /> <br />

Doner tri-tip jowl, meatloaf tenderloin capicola venison fatback. Boudin tenderloin flank, strip steak sirloin kielbasa tongue landjaeger ham hock porchetta hamburger ground round ribeye. Meatloaf spare ribs capicola, beef ribs sausage pastrami porchetta shankle bacon fatback pork chop filet mignon tongue beef turducken. Capicola boudin short loin biltong, chuck pig beef ribs andouille meatloaf corned beef. <br /> <br />

Tenderloin kielbasa pig fatback. Shank spare ribs cow bacon andouille short ribs. Capicola ham short ribs meatloaf. Strip steak turkey shoulder short loin, t-bone sirloin ground round tongue doner frankfurter short ribs beef kevin. Filet mignon salami rump capicola shankle short ribs fatback ham corned beef. <br /> <br />

Capicola pig ribeye, flank doner corned beef ground round tongue kielbasa rump andouille pork strip steak. Fatback salami venison pork doner. Corned beef porchetta drumstick, strip steak turkey ball tip sausage pastrami beef ribs andouille kielbasa shoulder. Salami kielbasa tenderloin, short ribs andouille porchetta pancetta strip steak rump pork belly.</p>  
		</div>
		<div id="content">
        
                 <form id="consent" class="sigPad" action="submit/consentsubmit.php" method="post">
                <input type="hidden" >
             
			<table>
               
                <tr><td>First Name:</td> <td><input class="rounded" type="text" name="FirstName" id="FirstName" required></td></tr>
            <tr><td>Last Name:</td> <td> <input class="rounded" type="text" name="LastName" id="LastName" required></td></tr>
            <tr><td>Signature of Parent/Legal Guardian:</td> <td><div class="sig sigWrapper">
		<canvas class="pad" width="198" height="60" name=signiture></canvas>
		<script> $(document).ready(function () {
  $('.sigPad').signaturePad({drawOnly:true});
}); </script>
    <input type="hidden" name="output" class="output" required></div></td></tr>
                <tr><td>Date:</td> <td> <input class="rounded" type="date" name="Date" id="Date" required></td></tr>
            <tr>
                    <td></td>
                    <td><input class="rounded" type="submit" name="sumbit" id="submit" value="Submit"></td>
                </tr>
                </table>
			</form>
		</div>
		<div id="sidebar">
		</div>
			<?php
include("pagecomponents/footer.php");
?>
		</div>
    </body>
</html>
