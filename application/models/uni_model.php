<?php

class Uni_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function get_unis() {
		$query = $this->db->get('uni');
		
		return $query->result();
	}
}