<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	if(!function_exists('to_time')) {
	
		function to_time($time) {
		    
		    $m = floor($time / 60);
		    if ($time - (60*$m) < 60) {
		        $s = $time - (60*$m);
		    } else {
		        $s = round($time - (60*$m)) / 60;
		    }
		    
		    
		    return "$m m $s s";
		}	
	}

?>