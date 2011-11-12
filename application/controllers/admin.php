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
		
		/*if(!$this->session->userdata('logged_in')) {
			redirect('/');
		}*/
	}
	 
	public function uni_admin()
	{
		$this->load->view('uni_admin');
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
		$module_rows = $this->module_model->get_modules($this->session->userdata('uid'));
				
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
			$code = '';
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
	
	public function set_lecturer(){
		if($this->input->post()) {
			//get email/password
			$email = $this->input->post('email');
			
			//verify email/password
			$this->db->query("UPDATE user SET admin_rights = 1 WHERE email = '$email'");
			
			
			//redirect
			redirect('/');
		}
		else {
			redirect('/');
		}
	}
	
	public function remove_lecturer(){
		if($this->input->post()) {
			//get email/password
			$email = $this->input->post('email');
			
			//verify email/password
			$this->db->query("UPDATE user SET admin_rights = 0 WHERE email = '$email'");
			
			
			//redirect
			redirect('/');
		}
		else {
			redirect('/');
		}
	}
	
	public function list_codes() {
		$this->load->model('code_model');
		$rows = $this->code_model->query_codes("SELECT * 
										FROM  `code` ,  `module` 
										WHERE  `code`.`mid` =  `module`.`mid` 
										LIMIT 0 , 30");
	
		foreach ($rows as $row) {
			$htmlrows .= "
			<tr>
				<td>{$row->code}</td>
				<td>{$row->start_date}</td>
				<td>{$row->validity}</td>
				<td>{$row->module_name}</td>
				<td>{$row->module_ref}</td>
			</tr>";
		}
		
		$outdata = Array('htmlrows' => $htmlrows);
		$this->load->view('list_codes', $outdata);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */