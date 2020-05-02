<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $template = array();
    public $data = array();
    public $middle = '';
    private $admin_data;

	function __construct() {

        parent::__construct();
        
        $this->load->library('wirecard');
        
    }
	

    public function render($middleParam = '')
    {

        if ($middleParam == '')
        {
            $middleParam = $this->middle;
        }

           $this->template['header'] = $this->load->view('layout/header.php', $this->data, true);
           $this->template['middle'] = $this->load->view($middleParam, $this->data, true);
           $this->template['footer'] = $this->load->view('layout/footer.php', $this->data, true);
           $this->load->view('template/template', $this->template);
    }


	
	
	
	
	
}
?>