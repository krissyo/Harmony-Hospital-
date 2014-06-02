<?php
include("pagecomponents/permissioncheckscript.php");
$pagetitle="reports";
include("pagecomponents/head.php");
?>

		<div id="wrapper">
		<div id="header">
		          
		</div>
		<div id="content">
      <h1 class="centre">PATIENT INVOICING</h1>
      <br>
       
                <?php 
                //use this code where ever session storage is needed 
                    //include("pagecomponents/checklogin.php");
                ?>
            <fieldset>
            <legend>PATIENT INVOICE</legend>
            <form name="patientInvoiceReportForm" id="patientInvoiceReportForm" action="submit/PatientInvoiceSubmit.php" method="POST">
                  <div>
                  <select name="selectPatient" id="selectPatient">
                  <option value=""> -- select the patient -- </option>
                  <?php
                      include "lib/patientlisting.inc";                      
                      ?>
                    </select>
                    </div>
                    <input class="centre" type="submit" name="sumbit" id="submit" value="Submit">
            </form>
            </fieldset>
            <br>
              <h1 class="centre">PATIENT REPORTS</h1>
              <br>
                <?php 
                //use this code where ever session storage is needed 
                    //include("pagecomponents/checklogin.php");
                ?>
            <fieldset>
            <legend>PATIENT TRANSFER REPORT</legend>
            <form name="patientSubmitReportForm" id="patientSubmitReportForm" action="submit/patientDetailReportSubmit.php" method="POST">
                  <div>
                  <select name="patient_id" id="selectPatient">
                  <option value=""> -- select the patient -- </option>
                  <?php
                      include "lib/patientlisting.inc";                      
                      ?>
                    </select>
                    </div>
                    <input class="centre" type="submit" name="sumbit" id="submit" value="Submit">
            </form>
            </fieldset>
            <br>
            <h1 class="centre">DEPARTMENT REPORTS</h1>
            <br>
            <fieldset>
            <legend>GENERAL SURGERY DEPARTMENT REPORT</legend>
            <br>
            <form name="GSReportForm" id="GSReportForm" action="submit/GeneralSurgeryReportSubmit.php" method="POST">
                    <?php
                      include "lib/datepicker.inc";
                      date_field('report', 'Reporting Month: ');                      
                      ?>
                    <input class="centre" type="submit" name="sumbit" id="submit" value="Submit">
            </form>
            </fieldset>
             <br>
            <fieldset>
            <legend>DEPARTMENT USAGE STATISTICS REPORT</legend>
            <br>
            <br>
            <form name="DPUsageReportForm" id="DPUsageReportForm" action="submit/DepartmentUsageReportSubmit.php" method="POST">
                    <?php
                      date_field('report', 'Reporting Month: ');                      
                      ?>
                    <input class="centre" type="submit" name="sumbit" id="submit" value="Submit">
            </form>
            </fieldset>
            
		</div>
		<div id="sidebar">
		</div>
		<div id="footer">
		</div>
            	<?php
include("pagecomponents/footer.php");
?>
		</div>
        <script> 
        jQuery.validator.setDefaults({
          debug: false,
          success: "valid"
        });
        $( "#annualleave" ).validate({
          rules: {
            AnnualLeaveStart: {
              required: true,
              date: true
            },
            AnnualLeaveEnd: {
              required: true,
              date: true
              
            }
          }
        })
        function calculatedate(date1,date2){
            $(this).value.date2-date1;   
        }
            
        </script>
    </body>
</html>