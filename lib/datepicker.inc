<?php

	function label($name, $label)
	{
		echo "<label for=\"$name\">$label</label>";
	}

	function select($name, $values)
	{
		$count = 0;
		echo "<select id=\"$name\" name=\"$name\">";
		foreach ($values as $value => $display)
		{

			$selected = ($value===$values)?'selected="selected"':'';
			echo "<option $selected value=\"$value\">$display</option>";
			$count++;
		}
		echo '</select>';
	}	


	function date_field($name, $label)
	{
		echo '<div class="required_field">';
		label($name, $label);
		
		$year = date('Y');
		$yearsarray = array_merge(array('Year' => 'Year'), range($year-10, $year+10));
		$years = array_combine($yearsarray, $yearsarray);
		$months = array('' => 'Month', 1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 =>'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');
		
		select("{$name}_month", $months);
		select("{$name}_year", $years);	
		
		echo '</div>';		
	}
?>