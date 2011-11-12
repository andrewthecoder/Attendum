<?php

class User_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function get_users() {
		$query = $this->db->get('user');
		
		return $query->result();
	}
	
	function insert_user($data) {
		$this->db->insert('user', $data);
	}
	
	function check_uni($str) {
		$this->db->where('email_extension', $str);
		$query = $this->db->get('uni');
		
		if($query->num_rows() > 0) {
			return true;
		}
		else {
			return false;
		}
	}
	
	function get_unid_extension($ext) {
		$this->select('unid');
		$this->where('email_extension', $ext);
		$query = $this->get('uni');
		
		$row = $query->row();
		
		return $row->unid;
	}
}