<?php

class Summary_model extends CI_Model{
	
	function __construct(){
		parent::__construct();
	}
	
	function read_user(){
		$query = $this->db->query("SELECT * FROM tb_user");
		return $query->result();
	}
	
	function user_by_id($id){
		$query = $this->db->query("
			SELECT * 
			FROM $this->table
			WHERE id = $id
		");
		
		$query->row()->role = $this->get_role($id);
		$query->row()->role_name = $this->get_role_name($query->row()->role);
		
		if($query->num_rows > 0){
			return $query->row();
		}else{
			return false;
		}
	}

	function count_session($id,$month,$year){
		$query 	= $this->db->query("SELECT DISTINCT count(day(StartTime)) as log_count FROM tb_session WHERE month(StartTime) = $month AND UserID= $id AND year(StartTime) = $year ");
		if($query->num_rows > 0){
			return $query->row();
		}else{
			return false;
		}
	}
	
		
}

?>