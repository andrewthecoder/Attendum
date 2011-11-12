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
		
		$this->output->enable_profiler(TRUE);
	 }
	 
	public function index()
	{
		redirect('/');
	}
	
	public function login() {
		if($this->input->post()) {
			//get email/password
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			
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
				redirect('/');
			}
			else {
				$this->session->set_flashdata('login-failure', 'Login Failed: Email/Password Incorrect');
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
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_unique_email|callback_uni_check');

			if ($this->form_validation->run() == FALSE)
			{
				$data['user1'] = $this->user_model->get_users();
				$this->load->view('home');
			}
			else
			{
				$str_bits = explode('@',$this->input->post('email'));
				$data = array(
					'email' => $this->input->post('email'),
					'admin_rights' => 0,
					'unid' => $this->user_model->get_unid_extension($str_bits[1]),
					'password' => $this->input->post('pass')
				);
			
				$this->user_model->insert_user($data);
				$this->load->view('signup_complete');
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
		$error = '';

		$this->load->model('user_model');
		$this->load->model('user_achievement_model');
		$this->load->model('achievement_model');
		
		$e1 = $this->input->post('e1');
		$e2 = $this->input->post('e2');
		//are the emails in the database?
		$this->db->where('email', $e1);
		$query = $this->db->get('user');
		if($query->num_rows() < 0){ $error = 'Either the email address is not registered or the user has hidden their achievements.';}
		$this->db->where('email', $e2);
		$query = $this->db->get('user');
		if($query->num_rows() < 0){ $error = 'Either the email address is not registered or the user has hidden their achievements.';}
		//Are has the other user permitted people to view their achievements?

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
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
