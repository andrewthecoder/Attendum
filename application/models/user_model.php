<?php

class User_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function get_users() {
		$query = $this->db->get('user');
		
		return $query->result();
	}
}