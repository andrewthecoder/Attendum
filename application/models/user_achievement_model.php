<?php

class User_achievement_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function get_user_achievements() {
		$query = $this->db->get('userachievementmodule');
		
		return $query->result();
	}
}
