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

		$this->session->set_userdata('unid', '2');
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
		$this->load->model('module_model');
		$this->load->helper('form');
		$module_rows = $this->module_model->get_modules($this->session->userdata('unid'));
				
		foreach ($module_rows as $row) {
			$module_refs[$row->mid] = $row->ref;
		}
		$data = form_dropdown('mid', $module_refs);
		$data = Array("module_dropdown" => $data);
		
		$this->load->view('create_code', $data);
		
	}
	
	public function submit_code() {
		if($this->input->post()) {
			$indata = $this->input->post();
			$mid = $indata['mid'];
			$validity_minutes = $indata['validity'];
			$validfrom_unix = strtotime($indata['validfrom']);
			$validtill_unix = strtotime("+$validity_minutes minutes",$validfrom_unix);
			
			$chars = '23456789ABCDEFGHJKMNPQRSTUVWZYZ';
			mt_srand( intval( $mid+$validfrom_unix+$validtill_unix ) );
			for ($p = 0; $p < 6; $p++) {
				$code .= $chars[mt_rand(0, 30)];
			}
			
			$this->load->model('code_model');
			$sqldata = Array(
				'start_time' => $validfrom_unix,
				'end_time' => $validtill_unix,
				'code' => $code,
				'mid' => $mid
			);
			$this->code_model->insert_code($sqldata);
			
			$outdata = Array(
				'code' => $code,
				'startdate' => $indata['validfrom']
			);
			$this->load->view('code_created', $outdata);
		} else {
			redirect('/admin/create_module/');
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */