<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct() {
		parent::__construct();

		//$this->output->enable_profiler(TRUE);
		
		if(!$this->session->userdata('logged_in')) {
			redirect('/');
		}
	}
	 
	public function index()
	{	
		$data['page_title'] = "Admin Dashboard";
		$this->load->view('admin_home');
	}
		 
	public function uni()
	{
		$this->load->view('admin_uni');
	}
	
	public function assign_reward() {
		$this->load->view('admin_assign_reward');
	}
	
	public function create_reward() {
		$this->load->view('admin_create_reward');
	}
	
	public function create_module() {
		$this->load->view('admin_create_module');
	}
	
	public function submit_module() {
		if($this->input->post()) {
			$this->load->model('module_model');
			
			$data = $this->input->post();
			$data['uid'] = $this->session->userdata('uid');
			
			$this->module_model->insert_module($data);
			$this->session->set_flashdata('module_created', 'Module Successfully Created');
			redirect('/admin/create_module/');
		} else {
			$this->session->set_flashdata('invalid_input', 'Invalid Input');
			redirect('/admin/create_module/');
		}
	}
	
	public function create_code() {
		$this->load->model('module_model');
		$this->load->helper('form');
		$module_rows = $this->module_model->get_modules($this->session->userdata('uid'));
		if($module_rows) {		
			foreach ($module_rows as $row) {
				$module_refs[$row->mid] = $row->ref;
			}
			$data = form_dropdown('mid', $module_refs);
			$data = Array("module_dropdown" => $data);
			$this->load->view('admin_create_code', $data);
		} else {
			$data['no_modules'] = true;
			$this->load->view('admin_create_code', $data);
		}
		
		
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
			$this->session->set_flashdata('code_created', "Code: $code created successfully!");
			redirect('/admin/create_code/');
		} else {
			$this->session->set_flashdata('invalid_input', "Invalid Input");
			redirect('/admin/create_code/');
		}
	}
	
	public function set_lecturer(){
		if($this->input->post()) {
			//get email/password
			$email = $this->input->post('email');
			
			//verify email/password
			$this->db->query("UPDATE user SET admin_rights = 1 WHERE email = '$email'");
			
			//redirect
			$this->session->set_flashdata('add_lecturer_success','Lecturer successfully added!');
			redirect('/admin/uni_admin');
		}
		else {
			redirect('/admin/uni_admin');
		}
	}
	
	public function insert_reward(){
		if($this->input->post()){
		
			$name = $this->input->post('name');
			
			$description = $this->input->post('description');
			
			$unid = $this->session->userdata('unid');
			
			$this->load->model('reward_model');
			
			//$this->db->query("INSERT INTO reward VALUES (null, '$name', '$description', $unid);");
			
			$data = array(
			
				'name' => $name, 
				'description' => $description,
				'unid' => $unid
			
			);
			
			$this->reward_model->insert_reward($data);
			
			$this->session->set_flashdata('add_reward_success','Reward successfully added!');
			
			redirect('/admin/create_reward');
			
		} else {
		
			redirect('/admin/create_reward');
			
		}
	}
	
	public function remove_lecturer(){
		if($this->input->post()) {
			//get email/password
			$email = $this->input->post('email');
			
			//verify email/password
			$this->db->query("UPDATE user SET admin_rights = 0 WHERE email = '$email'");
			
			//redirect
			$this->session->set_flashdata('remove_lecturer_success','Lecturer successfully removed!');
			redirect('/admin/uni_admin');
		}
		else {
			redirect('/admin/uni_admin');
		}
	}
	
	public function list_codes() {
		$this->load->model('code_model');
		$rows = $this->code_model->query_codes("
			SELECT * 
			FROM  `code`,`module`,`user`
			WHERE  `code`.`mid` = `module`.`mid`
			AND `module`.`uid` = `user`.`uid` 
			AND `user`.`uid` = {$this->session->userdata('uid')}
			ORDER BY `code`.`start_time` DESC
			LIMIT 0 , 30");
	
		$htmlrows = '';
		foreach ($rows as $row) {
			$bgcolor = 'FFB3B3';
			if ($row->start_time > time()) {
				$bgcolor = 'B3FFD7';
			}
			$start_date = date('l jS \of F Y h:i A', $row->start_time);
			$validity_unix = $row->end_time - $row->start_time;
			$validity = (int)date('i', $validity_unix);
			
			$htmlrows .= "
			<tr style='background-color: #{$bgcolor}'>
				<td>{$row->code}</td>
				<td>{$start_date}</td>
				<td>{$validity} mins</td>
				<td>{$row->name}</td>
				<td>{$row->ref}</td>
			</tr>";
		}
		
		$outdata = Array('htmlrows' => $htmlrows);
		$this->load->view('admin_list_codes', $outdata);
	}
	
}
