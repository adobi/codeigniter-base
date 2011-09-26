<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	if(!function_exists('display_errors')) {
		
		function display_errors($errors) {
		    $html = '';
			if ($errors) {
    			    
    			$html .= '<div class = "error">';
    				$html .= $errors;
    			$html .= '</div>';
			
			}
			return $html;
		}
	}

?>