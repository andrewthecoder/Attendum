<?php

class User_achievement_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function get_achievements() {
		$query = $this->db->get('achievement');
		
		return $query->result();
	}
}