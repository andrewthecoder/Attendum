<?php

class Usercode_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function get_usercodes() {
		$query = $this->db->get('usercode');
		
		return $query->result();
	}
}