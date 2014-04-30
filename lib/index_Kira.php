<!DOCTYPE html>
<html>
    <head>
        <link href="Harmony_main.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="bandaid_bird_48x48.ico" type="image/x-icon" />
		<script>document.getElementById('admin_tab').style.visibility='hidden';
		document.getElementById('patient_tab').style.visibility='hidden';
		document.getElementById('doctors_tab').visibility='hidden';
		document.getElementById('nurses_tab').visibility='hidden';
		document.getElementById('costs_tab').visibility='hidden';
		document.getElementById('surgery_tab').visibility='hidden';
		document.getElementById('facilities_tab').visibility='hidden';
		</script>
    </head>
    
    <body>
    <div id="harmony_logo">
        <a href="Harmony_main.html"><img src="bandaid_bird_90px.png"></a>
        </div>
    <div id="welcome_user_text">
        <p>WELCOME JESSE</p>
        </div>
    <div id="welcome_user_last_login">
            <p>your last login was 140314 @ 14:33</p>
            </div>
    <div id="main_bg_box">
        <p></p>
        </div>
    <div id="main_white_box">
        </div>
    <div id="Menu">    
    <div class="tab_box" id="home_tab">
        <div class="tab_box_text">
        <h1> HOME </h1> 
            </div>
        </div>
    <div class="tab_box" id="admin_tab">
        <div class="tab_box_text">
        <h1> ADMIN </h1>        
        </div>
        </div>
    <div class="tab_box" id="patient_tab">
        <div class="tab_box_text">
        <h1> PATIENT </h1>        
        </div>
        </div>
    <div class="tab_box" id="doctors_tab">
        <div class="tab_box_text">
        <h1> DOCTORS </h1>        
        </div>
        </div>
    <div class="tab_box" id="nurses_tab">
        <div class="tab_box_text">
        <h1> NURSES </h1>        
        </div>
        </div>
    <div class="tab_box" id="costs_tab">
        <div class="tab_box_text">
        <h1> COSTS </h1>        
        </div>
        </div>
    <div class="tab_box" id="surgery_tab">
        <div class="tab_box_text">
        <h1> SURGERY </h1>        
        </div>
        </div>
    <div class="tab_box" id="facilities_tab">
        <div class="tab_box_text">
        <h1> FACILITIES </h1>        
        </div>
        </div>
        </div>
        
	<form id="index">
		<?php
			
			if (isset($_SESSION["roleID"])) {
				$sql="SELECT AccessArea FROM Roles WHERE RoleId = ".$_SESSION["roleID"].";";
			} else {
				$sql="SELECT AccessArea FROM Roles WHERE RoleId = 1;";
			}
			
			$result=mysqli_query($con,$sql);
			$row = $result->fetch_row();
			
			if ($row) {
				$permissionsList = $row[0];
				$permissions = explode(';', $permissionsList);
			}
			
			foreach ($permissions as $permission) {
				if ($permission === 'admin_tab') { ?>
					<script>document.getElementById('admin_tab').style.display='block';</script>
				<?php }
				elseif ($permission === 'patient_tab') { ?>
					<script>document.getElementById('patient_tab').style.display='block';</script>
				<?php }
				elseif ($permission === 'doctors_tab') { ?>
					<script>document.getElementById('doctors_tab').style.display='block';</script>
				<?php }
				elseif ($permission === 'nurses_tab') { ?>
					<script>document.getElementById('nurses_tab').style.display='block';</script>
				<?php }
				elseif ($permission === 'costs_tab') { ?>
					<script>document.getElementById('costs_tab').style.display='block';</script>
				<?php }
				elseif ($permission === 'surgery_tab') { ?>
					<script>document.getElementById('surgery_tab').style.display='block';</script>	
				<?php }
				elseif ($permission === 'facilities_tab') { ?>
					<script>document.getElementById('facilities_tab').style.display='block';</script><?php } }?>
    </form>
    </body>
    
</html>