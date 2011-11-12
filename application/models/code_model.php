<?php

class Code_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function get_codes() {
		$query = $this->db->get('code');
		
		return $query->result();
	}
}