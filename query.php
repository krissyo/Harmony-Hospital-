<?php
// @author: Krissy O'Farrell, 08854114
// Last modified on: 25/05/2014
include("pagecomponents/permissioncheckscript.php");
	$pagetitle="Queries";
	include ("pagecomponents/indexinclude.php");

	if (isset($_POST["query"])){
		//open ftp file
		$fp = fopen('file.csv', 'w');
		//get the query page
		$sql=$_POST["query"];
		if((strpos(strtoupper($sql),"DROP")!==false) 
		|| (strpos(strtoupper($sql),"UPDATE")!==false) 
		|| (strpos(strtoupper($sql),"DELETE")!==false) 
		|| (strpos(strtoupper($sql),"ALTER")!==false) 
		|| (strpos(strtoupper($sql),"CREATE")!==false)
		|| (strpos(strtoupper($sql),"INSERT")!==false)){
		    die("SQL Error: Not an allowed query.");   
		}
		//check if the sql query is valid
		$result=mysqli_query($con,$sql)
		    or die("Error: ".mysqli_error($con));
		//get the total number of rows
		$total = mysqli_num_rows($result);
		//create a list to hold the csv results
		$list = array();
		if($total > 0){
		    //loop over each row
		    while($row = mysqli_fetch_array($result)){
		        $tmp = array();
		        $i = 0;
		        //loop over the columns
		        foreach($row as $item){
		            //get the second column
		            if($i%2==0){
		                $tmp[]=$item;   
		            }
		            $i++;
		        }
		        //append the temp list onto the list
		        $list[]=$tmp;
		    }
		}
		//populate the csv file
		foreach ($list as $fields) {
		    fputcsv($fp, $fields);
		}
	//        print_r($list);
		echo "<a href='file.csv'>CSV file</a>";
	}

			?>  
	    <form method="post" action="query.php">
		<textarea name="query" placeholder="enter query here"></textarea>
		<input type="submit" name="Submit">
	    </form>    
	    
	     <?php include ("pagecomponents/footer.php"); ?>
	    </body>
	    
	</html>
	
