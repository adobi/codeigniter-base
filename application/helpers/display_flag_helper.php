<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	if(!function_exists('display_flag')) {
	
		function display_flag($name) {
		    
		    $json = json_decode(file_get_contents(dirname($_SERVER['SCRIPT_FILENAME']) . '/flags.json'));
		    $html = '';
		    if ($json) {
		        
		        foreach ($json as $i=>$row) {
		            foreach ($row as $j => $col) {
		                if ($col == $name) {
		                    $html .= '<span class = "flag"" style = "display:inline-block; 
		                                            width: 24px; 
		                                            height: 16px;
		                                            position:relative; top:3px; right:2px;
		                                            background-position: -'.(($j)*24).'px -'.(($i)*16).'px">
		                             </span>';
		                }
		            }
		        }
		    }
		    
		    return $html;
		}	
	}

?>