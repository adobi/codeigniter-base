<?php 

if (! defined('BASEPATH')) exit('No direct script access');

require_once 'MY_Controller.php';

class %%CONTROLLER_CLASS_NAME%% extends MY_Controller 
{
    public function index() 
    {
        $data = array();
        
        $this->load->model('%%MODEL_NAME%%', 'model');
        
        $data['items'] = $this->model->fetchAll();
        
        $this->template->build('%%VIEW_DIR_NAME%%/index', $data);
    }
    
    public function edit() 
    {
        $data = array();
        
        $id = $this->uri->segment(3);
        
        $this->load->model('%%MODEL_NAME%%', 'model');
        
        $item = false;
        if ($id) {
            $item = $this->model->find((int)$id);
        }
        $data['item'] = $item;
        
        %%FORM_VALIDATION_RULES%%
        
        if ($this->form_validation->run()) {
        
            if ($id) {
                $this->model->update($_POST, $id);
            } else {
                $this->model->insert($_POST);
            }
            redirect($_SERVER['HTTP_REFERER']);
        }
        $this->template->build('%%VIEW_DIR_NAME%%/edit', $data);
    }
    
    public function delete()
    {
        $id = $this->uri->segment(3);
        
        if ($id) {
            $this->load->model('%%MODEL_NAME%%', 'model');
            
            $this->model->delete($id);
        }
        
        redirect($_SERVER['HTTP_REFERER']);
    }
}