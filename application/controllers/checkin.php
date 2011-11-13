<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checkin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('code_model');
		$this->load->model('usercode_model');
		$this->output->enable_profiler(TRUE);
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
					
					// insert the correctly valid code to database; log attendance! woo!
					$this->usercode_model->insert_usercode($data);
					
					//now let's get down to some complicated achievement shit.
					$query = $this->db->get('achievement');
		
					foreach($query->result() as $ach_row) {
						$test_ach_sql = $ach_row->sql;
						preg_match_all(
							"|^SET @([^ ]+) = (.+)$|m",
							$test_ach_sql,
							$set_matches);
						$vars = $set_matches[1];
						$queries = $set_matches[2];
						
						foreach($vars as $index=>$varname) {
							$sql_var_query = str_replace("@cid",$cid,$queries[$index]);
							$var_query_result = $this->db->query($sql_var_query);
							
							foreach ($var_query_result->result_array() as $row)
							{
							   echo $row[0];
							   echo $row[1];
							}
						}
						
						die();
					
					
						if($row->obtained == 1) {
							$this->load->model('achievement_model');
							
							//award achievement
							$this->achievement_model->award_achievement($uid, $aid, $mid);
							return $this->achievement_model->get_achievement($aid);
						}
						else {
							return false;
						}
					}
					
					// thank the muppets and redirect
					$this->session->set_flashdata('checkin_success', 'Check-In Successful!');
					if($achievement) {
						$this->session->set_flashdata('achievement_gained','Achievement Gained: '.$achievement->name.' '.$achievement->points.' Points');
					}
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
	
}