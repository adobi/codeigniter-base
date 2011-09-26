<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	if(!function_exists('to_date')) {
	
		function to_date($dateStr) {
		    
		    return date('Y-m-d', strtotime($dateStr));
		}	
	}

?>