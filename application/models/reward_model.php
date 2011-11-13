<?php

class Reward_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function get_rewards() {
		$query = $this->db->get('reward');
		
		return $query->result();
	}
	
	function insert_reward($data) {
		$this->db->insert($data);
	}
}