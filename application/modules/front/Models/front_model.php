<?php

class Front_model extends CI_Model{
	

	function __construct(){
		parent::__construct();
	}

	function count_semuter(){
		$query = $this->db->query("SELECT * FROM tb_user");
		return $query->num_rows;
	}

	function count_online_semuter(){
		$this->db->select('*');
		$this->db->from('tb_session');
		$this->db->where('EndTime','0000-00-00 00:00:00');
		$query = $this->db->get();
		return $query->num_rows;
	}

	function count_tag(){
		$query = $this->db->query("SELECT * FROM tb_post WHERE Status = 1 ");
		return $query->num_rows;
	}

	function count_checkin(){
		$query = $this->db->query("SELECT * FROM tb_checkin WHERE Status = 1 ");
		return $query->num_rows;
	}

	function get_poinrank(){
		$this->db->select('ID, Name, Poin, Joindate, AvatarID');
		$this->db->order_by('Poin','DESC');
		$this->db->where('Poin >', 0);
		$this->db->limit(5);
		$this->db->from('tb_user');

		$query = $this->db->get();
		if ($query->num_rows > 0) {
			return $query->result();
		} else {
			return false;
		}
		
	}

	function get_reputrank(){
		$this->db->select('ID, Name, Reputation, Joindate, AvatarID');
		$this->db->order_by('Reputation','DESC');
		$this->db->where('Reputation >',0);
		$this->db->limit(5);
		$this->db->from('tb_user');

		$query = $this->db->get();
		if ($query->num_rows > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	
		
}

?>