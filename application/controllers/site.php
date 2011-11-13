<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller {

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
		if($this->session->userdata('logged_in')) {
			redirect('user/profile');
		}
		else {
			$this->load->view('home');
		}
	}
	
	public function about()
	{
		$this->load->view('about');
	}
	
	public function points() {
		$this->load->view('points');
	}
	
	public function achievements() {
		$this->load->view('achievements');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */