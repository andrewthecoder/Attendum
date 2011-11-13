<?php

class Adm_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	function achievementString($aid)
	{
		$this->load->database('achievement');
		$this->db->where('aid', $aid);
		$query = $this->db->get('achievement');
		$row = $query->row_array();
		$name = $row['name'];
		$description = $row['description'];
		$image_filename = base_url()+'images/achievements/'+$row['image_filename'];
		
		$str = '';
		$str .= '<p>';
		$str .= "<img src="$image_filename" alt"$name" style="+'"float:right;margin:0 5px 0 0;"/>';
		$str .= $name+'<br/>';
		$str .= $description;
		$str .= '</p>';

		return $str;
	}

}
