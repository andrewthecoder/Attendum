<?php

class Achievement_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function get_achievements() {
		//$this->db->where('uid', 1);
		$query = $this->db->get('achievements');
		
		return $query->result();
	}
}