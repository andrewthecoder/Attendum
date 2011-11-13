<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

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
		
		$this->load->model('user_model');
		
		//$this->output->enable_profiler(TRUE);
	 }
	 
	public function index()
	{
		redirect('/');
	}
	
	public function profile() {

		
		$myID = $this->session->userdata['uid'];
		$query = $this->db->query('SELECT a.name AS name,
								a.points AS points
								FROM userachievementmodule 
								AS uam LEFT JOIN achievement AS a ON a.aid = uam.aid WHERE uam.uid = '.$myID);
		$achievementStrings = $query->result();
		
		$query = $this->db->query("
			SELECT ((COUNT(c.cid) * 10) + IFNULL( (SUM(a.points)),0)  ) AS points 
			FROM 
			code AS c 
			LEFT JOIN usercode AS uc ON c.cid = uc.cid
			LEFT JOIN user AS u ON u.uid = uc.uid
			LEFT JOIN userachievementmodule AS uam ON uam.uid = u.uid
			LEFT JOIN achievement AS a ON a.aid = uam.aid
			WHERE u.uid = $myID");
		$points = $query->result();
		
		$data['points'] = $points[0]->points;
		$data['page_title'] = 'Your Profile';
		$data['achievementStrings'] = $achievementStrings;
		$this->load->view('profile', $data);
	}
	public function change_pass() {
		if($this->input->post()) {
		
			$this->form_validation->set_rules('curr_pass', 'Current Password', 'trim|required|callback_check_curr_pass|sha1');
			$this->form_validation->set_rules('new_pass', 'New Password', 'trim|required|matches[new_pass_conf]|sha1');
			$this->form_validation->set_rules('new_pass_conf', 'New Password Confirmation', 'trim|required');

			if ($this->form_validation->run() == FALSE)
			{
				//LOAD SHIT BEFORE PROFILE CALL
				$myID = $this->session->userdata['uid'];
				$query = $this->db->query('SELECT a.name AS name,
										a.points AS points
										FROM userachievementmodule 
										AS uam LEFT JOIN achievement AS a ON a.aid = uam.aid WHERE uam.uid = '.$myID);
				$achievementStrings = $query->result();
				
				$query = $this->db->query("
					SELECT ((COUNT(c.cid) * 10) + IFNULL( (SUM(a.points)),0)  ) AS points 
					FROM 
					code AS c 
					LEFT JOIN usercode AS uc ON c.cid = uc.cid
					LEFT JOIN user AS u ON u.uid = uc.uid
					LEFT JOIN userachievementmodule AS uam ON uam.uid = u.uid
					LEFT JOIN achievement AS a ON a.aid = uam.aid
					WHERE u.uid = $myID");
				$points = $query->result();
				
				$data['points'] = $points[0]->points;
				$data['page_title'] = 'Your Profile';
				$data['achievementStrings'] = $achievementStrings;
				$this->load->view('profile', $data);
			}
			else {
				//update
				$this->user_model->change_pass($this->session->userdata('uid'),$this->input->post('new_pass'));
				
				$this->session->set_flashdata('change_pw_success', 'Password changed.');
				//redirect
				redirect('/user/profile');
			}
			//get currpass, new pass.
			
			//verify currpass.
			
			//update new pass.
			
			//redirect.
		}
		else {
			redirect('/user/profile');
		}
	}
	
	function check_curr_pass($str) {
		$this->form_validation->set_message('check_curr_pass', 'That\'s not your current password');
		return $this->user_model->check_curr_pass($this->session->userdata('uid'), sha1($str));
	}
	
	public function show_data() {
		if($this->input->post()) {
			$this->user_model->show_data($this->session->userdata('uid'));
			$this->session->set_userdata('opt_in', 1);
			$this->session->set_flashdata('show_data_success','You are now sharing your data');
			redirect('/user/profile');
		}
		else {
			redirect('/user/profile');
		}
	}
	
	public function hide_data() {
		if($this->input->post()) {
			$this->user_model->hide_data($this->session->userdata('uid'));
			$this->session->set_userdata('opt_in', 0);
			$this->session->set_flashdata('hide_data_success','You are now hiding your data');
			redirect('/user/profile');
		}
		else {
			redirect('/user/profile');
		}
	}
	
	public function login() {
		if($this->input->post()) {
			//get email/password
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			
			if($email != '' && $password != '') {
			
			//verify email/password
				if($this->user_model->check_login($email, sha1($password))) {
					//get user details
					$user = $this->user_model->get_user($email);
					
					//setup session data
					$sess = array(
						'uid' => $user->uid,
						'email' => $user->email,
						'unid' => $user->unid,
						'admin_rights' => $user->admin_rights,
						'logged_in' => TRUE,
						'opt_in' => $user->opt_in
					);
					
					$this->session->set_userdata($sess);
				
					//redirect
					//redirect('/');
					redirect('/user/profile');
				}
				else {
					$this->session->set_flashdata('login_failure', 'Login Failed: Email/Password Incorrect');
					//$this->load->view('/user/profile');
					redirect('/');
				}
			}
			else {
				$this->session->set_flashdata('login_failure', 'Login Failed: Email/Password Incorrect');
				//$this->load->view('home');
				redirect('/');
			}
		}
		else {
			$this->session->flashdata('login-failure', 'Login Failed: Email/Password Incorrect');
			redirect('/');
		}
	}
	
	function logout() { 
		$this->session->sess_destroy();
		redirect('/');
	}
	
	
	
	public function signup() {
		if($this->input->post()) {
			$this->load->helper(array('form', 'url'));

			$this->load->library('form_validation');
			//$this->load->model('user_model');

			$this->form_validation->set_rules('pass', 'Password', 'trim|required|matches[passconf]|sha1');
			$this->form_validation->set_rules('passconf', 'Confirm Password', 'trim|required|sha1');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_unique_email');

			if ($this->form_validation->run() == FALSE)
			{
				//$data['user1'] = $this->user_model->get_users();
				$this->load->view('home');
			}
			else
			{
				$str_bits = explode('@',$this->input->post('email'));
				//echo print_r($str_bits);
				
				if($this->user_model->check_uni($str_bits[1])) {
				
					$data = array(
						'email' => $this->input->post('email'),
						'admin_rights' => 0,
						'unid' => $this->user_model->get_unid_extension($str_bits[1]),
						'password' => $this->input->post('pass'),
						'opt_in' => 0
					);
					
					//echo $this->input->post('email');
				
					$this->user_model->insert_user($data);
					$this->session->set_flashdata('signup_success','You\'ve successfully signed up.');
					redirect('/');
				
				}
				else {
					$this->session->flashdata('uni_check_fail', 'Uni not registered');
					redirect('/');
				}
			}

		}
		else {
			redirect('/');
		}
	}
	
	public function unique_email($str) { 
		if($this->user_model->check_unique_email($str)) {
		}
		else {
			$this->form_validation->set_message('unique_email', 'That email address is already registered.');
			return false;
		}
	}
	
	public function uni_check($str) {
		//echo 'STR: '.$str;
		$str_bits = explode('@',$str);
		if($this->user_model->check_uni($str_bits[1])) {
			return true;
		}
		else {
			$this->form_validation->set_message('uni_check', 'Your University is not currently registered with Attendum.');
			return false;
		}
		
	}
	
	public function comparison_chooser()
	{
		$this->load->view('comparison_chooser');
	}

	public function compare_achievements()
	{
		$this->load->database('user');

		$error = '';

		$this->load->model('user_model');
		$this->load->model('user_achievement_model');
		$this->load->model('achievement_model');
		
		$e2 = $this->input->post('e2');

		//Is the email address in the database?
		$this->db->where('email', $e2);
		$query = $this->db->get('user');
		$row = $query->row_array();
		if($query->num_rows() < 1)
		{
			$error = 'Either the email address is not registered or the user has hidden their achievements.<br/>';
		}
		elseif($row['opt_in'] == 0)
		{//Has the other user permitted people to view their achievements?
			$error = 'Either the email address is not registered or the user has hidden their achievements.<br/>';
		}
		$e1 = $this->session->userdata['email'];
		//$e1id = $this->session->userdata['uid'];
		//$this->db->where('uid', $e1id);
		//$query = $this->db->get('user');
		//$row = $query->row_array(); 
		//$e1 = $row['uid'];
		if(strlen($e1) < 1)
		{
			$error = 'You must be logged in to compare your achievements.<br/>';
		}
	
		$data = array(
			'error' => $error,
			'e1' => $e1,
			'e2' => $e2,
			'users' => $this->user_model->get_users(),		
			'userachievements' => $this->user_achievement_model->get_user_achievements(),
			'achievements' => $this->achievement_model->get_achievements()
		);
		
		$this->load->view('comparing_achievements', $data);
	}

	public function league() {
	
		if($this->session->userdata('logged_in')) {
			$uid = $this->session->userdata['uid'];
			$unid = $this->session->userdata['unid'];
		
			$query = $this->db->query("
				SELECT ((COUNT(DISTINCT c.cid) * 10) + IFNULL( (SUM(a.points)),0)  ) AS points, COUNT(uam.uid) AS achcount, u.uid AS uid, u.email AS email
				FROM 
				code AS c 
				LEFT JOIN usercode AS uc ON c.cid = uc.cid
				LEFT JOIN user AS u ON u.uid = uc.uid
				LEFT JOIN userachievementmodule AS uam ON uam.uid = u.uid
				LEFT JOIN achievement AS a ON a.aid = uam.aid
				WHERE u.unid = $unid
				AND u.opt_in = 1
				GROUP BY email
				ORDER BY points DESC
				LIMIT 0,30;");		
			$leagueboard = $query->result_array();
			
			$htmlout = '<tr><td><strong>Username</strong></td><td><strong>Achievements</strong></td><td><strong>Points</strong></td></tr>';
			foreach ($leagueboard as $league_entry) {
				$username = substr($league_entry['email'],0,strpos($league_entry['email'],'@'));
				$htmlout .= "<tr><td>{$username}</td><td>{$league_entry['achcount']}</td><td>{$league_entry['points']}</td></tr>";
			}
			
			$modulequery = $this->db->query("
				SELECT ((COUNT(DISTINCT c.cid) * 10) + IFNULL( (SUM(a.points)),0)  ) AS points, COUNT(uam.uid) AS achcount, u.uid AS uid, u.email AS email
				FROM 
				code AS c 
				LEFT JOIN usercode AS uc ON c.cid = uc.cid
				LEFT JOIN user AS u ON u.uid = uc.uid
				LEFT JOIN userachievementmodule AS uam ON uam.uid = u.uid
				LEFT JOIN achievement AS a ON a.aid = uam.aid
				WHERE u.unid = $unid
				AND u.opt_in = 1
				AND c.mid = 11
				GROUP BY email
				ORDER BY points DESC
				LIMIT 0,30;");
			$moduleleagueboard = $modulequery->result_array();
			
			$modulehtmlout = '<tr><td><strong>Username</strong></td><td><strong>Achievements</strong></td><td><strong>Points</strong></td></tr>';
			foreach ($moduleleagueboard as $moduleleague_entry) {
				$moduleusername = substr($moduleleague_entry['email'],0,strpos($moduleleague_entry['email'],'@'));
				$modulehtmlout .= "<tr><td>{$moduleusername}</td><td>{$moduleleague_entry['achcount']}</td><td>{$moduleleague_entry['points']}</td></tr>";
			}
			
			$dataout = Array('htmlout' => $htmlout, 'modulehtmlout' => $modulehtmlout);
			
			$this->load->view('league', $dataout);
		}
		else {
			redirect('/');
		}
		
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
