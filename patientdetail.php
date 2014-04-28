<?php
$pagetitle="Patient Detail Form";
include("pagecomponents/head.php");
?>

    <div id="wrapper">
        <div id="header">
            <h1>PATIENT DETAIL FORM</h1>
        </div>
        <div id="content">
            <div name=" buttonWrapper" id="centre">
            <button  id="admHistoryBtn" class="linkingButtons">Admissions History</button>
            <button  id="curHistoryBtn" class="linkingButtons">Current History</button>
            <button  id="admHistoryBtn" class="linkingButtons">Current History</button>
                </div>
            <br /><br />
            <form id="patientDetailForm" method="post" action="submit/patientdetailsubmit.php">
            <input type="hidden">
            <table>
                <?php 
                //use this code where ever session storage is needed 
                    include("pagecomponents/checklogin.php");
                ?>
                <tr>
                    <td> First name: </td>
                    <td><input name="first-name" id="first-name"  type="text" required></td>
                    </tr>
                <tr>
                    <td> Middle name: </td>
                    <td><input name="middle-name" id="middle-name"  type="text" required></td>
                    </tr>
                <tr>
                    <td> Last name: </td>
                    <td><input name="last-name" id="last-name" type="text" required></td>
                    </tr>
                <tr>
                    <td>Date of birth:</td>
                    <td><input name="DOB" id="DOB" style="width:120px" type="date" required></td>
                </tr>
                  <tr>
                    <td>Date of death:</td>
                    <td><input name="DOD" id="DOD" style="width:120px" type="date" required></td>
                </tr>
                <tr>
                    <td> Gender: </td>
                    <td><select name="gender" id="gender" style="width:130px" >
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        </select>
                    </td>
                    </tr>
                 <tr>
                    <td> Allergies: </td>
                    <td><input name="allergies" id="allergies"  type="text" required></td>
                    </tr>
                <tr>
                    <td> Conditions: </td>
                    <td><input name="conditions" id="conditions"  type="text" required></td>
                    </tr>
                <tr>
                    <td> Medicare Number: </td>
                    <td><input name="medicare-number" id="medicare-number" required type="text"></td>
                    </tr>
                <tr>
                    <td> Medicare Exp Date:</td>
                    <td><input  type="date" name="medicare-exp" id="medicare-exp" required></td>
                    </tr>
                <tr>
                    <td></td>
                    <td><input class="rounded" type="submit" name="sumbit" id="submit" value="Update"></td>
                </tr>
            </table>
			</form>
        
        </div>
    	<?php
include("pagecomponents/footer.php");
?>
    </div>
    
    </body></html>