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
	
	function query_usercodes($q) {
		$query = $this->db->query($q);
		return $query->result();
	}
	
	function insert_usercode($data) {
		return $this->db->insert('usercode', $data);
	}
}