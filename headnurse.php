<?php
// Author James Clelland 08888141
session_start();
if (isset($_SESSION['userID']))
	{
		$userId = $_SESSION['userID'];
	}
$current_page = basename($_SERVER['PHP_SELF']);
require 'include/check_access.inc';
if (check_access($userId, $current_page) == false)
{
	die("Sorry, You don't have access to this page!");
}
$pagetitle="View Patients";
include("pagecomponents/head.php");
$patientid = $_SESSION["patient_id"];
?>
 <body>
      
		<div id="wrapper">
		<div id="header"> 
			<h1>View Patients</h1>
            
		</div>
		<div id="content">
            
         <form id="viewpatient" action="" method="">
                <input type="hidden" >
			<table><h3><th colspan="2" class="userdetails"> <?php echo $_SESSION["Name"] ?></th></h3>
                
                 <?php
$sql = "SELECT  A.first_name AS fname,
                A.last_name As lname,
                A.patient_id,
                B.staff_id,
                C.first_name,
                C.last_name
                FROM patient_details A
                JOIN admissions B ON B.patient_id = A.patient_id
           		JOIN staff_details C ON C.staff_id=B.staff_id
                WHERE C.role_id ='3'; ";


$result=mysqli_query($con,$sql);
        while($row = mysqli_fetch_array($result)){
                echo '<table class="patientTable">';
                echo '<tr>';
                    echo '<td>' . $row['fname'] . ' ' . $row['lname'] . '</td>' ;
                    echo '<td>' . $row['first_name'] . ' ' . $row['last_name'] . '</td>' ;
                    echo "<td> <a href='nursenotes.php?id=" . $row['patient_id'] . "'>Nurses Notes</a> </td>";
                   
                echo '</tr>';
                    }
?>
                
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
