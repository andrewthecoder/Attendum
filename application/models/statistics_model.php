<?php

class Statistics_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function get_numOfStudentsPerCourse($uni_id) {
		$query = $this->db->query('SELECT COUNT(DISTINCT(u.uid)) AS num,  l.name AS name FROM lecture AS l
									LEFT JOIN code AS c ON l.lid = c.lid 
									LEFT JOIN usercode AS uc ON uc.cid = c.cid 
									LEFT JOIN user AS u ON u.uid = uc.uid
									WHERE l.unid =  '.$uni_id);
		return $query->result();
	}
	
	
}