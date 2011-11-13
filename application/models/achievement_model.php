<?php

class Achievement_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function get_achievements() {
		$query = $this->db->get('achievement');
		
		return $query->result();
	}
	
	/*function get_user_achievements($uid) {
		$this->db->where('uid',$uid);
		$query = $this->db->get('achievement');
		
		return $query->result();
	}*/
	
	function get_achievement($aid) {
		$this->db->where('aid', $aid);
		$query = $this->db->get('achievement');
		
		$row = $query->row();
		
		return $row;
	}
	
	function award_achievement($uid, $aid, $mid) {
		$data = array(
			'uid' => $uid,
			'aid' => $aid,
			'mid' => $mid
		);
		
		$this->db->insert('userachievementmodule',$data);
	}
}