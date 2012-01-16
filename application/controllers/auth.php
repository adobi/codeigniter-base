<?php 

if (! defined('BASEPATH')) exit('No direct script access');

require_once 'MY_Controller.php';

class Auth extends MY_Controller 
{
    public function index()
    {
        redirect(base_url() . 'auth/login');
    }
    
    public function login() 
    {
        $data = array();
        
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_credentials');
        //dump($_POST); die;
        if ($this->form_validation->run()) {
			
			redirect(base_url() . 'dashboard');
		}
        
        $this->template->build('login/index', $data);
    }
    
    public function check_credentials() 
    {
        //$this->load->model('Users', 'users');
        
        //$user = $this->users->login($_POST['username'], md5($_POST['password']));
        //dump($_POST); die;
		
		$this->config->load('user');
		
        if ($_POST['username'] === $this->config->item('username') && md5($_POST['password']) === md5($this->config->item('password'))) {
            
            $this->session->set_userdata('logged_in', true);
            
            return true;
        }
        
        $this->form_validation->set_message('check_credentials', 'Incorrect username/password');
        return false;
    }   
    
    public function logout()
    {
        $this->session->unset_userdata('logged_in');
        
        $this->session->sess_destroy();
        
        redirect(str_replace('login', '', base_url()));
    }
}