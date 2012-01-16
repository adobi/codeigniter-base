<?php 

if (! defined('BASEPATH')) exit('No direct script access');

require_once(BASEPATH.'core/Controller'.EXT);

class MY_Controller extends CI_Controller 
{
    //php 5 constructor
    public function __construct() 
    {

        parent::__construct();
        
        if ($this->uri->segment(1) !== 'auth' && !$this->session->userdata('logged_in')) {
            
            redirect(base_url() . 'auth/login');
            
        }
    }
    
    protected function paginate($url, $uriSegment, $total, $perPage = ITEMS_PER_PAGE) 
    {
        $this->load->library('pagination');
        
	    $config = array();
	    $config['base_url'] = base_url() . $url;
	    $config['total_rows'] = $total;
	    $config['per_page'] = $perPage;
	    $config['num_links'] = 3;
	    $config['uri_segment'] = $uriSegment;
	    $config['first_link'] = '&laquo; First';
	    $config['last_link'] = 'Last &raquo;';
	    $config['next_link'] = 'Next &rsaquo;';
	    $config['prev_link'] = '&lsaquo; Prev';
	    $config['next_tag_open'] = '<li>';
	    $config['next_tag_close'] = '</li>';
	    $config['prev_tag_open'] = '<li>';
	    $config['prev_tag_close'] = '</li>';
	    $config['full_tag_open'] = '<div class="pagination"><ul>';
	    $config['full_tag_close'] = '</ul></div>';
	    $config['cur_tag_open'] = '<li class="active"><a>';
	    $config['cur_tag_close'] = '</a></li>';
	    $config['num_tag_open'] = '<li>';
	    $config['num_tag_close'] = '</li>';
	    $config['first_tag_open'] = '<li class = "prev">';
	    $config['first_tag_close'] = '</li>';
	    $config['last_tag_open'] = '<li class = "next">';
	    $config['last_tag_close'] = '</li>';
	    
	    $this->pagination->initialize($config);
	    
	    return $this->pagination->create_links();
	            
    }    
}
