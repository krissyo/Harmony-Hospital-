<?php
include("pagecomponents/permissioncheckscript.php");
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
			<table style="width: 600px">
            <colgroup>
             <col span="1" style="width: 50%;">
            <col span="1" style="width: 50%;">
                <h3><th colspan="2" class="userdetails">
                
                <?php
                    $sql=" SELECT first_name, last_name FROM patient_details WHERE patient_id=" . $patientid .'';  // Name of Patient
                    $result = mysqli_query ($con, $sql) ;
                    while($row = mysqli_fetch_array($result)){
                    echo $row['first_name'] . ' ' . $row['last_name'];
                    }              
                ?>
                </th></h3>
                
                 
                 <?php
                            require_once('pagecomponents/connectDB.php');
							$sql="SELECT medical_image, test_notes FROM clinical_history_detail WHERE patient_id=" . $patientid .''; // Patient Image
                            $result=mysqli_query($con,$sql);
                            $count = 1;
                            while($row = mysqli_fetch_array($result)){
                                if ($row['medical_image'] != null)
                                {
                                    echo '<tr colspan="2" ><td><b> test result '.$count.'</b></td>';
                                    echo "<tr><td>";
                                   
                                    echo '<a href="/harmonyhospital/testresultsimg/'.$row['medical_image'].'">';
                                    echo '<img src="/harmonyhospital/testresultsimg/'.$row['medical_image'].'" style ="height:50%; width:50%; max-width:4   00px; margin:0; margin-left:auto; margin-right:auto;">';
                                    echo '</a>';
                                   
                                    echo "</td>";
                                    echo "<td>";
                                    echo $row['test_notes'];
                                    
                                    echo "</td>";
                                    echo "</tr>";
                	           }
                               else{
                                echo '<tr colspan="2" ><td><b> test result '.$count.'</b></td>';
                                echo '<tr><td></td><td>'.$row['test_notes'].'</td>';
                                echo "</tr>";

                               }
                               $count ++;
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