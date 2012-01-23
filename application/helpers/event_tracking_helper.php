<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	if(!function_exists('event_tracking')) {
	
		function event_tracking($item, $prefix="") {
		    
		    $category = ($prefix ? $prefix . '_' : '').'ga_category';
		    $action = ($prefix ? $prefix . '_' : '').'ga_action';
		    $label = ($prefix ? $prefix . '_' : '').'ga_label';
		    $value = ($prefix ? $prefix . '_' : '').'ga_value';
		    $noninteraction = ($prefix ? $prefix . '_' : '').'ga_noninteraction';
		    
		    return ' data-ga="tracking" data-ga-category="'.$item->$category.'" data-ga-action="'.$item->$action.'" data-ga-label="'.$item->$label.'" data-ga-value="'.$item->$value.'" data-ga-noninteraction="'.$item->$noninteraction.'" ';
		}	
	}

?>