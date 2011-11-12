<?php

class Lecture_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function get_lectures() {
		$query = $this->db->get('lecture');
		
		return $query->result();
	}
}