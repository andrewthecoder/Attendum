<?php

class User_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function get_user() {
		$query = $this->db->where('uid', 1)->get('user');
		
		return $query->result();
	}
}