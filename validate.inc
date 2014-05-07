<?php
function validatePattern(&$errors, $field_list, $field_name, $pattern) {

	if(!ISSET($field_list[$field_name]) || $field_list[$field_name] == '') {
		$errors[$field_name] = 'Required';
	} else if (!preg_match($pattern, $field_list[$field_name])) {
		$errors[$field_name] = 'Invalid';
	}
}

function validateLength(&$errors, $field, $limit) {
	// limit prefix fields to be 8 chars long
	if (strlen($field) > $limit)
		$errors['prefix'] = 'Too long';
}
?>