<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checkin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('code_model');
		$this->load->model('usercode_model');
		//$this->output->enable_profiler(TRUE);
	}
	 
	public function index()
	{
		$this->load->view('checkin');
	}
	
	public function login() {
		if($this->input->post()) {
			//get email/password/code
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$code = $this->input->post('code');
			
			//verify email/password
			if($this->user_model->check_login($email, sha1($password))) {
				//get user details
				$user = $this->user_model->get_user($email);
				$uid = $user->uid;
				
				//check code
				$code_query = "SELECT `cid` FROM `code` WHERE `code` = '$code'";
				$cid = $this->code_model->query_codes($code_query);
				if ($cid) {
					$cid = $cid[0]->cid;
					$data = Array(
						'uid' => $uid,
						'cid' => $cid
					);
					
					// insert usercode data
					$this->usercode_model->insert_usercode($data);
					
					// thank the muppets and redirect
					$this->session->set_flashdata('checkin_success', 'Check-In Successful!');
					redirect('/checkin');
				} else {
					$this->session->set_flashdata('invalid_code', 'Check-In Failed: Code Incorrect / Expired');
					redirect('/');
				}
			} else {
				$this->session->set_flashdata('login_failure', 'Login Failed: Email/Password Incorrect');
				redirect('/');
			}
		} else {
			$this->session->flashdata('login-failure', 'Login Failed: Email/Password Incorrect');
			redirect('/');
		}
	}
	
}