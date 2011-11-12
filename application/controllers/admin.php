<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 
	public function __construct() {
		parent::__construct();

		//$this->output->enable_profiler(TRUE);
	}
	 
	public function index()
	{	
		$this->load->view('home');
	}
	
	public function create_module() {
		$this->load->view('create_module');
	}
	
	public function submit_module() {
		if($this->input->post()) {
			$this->load->model('module_model');
			
			$data = $this->input->post();
			$data['uid'] = $this->session->userdata('unid');
			
			$this->module_model->insert_module($data);
			$this->load->view('module_created');
		} else {
			redirect('/admin/create_module/');
		}
	}
	
	public function create_code() {
		$data = Array(
			"module_dropdown" => "poo"
		);
		$this->load->view('create_code', $data);
		
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */