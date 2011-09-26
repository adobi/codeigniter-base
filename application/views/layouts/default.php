<?php  

    if (!(array_key_exists('HTTP_X_REQUESTED_WITH', $_SERVER) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest')) {
        
        require_once '_header.php';
    }
    
    
    echo $template['body'];
    
    if (!(array_key_exists('HTTP_X_REQUESTED_WITH', $_SERVER) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest')) {
        require_once '_footer.php';
    }

?>