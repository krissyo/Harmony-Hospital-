<?php
include("pagecomponents/permissioncheckscript.php");
$pagetitle="Test Results";
include("pagecomponents/head.php");
$patientid = $_SESSION["patient_id"]; 

?>

<body>
        
		<div id="wrapper">
		<div id="header">
			<h1>Test Results</h1>
            <div id="content">
			<form id="testresults" action="submit/testresultssubmit.php" method="post" enctype="multipart/form-data">
                
                <input type="hidden" >
			<table><h3><th colspan="2" class="userdetails">
                <?PHP
                    if (!isset($patientid)){
                        echo "Patient ID not set";
                    }else{
                    $sql=" SELECT first_name, last_name FROM patient_details WHERE patient_id=" . $patientid .'';
                    $result = mysqli_query ($con, $sql) ;
                    while($row = mysqli_fetch_array($result)){
                    echo $row['first_name'] . ' ' . $row['last_name'];
                    }
                    }
                ?>  
            </th></h3>
            <tr><td> Procedure ID:</td> <td><select class="rounded" name="ProID" id="ProcedureID">
                <?php
                            require_once('pagecomponents/connectDB.php');
							
							$sql="SELECT procedure_id, procedure_description FROM procedure_listing";
                            $result=mysqli_query($con,$sql);
                            while($row = mysqli_fetch_array($result)){
                            echo "<option value='" . $row["procedure_id"] . "'>" . $row["procedure_description"] . "</option>";
                	}								
						  ?>
                </select></td>
            <tr><td>Notes:</td> <td> <textarea rows="4" cols="50" name="notes" id="notes" placeholder="Please enter results..." required></textarea></td></tr>
            <tr><td>Medical Imaging: </td> <td><input class="rounded" type="file" name="MedicalImaging" id="Upload" value="Upload"></td></tr>
               <td></td>
                    <td><input class="rounded" type="submit" name="sumbit" id="submit"></td>
                </tr>
                </table>
			</form>
		</div>
		<div id="sidebar">
		</div>
		<div id="footer">
		</div>
            
            <?php
			require_once('pagecomponents/closeConnection.php');
include("pagecomponents/footer.php");
?>
		</div>
    <script> 
        jQuery.validator.setDefaults({
          debug: false,
          success: "valid"
        });
        $( "#testresults" ).validate({
          rules: {
            Clinicalid: {
              required: true,
                digits:true 
            },
            Notes: {
                required: true,
            },   
           lastupdated:{
               required: true,
              
            }
          }
        })
        </script>
    
    
    
    
    </body>
</html>            