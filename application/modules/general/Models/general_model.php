<?php

class General_model extends CI_Model{
	

	function __construct(){
		parent::__construct();
	}

	function insert_node($data){
		$str = $this->db->insert_string('tb_node', $data);
		
		$query = $this->db->query($str);
		
		if($query){
			return true;
		}else{
			return false;
		}
		
	}
function get_profile($id){
		$this->db->select('*');
		$this->db->from('tb_user');
		$this->db->where('ID', $id);
		$query = $this->db->get(); 
						
		if($query->num_rows > 0){
			$row 					= $query->row();
			$profile['ID']			= $row->ID;
			$profile['Name']		= $row->Name;
			$profile['Email'] 		= $row->Email;
			$profile['CountryCode']	= $row->CountryCode;
			$profile['PhoneNumber']	= $row->PhoneNumber;
			$profile['Gender']		= $row->Gender;
			$profile['Birthday'] 	= $row->Birthday;
			$profile['Joindate'] 	= $row->Joindate;
			$profile['Poin']		= $row->Poin;
			$profile['PoinLevel']	= $row->PoinLevel;
			$profile['Reputation'] 	= $row->Reputation;
			$profile['AvatarID']	= $row->AvatarID;
			$profile['Verified']	= $row->Verified;
			$profile['deposit']	    = $row->deposit;
			$profile['Barcode']	    = $row->Barcode;
			return $profile;
		}else{
			return false;
		}
	}
	function insert_way($data){
		$str = $this->db->insert_string('tb_way', $data);
		
		$query = $this->db->query($str);
		
		if($query){
			return true;
		}else{
			return false;
		}
		
	}

	function cek_node($id){
		$this->db->where('ID',$id);
		$query = $this->db->get('tb_node');
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
		
	}

	function cek_way($id){
		$this->db->where('ID',$id);
		$query = $this->db->get('tb_way');
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
		
	}

	function cek_way_node($id,$node){
		$this->db->where('WayID',$id);
		$this->db->where('NodeID',$node);
		$query = $this->db->get('tb_way_node');
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
		
	}

	function insert_way_node($data){
		$str = $this->db->insert_string('tb_way_node', $data);
		
		$query = $this->db->query($str);
		
		if($query){
			return true;
		}else{
			return false;
		}
		
	}

	function count_semuter(){
		$query = $this->db->query("SELECT * FROM tb_user");
		return $query->num_rows;
	}

	function count_online_semuter(){
		$query = $this->db->query("SELECT * FROM tb_session WHERE EndTime = '0000-00-00 00:00:00' ");
		return $query->num_rows;
	}

	function count_report(){
		$query = $this->db->query("SELECT * FROM tb_post WHERE Status = 1 ");
		return $query->num_rows;
	}

	function count_incident(){
		$query = $this->db->query("SELECT * FROM tb_emergency WHERE Status = 1 ");
		return $query->num_rows;
	}
	
	
	
		
}

?>