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
		$this->db->insert('reward', $data);
	}
	
	function assign_reward($rid, $aid, $mid) {
		$data = array(
			'rid' = $rid,
			'aid' => $aid,
			'mid' => $mid
		);
		
		$this->db->insert('rewardachievementmodule',$data);
	}
}