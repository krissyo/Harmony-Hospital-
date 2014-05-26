<?php
	$pagetitle="Edit Permissions";	
    include ("pagecomponents/indexinclude.php");
?>
<?php
//checking top_nav has been submitted
if(isset($_POST['top_nav'])){
    $name = $_POST['name'];
    $url = $_POST['url'];
    $role = $_POST['role'];
    $html = $_POST['html'];
    $sql1 = "INSERT INTO top_nav(name, url, role_id, html_id) VALUES('$name', '$url', $role, '$html')";
    $result=mysqli_query($con,$sql1)
        or die("Error: ".mysqli_error($con));     
}
//checking sub_nav has been submitted
if(isset($_POST['sub_nav'])){
    $name = $_POST['name'];
    $url = $_POST['url'];
    $role = $_POST['role'];
    $top_nav_id = $_POST['top_nav_id'];
    $sql1 = "INSERT INTO sub_nav (name, url, top_nav_id, role_id) VALUES ('$name', '$url', $top_nav_id, $role)";
    $result=mysqli_query($con,$sql1)
        or die("Error: ".mysqli_error($con));        
}
//checking remove_nav has been submitted
if(isset($_POST['remove_nav'])){
    $id = $_POST['id'];
    $remove_id = $_POST['remove_id'];
    if($remove_id == 'top'){
        $sql1 = "DELETE FROM top_nav WHERE id=$id";
    }
    if($remove_id == 'sub'){
        $sql1 = "DELETE FROM sub_nav WHERE id=$id";
    }
    $result=mysqli_query($con,$sql1)
        or die("Error: ".mysqli_error($con)); 
}
?>
<!-- add top nav items -->
    <div id="wrapper">
    <h1>Add Top Navigation Item</h1>
    <form method="post" action="permissionsedit.php">
        <input type="text" placeholder="Name" name="name"><br/>
        <input type="text" placeholder="URL" name="url"><br/>
        <input type="text" placeholder="Role" name="role"><br/>
        <input type="text" placeholder="HTML ID" name="html"><br/>
        <input type="submit" name="top_nav">
    </form>
    <!-- add sub nav items -->
    <h1>Add Sub Navigation Item</h1>
    <form method="post" action="permissionsedit.php">
        <input type="text" placeholder="Name" name="name"><br/>
        <input type="text" placeholder="URL" name="url"><br/>
        <input type="text" placeholder="Role" name="role"><br/>
        <input type="text" placeholder="Top Navigation ID" name="top_nav_id"><br/>
        <input type="submit" name="sub_nav">
    </form>
    <!-- remove nav items -->
    <h1>Remove Navigation Item</h1>
    <form method="post" action="permissionsedit.php">
        <select name="remove_id">
            <option value="top">Top Navigation</option>
            <option value="sub">Sub Navigation</option>
        </select><br/>
        <input type="text" name="id"><br/>
        <input type="submit" name="remove_nav"><br/>
    </form>    
    <table id="admin-table">
    <?php
    //selects everything from top_nav
        $sql1 = "SELECT * FROM top_nav";
        $result=mysqli_query($con,$sql1)
            or die("Error: ".mysqli_error($con)); 
        //counts number of rows to see if larger than 0
        $total = mysqli_num_rows($result);
        if($total > 0){
            while($row = mysqli_fetch_array($result)){
                $sql2 = "SELECT * FROM sub_nav";
                $result2=mysqli_query($con,$sql2)
                    or die("Error: ".mysqli_error($con)); 
                $total2 = mysqli_num_rows($result2);
                ?>
<!--   prints id, name and role id for top_nav     -->
        <tr>
            <td>
                <?php echo $row['id'];?>
            </td>
            <td colspan="2">
                <?php echo $row['name'];?>
            </td>
            <td>
                <?php echo $row['role_id'];?>
            </td>
        </tr>
                <?php
                if($total2 > 0){
                    while($sub_row = mysqli_fetch_array($result2)){
                        //if the top_nav_id matches the current top nav id, then execute following piece of js
                        if($sub_row["top_nav_id"] == $row["id"]){
                        ?>
<!--   prints id, name and role id to page for sub_nav     -->
        <tr>
            <td colspan="2">
                <?php echo $sub_row['id'];?>
            </td>
            <td>
                <?php echo $sub_row['name'];?>
            </td>
            <td>
                <?php echo $sub_row['role_id'];?>
            </td>
        </tr>
                        <?php
                        }
                    }
                }
            }
        }
    ?>
    </table>
</div>
</div>
     <?php include ("pagecomponents/footer.php"); ?>   
</body>
</html>