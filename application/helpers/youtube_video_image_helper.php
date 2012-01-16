<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	if(!function_exists('youtube_video_image')) {
	
		function youtube_video_image($video) {
            
			return '<img src = "http://img.youtube.com/vi/'.$video.'/0.jpg" style = "opacity:0.6; width:340px; height:260px;"/>';
		}	
	}

?>