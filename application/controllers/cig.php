<?php  

class Cig extends CI_Controller 
{
    private $_controllerBundle;
    private $_modelBundle;
    private $_table;
    private $_originalTable;
    private $_prefix;
    private $_tabe_without_prefix;
    
    public function __construct() 
    {
        $this->_controllerBundle = APPPATH . 'cig/controller.php';
        
        $this->_modelBundle = APPPATH . 'cig/model.php';
        
        $this->_bundleDir = APPPATH . 'cig/';
        
        parent::__construct();
    }
    
    public function index()
    {
        $data = array();
        
        $model = false;
        $view = false;
        $controller = false;    
        
        $this->form_validation->set_rules('table_name', 'Table name', 'trim|required');
        
        if ($this->form_validation->run()) {
            $this->_table = strtolower(str_replace('_', '', $_POST['table_name']));
            
            $this->_preifx = $_POST['prefix'];
            $this->_tabe_without_prefix = $_POST['table_name'];
            
            $this->_originalTable = ($_POST['prefix'] ? $_POST['prefix'] . '_' : '') . $_POST['table_name'];
            
            if (isset($_POST['model'])) {
                $model = $this->_generateModel($this->uri->segment(3));
            }
            
            if (isset($_POST['view'])) {
                $view = $this->_generateView($this->uri->segment(3));
            }
            
            if (isset($_POST['controller'])) {
                $controller = $this->_generateController($this->uri->segment(3));
            }
            
            if ($this->uri->segment(3)) {
                
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
        $data['model'] = $model;
        $data['view'] = $view;
        $data['controller'] = $controller;        

        $this->template->build('cig/index', $data);
    }
    
    private function _generateController($writeToFile)
    {
        $table = $this->_table;
        
        $controllerDefinition = file_get_contents($this->_controllerBundle);
        
        $controllerClassName = ucfirst($table);
        $modelClassName = $controllerClassName . 's';
        $viewDir = $table;
        
        $result = $this->db->query('show columns from ' . $this->_originalTable)->result();
        
        $form_validations = '';
        if ($result) {
            foreach ($result as $item) {
                if ($item->Field !== 'id') {
                    $form_validations .= '$this->form_validation->set_rules("'.$item->Field.'", "'.ucfirst($item->Field).'", "trim|required");'."\r\n\t\t";
                }
            }
        }
        
        
        $tmpls = array('%%CONTROLLER_CLASS_NAME%%', '%%MODEL_NAME%%', '%%VIEW_DIR_NAME%%', '%%FORM_VALIDATION_RULES%%');
        $vals = array($controllerClassName, $modelClassName, $viewDir, $form_validations);
        
        //dump($vals);
        
        $controllerDefinition = str_replace($tmpls, $vals, $controllerDefinition);
        
        if ($writeToFile)
            file_put_contents(APPPATH.'controllers/'.$table.'.php', $controllerDefinition);
        
        //dump($controllerDefinition);
        
        return $controllerDefinition;
    }
    
    private function _generateModel($writeToFile) 
    {
        $table = $this->_originalTable;
        
        $modelDefinition = file_get_contents($this->_modelBundle);
        
        $model = ucfirst($this->_table . 's');
        
        $modelDefinition = str_replace(array('%%MODEL_CLASS_NAME%%', "%%TABLE_NAME%%"), array($model, $table), $modelDefinition);
        
        if ($writeToFile) {
            
            file_put_contents(APPPATH.'models/'.strtolower($model) . '.php', $modelDefinition);
        } 
        
        return $modelDefinition;
    }
    
    private function _generateView($writeToFile)
    {
        $table = $this->_table;
        $controller = $this->_tabe_without_prefix;
        
        $viewDir = APPPATH . 'views/' . $table;
        @mkdir($viewDir);
        //$this->_buildViewForTable($table);
        
        $index = str_replace(array('%%CONTROLLER%%'), array($controller), file_get_contents($this->_bundleDir . 'index.php'));
        
        $edit = $this->_buildViewForTable($table);
        
        if ($writeToFile) {
            file_put_contents($viewDir . '/index.php', $index);
            file_put_contents($viewDir . '/edit.php', $edit);
        }
        return array('index'=>$index, 'edit'=>$edit);
    }
    
    private function _buildViewForTable($table)
    {
        $edit = file_get_contents($this->_bundleDir . 'edit_open.php');
        
        $result = $this->db->query('show columns from ' . $this->_originalTable)->result();
        
        if (!$result) {
            
            return '';
        }
        
        foreach ($result as $col) {
            
            if ($col->Field !== 'id') {
                
                if (preg_match('/(varchar|int)/', $col->Type)) {
                    $edit .= str_replace(
                                array('%%COLUMN_NAME%%', '%%UC_COLUMN_NAME%%'), 
                                array($col->Field, ucfirst($col->Field)), 
                                file_get_contents($this->_bundleDir . 'edit_inputtext.php')
                            );
                    //dump($col->Field . ' - ' . $col->Type, 'input text');
                }
                
                if (preg_match('/text/', $col->Type)) {
                    $edit .= str_replace(
                                array('%%COLUMN_NAME%%', '%%UC_COLUMN_NAME%%'), 
                                array($col->Field, ucfirst($col->Field)), 
                                file_get_contents($this->_bundleDir . 'edit_textarea.php')
                            );
                    //dump($col->Field . ' - ' . $col->Type, 'textarea');
                }
                
                if (preg_match('/datetime/', $col->Type)) {
                    $edit .= str_replace(
                                array('%%COLUMN_NAME%%', '%%UC_COLUMN_NAME%%'), 
                                array($col->Field, ucfirst($col->Field)), 
                                file_get_contents($this->_bundleDir . 'edit_inputdate.php')
                            );
                    //dump($col->Field . ' - ' . $col->Type, 'datetime');
                }                
            }
        } 
        
        $edit .= file_get_contents($this->_bundleDir . 'edit_close.php');
        
        return $edit;
    }
}