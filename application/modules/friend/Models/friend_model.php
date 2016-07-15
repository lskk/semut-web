<?php

class Friend_model extends CI_Model{
	
	
	function __construct(){
		parent::__construct();
	}

	function get_friend1($id){
        $this->db->select('*');
        $this->db->from('tb_relation');
        $this->db->where('State','2');
        $this->db->where('ID_REQUEST',$id);
        $query  = $this->db->get();
        if($query->num_rows > 0){
        	return $query->result();
        }else{
        	return false;
        }
    }

    function get_friend_request($id){
        $this->db->select('*');
        $this->db->from('tb_relation');
        $this->db->where('State','1');
        $this->db->where('ID_RESPONSE',$id);
        $query  = $this->db->get();
        if($query->num_rows > 0){
        	return $query->result();
        }else{
        	return false;
        }
    }

    function get_friend_pending($id){
        $this->db->select('*');
        $this->db->from('tb_relation');
        $this->db->where('State','1');
        $this->db->where('ID_REQUEST',$id);
        $query  = $this->db->get();
        if($query->num_rows > 0){
        	return $query->result();
        }else{
        	return false;
        }
    }

	function get_friend2($id){
        $this->db->select('*');
        $this->db->from('tb_relation');
        $this->db->where('State','2');
        $this->db->where('ID_RESPONSE',$id);
        $query  = $this->db->get();
        if($query->num_rows > 0){
        	return $query->result();
        }else{
        	return false;
        }
    }

    function get_friend_profile($id){
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
			$profile['AvatarID']	= $row->AvatarID;
			return $profile;
		}else{
			return false;
		}
	}

	function update_relation($data,$id,$idfriend){
		$this->db->where('ID_RESPONSE', $id);
		$this->db->where('ID_REQUEST',$idfriend);
		$this->db->where('State',1);
		return $this->db->update('tb_relation',$data);
	}
	
}

?>