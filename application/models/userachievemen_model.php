<?php

class Userachievements_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function get_userachievements() {
		$query = $this->db->get('userachievement');
		
		return $query->result();
	}
}