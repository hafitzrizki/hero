<?php

/*
* Get Template Files
*
* Returns an array of all template files in a theme's directory
*/
function template_files () {
	$CI = get_instance();
	$CI->load->helper('directory');
	
	$files = directory_map(FCPATH . 'themes/' . setting('theme'));
	
	$filtered_files = array();
	$filtered_files = parse_template_files_array($files, $filtered_files);
	
	unset($CI);
	
	return $filtered_files;
}

function parse_template_files_array ($files, $return = array()) {
	foreach ($files as $file) {
		if (is_array($file)) {
			$return = array_merge($return,parse_template_files_array($file, $return));
		}
		elseif (strpos($file, '.') !== FALSE and end(explode('.', $file)) == 'thtml') {
			$return[$file] = $file;
		}
	}
	
	return $return;
}