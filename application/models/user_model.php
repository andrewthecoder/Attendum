<?php

class User_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function get_user() {
		$this->db->where('uid', 1);
		$query = $this->db->get('users');
		
		return $query->result();
	}
}