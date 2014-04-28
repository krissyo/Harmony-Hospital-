<?php
$pagetitle="Admission";
include("pagecomponents/head.php");
?>
		<div id="wrapper">
		<div id="header">
			<h1>Admission Form</h1>
            
		</div>
		<div id="content">
			<form id="doctorsnotes">
                <input type="hidden" action="submit/admissionsubmit.php" method="post" >
			<table><h3><th colspan="2" class="userdetails">Details</th></h3>
                <?php 
                //use this code where ever session storage is needed 
                    include("pagecomponents/checklogin.php");
                ?>
                <tr><td>Last Name:</td> <td> <input class="rounded" type="text" name="LastName" id="LastName" required></td></tr>
                <tr><td>Date of Birth:</td> <td> <input class="rounded" type="date" name="DOB" id="DOB" required></td></tr>
                <tr><td>Date of admission:</td> <td> <input class="rounded" type="date" name="DateAdmission" id="DateAdmission" required></td></tr>
                <tr><td>Initial Treatment Received:</td> <td> <textarea rows="4" cols="50" name="FirstTreat" placeholder="Start typing here..." required></textarea></td></tr>
                <tr><td>Procedures:</td> <td><input type="radio" name="procedures" value="yes" checked>Yes<br>
			<input type="radio" name="procedures" value="no">No</td></tr>
                <tr><td>If Yes:</td> <td> 
                    <select name="procedures">
                      <option value="surgery">Surgery</option>
                      <option value="xray">X-Ray</option>
                      <option value="ctscan">CT Scan</option>
                      <option value="mri">MRI</option>
                    </select></td></tr>
                <tr><td>If Yes, When:</td> <td> <input class="rounded" type="date" name="procedureDate" id="procedureDate"></td></tr>
                <tr><td>Department</td> <td> <select name="department">
                      <option value="cardiology">Cardiology</option>
                      <option value="ear_nose_throat">Ear, Nose and Throat</option>
                      <option value="General Surgery">General Surgery</option>
                      <option value="Neurology">Neurology</option>
                     <option value="Oncology">Oncology</option>
                     <option value="Orthopaedics">Orthopaedics</option>
                    <option value="Radiotherapy">Radiotherapy</option>
                    <option value="Urology">Urology</option>
                    </select></td></tr>
                    <tr><td>Ward:</td> <td> <select name="ward">
                      <option value="ward1">Ward 1</option>
                      <option value="ward2">Ward 2</option>
                      <option value="ward3">Ward 3</option>
                      <option value="ward4">Ward 4</option>
                    </select></td></tr>
                    <tr><td>Bed</td> <td> <select name="bed">
                      <option value="bed1">Bed1</option>
                      <option value="bed2">Bed2</option>
                    </select></td></tr>
                    
                <tr><td>Doctors Notes:</td> <td> <textarea rows="4" name="docNotes" cols="50" placeholder="Start typing here..." required></textarea></td></tr>   
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