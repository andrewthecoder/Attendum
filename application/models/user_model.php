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
	
	function check_login($email, $password) {
		$this->db->select('uid');
		$this->db->where('email', $email);
		$this->db->where('password', $password);
		$query = $this->db->get('user');
		
		if($query->num_rows() == 1) {
			return true;
		}
		else {
			return false;
		}
	}
	
	function get_user($email) {
		$this->db->where('email', $email);
		$query = $this->db->get('user');
		
		if($query->num_rows() > 0) {
			return $query->row();
		}
		else {
			return null;
		}
	}
	
	function check_unique_email($email) {
		$this->db->select('uid');
		$this->db->where('email', $email);
		$query = $this->db->get('user');
		
		if($query->num_rows() > 0) {
			return false;
		}
		else {
			return true;
		}
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
		$this->db->select('unid');
		$this->db->where('email_extension', $ext);
		$query = $this->db->get('uni');
		
		$row = $query->row();
		
		return $row->unid;
	}

	function get_uid_using_email($email) {
		$this->db->select('uid');
		$this->db->where('email', $email);
		$query = $this->db->get('user');
		
		$row = $query->row();
		
		return $row->uid;
	}
}
