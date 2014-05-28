<?php
// Author: Kira Jamison, 08795428
require_once("pagecomponents/connectDB.php");

$name = $_GET['q']; 

$sql = 'SELECT *  
		FROM top_nav 
		WHERE name = "' . $name . '" html_id IS NOT NULL LIMIT 1;';  

		$result = mysqli_query($con,$sql);
		
		if ($result !== false) {
			if ($row = mysqli_fetch_array($result)) {
				echo '<label>URL</label><br/>';
				echo '<input type="text" name="url" width="58" value="' . $row['url'] . '"><br/>';
				echo '<label>HTML Id</label><br/>';
				echo '<input type="text" name="html_id" width="58" value="' . $row['html_id'] . '"><br/>';
			}
		} else {
			echo '<label>URL</label><br/>';
			echo '<input type="text" name="url"><br/>';
			echo '<label>HTML Id</label><br/>';
			echo '<input type="text" name="html_id"><br/>';
		}

	
?>