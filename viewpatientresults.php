<?php
$pagetitle="View Results";
include("pagecomponents/head.php");
$patientid = $_GET["id"];
$_SESSION['passingID'] = $patientid; // patient id 

?>

<body>
        
		<div id="wrapper">
		<div id="header">
			<h1>Test Results</h1>
            <div id="content">
			<form id="testresults" action="" method="post" enctype="multipart/form-data">
                
                <input type="hidden" >
			<table><h3><th colspan="2" class="userdetails">
                
                <?php
                    $sql=" SELECT first_name, last_name FROM patient_details WHERE patient_id=" . $patientid .'';  // Name of Patient
                    $result = mysqli_query ($con, $sql) ;
                    while($row = mysqli_fetch_array($result)){
                    echo $row['first_name'] . ' ' . $row['last_name'];
                    }              
                ?>
                </th></h3>
                
                <tr><td>Image:</td> <td> 
                 <?php
                            require_once('pagecomponents/connectDB.php');
							$sql="SELECT medical_image FROM clinical_history_detail WHERE patient_id=" . $patientid .''; // Patient Image
                            $result=mysqli_query($con,$sql);
                            while($row = mysqli_fetch_array($result)){
                                if (empty($row['medical_image'])){
                                    echo 'No image uploaded';
                                }else{
                            echo "<img src=/harmonyhospital/testresultsimg/" . $row['medical_image'] . " style = height:100%; width:100%>";
                            
                	}
                            }
						  ?>
                    <tr><td>Notes:</td> <td> 
                 <?php
							$sql="SELECT test_notes FROM clinical_history_detail WHERE patient_id=" . $patientid .'';
                            $result=mysqli_query($con,$sql);
                            while($row = mysqli_fetch_array($result)){
                            echo $row['test_notes'];
                	}								
						  ?>

                
                </td></tr>   
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