<?php
include("pagecomponents/permissioncheckscript.php");
$pagetitle="Update Procedure Details";
include("pagecomponents/head.php");
?>

		<div id="wrapper">
		<div id="header">
			<h1>Update Procedure Cost</h1>
            
		</div>
		<div id="content">
			<form id="updateProcedure" action="submit/updateProcedureSubmit.php" method="post">
                <input type="hidden" >
			<table>         
            <tr><td>Select Procedure:</td> <td> <select class="rounded" type="date" name="procedure" id="procedure" required>
            <option value="">-- Please Select the procedure to update --</option>
            <?php
            	include_once 'pagecomponents/connectDB.php';
              $sql="SELECT procedure_id, procedure_description FROM procedure_listing";
              $result=mysqli_query($con,$sql);
              foreach($result as $procedure)
              {
                echo '<option value="'.$procedure['procedure_id'].'">'.$procedure['procedure_description'].'</option>';
              }
            ?>
            ?>
            </td></tr>
            <tr><td>Revised Procedure Fee:</td> <td> <input class="rounded" type="number" name="newFee" id="newFee" required></td></tr>
            <tr><td>Revised Medicare Rebate:</td> <td> <input class="rounded" type="number" name="newRebate" id="newRebate" required></td></tr>
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

<script> 
        jQuery.validator.setDefaults({
          debug: false,
          success: "valid"
        });
        $( "#updateProcedure" ).validate({
          rules: {
            procedure: {
              required:true
            },
              newFee: {
                  required:true,
                  digits:true
              },
              newRebate: {
                  required:true,
                  digits:true
            }
          },
            messages:{
                newFee: "Numbers only",
                newRebate: "Numbers only",
            }
        })
        </script>
    </body>
</html>

