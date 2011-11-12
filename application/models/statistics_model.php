<?php

class Statistics_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function get_numOfStudentsPerCourse($uni_id) {
		$query = $this->db->query('SELECT COUNT( DISTINCT (u.uid)) AS num, m.name AS name
									FROM module AS m
									LEFT JOIN code AS c ON m.mid = c.mid
									LEFT JOIN usercode AS uc ON uc.cid = c.cid
									LEFT JOIN user AS u ON u.uid = uc.uid
									WHERE u.unid = '.$uni_id.' GROUP BY name');
		return $query->result();
	}
	
		
	function get_percOfAttenPerModule($uni_id) {
		$query = $this->db->query('SELECT 
									m.name AS name, 
									COUNT( DISTINCT (c.cid)) AS codes, 
									COUNT( DISTINCT (uc.uid)) AS students,  
									COUNT(uc.cid) AS total, 
									(COUNT(uc.cid) * 100)  DIV (COUNT( DISTINCT (c.cid)) * COUNT( DISTINCT (uc.uid))) AS num
									FROM code AS c
									LEFT JOIN module AS m ON c.mid = m.mid
									LEFT JOIN usercode AS uc ON c.cid = uc.cid
									LEFT JOIN user AS u ON u.uid = uc.uid
									WHERE u.unid = '.$uni_id.' 
									GROUP BY name');
									return $query->result();
	}
	
                                  
	
	
}