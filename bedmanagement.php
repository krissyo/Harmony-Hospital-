<?php
$pagetitle="Bed Management Form";
include("pagecomponents/head.php");
include("lib/bedManagementScript.php");
?>

    <div id="wrapper">
        <div id="header">
            <h1>MANAGE BEDS FORM</h1>
        </div>
        <div id="content">
            <div name=" buttonWrapper" id="centre">
            <button  id="wardMgmtBtn" class="linkingButtons">Ward Management</button>
            <button  id="deptMgmtBtn" class="linkingButtons">Department management</button>
            
                </div>
            <br /><br />
            <form id="manageBedsForm" method="post" action="submit/manageBedssubmit.php">
            <input type="hidden">
            <table>
                <?php 
                //use this code where ever session storage is needed 
                    include("pagecomponents/checklogin.php");
                ?>
                <tr>
                    <td> Select Department </td>
                    <td><select name="selectDpmnt" id="selectDpmnt"  type="text" required>
                        <option value="deptDefault">-- please select a department --</option>
                        <?php
							populate_department_list($deptPrefixArray);
                            ?>
                        </select>
                        </td>
                    </tr>
               <tr>
                    <td> Select Ward </td>
                    <td>
                        <select name="selectWard" id="selectWard" type="text" required>
                        <option value="WARDDefault">-- please select a ward --</option>
                        <!--<?php
                            populate_ward_list($wardPrefixArray);
                            ?> -->
                            <script>

                            $('#selectDpmnt').change(function(){
                            var deptID = this.value;
                            alert("this departments id is "+ deptID);
                            $.post('bedManagementScript.php',{deptID:deptID},function(data){
                                alert("this function is posting");
                                });
                            });
                            </script>                                                     
                        </select>                    
                    </td>
              </tr>
                <tr>
                <td>Select Bed</td>    
                    <td><select name="selectBed" id="selectBed" type="text" required></td>
                    
                
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

    
    </body>


</html>