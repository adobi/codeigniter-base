<?php 

if (! defined('BASEPATH')) exit('No direct script access');

require_once APPPATH . 'libraries/MY_Controller.php';

class Login extends MY_Controller 
{
    
    
    //php 5 constructor
    public function __construct() 
    {
        parent::__construct();
        
    }
    
    public function index()
    {
        $this->template->build('login/index');
    }
}
