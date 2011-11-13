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
	
	function check_achievements($uid, $cid) {
		$query = $this->db->get('achievement');
		
		foreach($query->result() as $ach) {
			$prep_sql = "SET @uid = ".$uid."; SET @cid = ".$cid.";";
			$sql = $prep_sql.' '.$ach->sql.';';
			
			echo $sql;
			
			$CI =& get_instance();
			$CI->load->model('module_model');
			$mid = $CI->module_model->get_mid_cid($cid);
			
			$aid = $ach->aid;
			
			$query = $this->db->query($sql);
			
			$row = $query->row();
			
			echo 'MID: '.$mid;
			echo 'AID: '.$aid;
			echo 'CID: '.$cid;
			
			if($row->obtained == 1) {
				$this->load->model('achievement_model');
				
				//award achievement
				$this->achievement_model->award_achievement($uid, $aid, $mid);
				return $this->achievement_model->get_achievement($aid);
			}
			else {
				return false;
			}
		}
	}
}
