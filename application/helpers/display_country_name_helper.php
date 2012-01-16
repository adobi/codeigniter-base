<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	if(!function_exists('display_country_name')) {
	
		function display_country_name($name) {
		    
		    $string = (file_get_contents(dirname($_SERVER['SCRIPT_FILENAME']) . '/countries.json'));
		    
		    $lines = explode(';', $string);
		    //dump($lines);
		    if ($lines) {
		        
		        foreach ($lines as $line) {
		            //dump($lines);
		            $items = explode(' ', $line, 2);
		            
		            if ($items && $items[0] === $name) {
		                return $items[1];
		            }
		        }
		    }
		    
		    return '';
		}	
	}

?>