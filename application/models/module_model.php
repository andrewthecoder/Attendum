<?php

class Module_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function get_modules() {
		$query = $this->db->get('module');
		
		return $query->result();
	}
	
	function insert_module($data) {
		return $this->db->insert('module', $data);
	}
}