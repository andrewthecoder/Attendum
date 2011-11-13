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
	
	public function process() {
		if($this->input->post()) {
			// check for checkin from mobile device
			if($this->input->post('comments')) {
				$smsdata = $this->input->post('comments');
				$smsexploded = explode(" ", $smsdata);
				$password = $smsexploded[0];
				$code = $smsexploded[1];			
			} else {
				//get password/code
				$password = $this->input->post('password');
				$code = $this->input->post('code');		
			}
			$email = $this->input->post('email');
			
			//verify email/password
			if($this->user_model->check_login($email, sha1($password))) {
				//get user details
				$user = $this->user_model->get_user($email);
				$uid = $user->uid;

				// get current timestamp to compare with
				$time = time();
				//check code
				$code_query = "SELECT `cid` FROM `code` WHERE `code` = '$code' AND '$time' BETWEEN `start_time` AND `end_time`";
				$cid = $this->code_model->query_codes($code_query);
				if ($cid) {
					$cid = $cid[0]->cid;
					$data = Array(
						'uid' => $uid,
						'cid' => $cid
					);
					achievement($uid, $cid);
					// insert usercode data
					$this->usercode_model->insert_usercode($data);
					
					// thank the muppets and redirect
					$this->session->set_flashdata('checkin_success', 'Check-In Successful!');
					redirect('/checkin');
				} else {
					$this->session->set_flashdata('invalid_code', 'Check-In Failed: Code Incorrect / Expired');
					redirect('/checkin');
				}
			} else {
				$this->session->set_flashdata('login_failure', 'Login Failed: Email/Password Incorrect');
				redirect('/checkin');
			}
		} else {
			$this->session->flashdata('login-failure', 'Login Failed: Email/Password Incorrect');
			redirect('/checkin');
		}
	}
	
	private function achievement($uid, $cid){
		//for each achievment (
		//	if $this->db->query("SET @uid = $uid;
		//		SET @cid = $cid;".$query field) = 1 
		//		then 
		// 		if doesnt have achievement
		//			add achievment (insert uid, aid, mid (got from cid) into achievment
		//)
	}
	
	
	
}