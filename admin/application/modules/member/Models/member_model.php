<?php

class Member_model extends CI_Model{
	
	var $table = "tb_user_admin";
	
	function __construct(){
		parent::__construct();
	}
	
	function create($data){
		$str = $this->db->insert_string($this->table, $data);
		
		$query = $this->db->query($str);
		
		if($query){
			return true;
		}else{
			return false;
		}
		
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
	
	function update($userid, $userdata){
		$data = (array)$userdata;
		$where = "id = $userid"; 
		$str = $this->db->update_string($this->table, $data, $where);
		$query = $this->db->query($str);
		return $query;
	}
	
	
	function delete(){
		
	}

	function count_all_user(){
		$query 	= $this->db->query("SELECT * FROM tb_user ORDER BY Joindate");
		return $query->result();
	}

	function get_user_per_month(){
		$query 	= $this->db->query("SELECT date_format(Joindate,'%M') as month, count(ID) as members from tb_user GROUP BY date_format(Joindate,'%M') ORDER BY month(Joindate) ASC");
		return $query->result();
	}
    
    function validate($username, $password){
		$query = $this->db->query("SELECT * FROM $this->table WHERE Username = '$username' AND Password = '$password'");
		if($query->num_rows === 1){
			return $query->row();
		}else{
			return false;
		}
	}
	
	function validadmin($username, $password){
		$query = $this->db->query("SELECT * FROM $this->table WHERE Username = '$username' AND Password = '$password'");
		if($query->num_rows === 1){
			return $query->row();
		}else{
			return false;
		}
	}

	//temporary use table t_usr, 
	function validsemut($username, $password){
		$query = $this->db->query("SELECT * FROM tb_user WHERE Name = '$username' AND Password = '$password'");
		if($query->num_rows === 1){
			return $query->row();
		}else{
			return false;
		}
	}

	function validtaxi($username, $password){
		$query = $this->db->query("SELECT * FROM tb_taxi_company WHERE Username = '$username' AND Password = '$password'");
		if($query->num_rows === 1){
			return $query->row();
		}else{
			return false;
		}
	}

	function validads($username, $password){
		$query = $this->db->query("SELECT * FROM tb_ads_company WHERE Username = '$username' AND Password = '$password'");
		if($query->num_rows === 1){
			return $query->row();
		}else{
			return false;
		}
	}

	function validambulance($username, $password){
		$query = $this->db->query("SELECT * FROM tb_ambulance WHERE Username = '$username' AND Password = '$password'");
		if($query->num_rows === 1){
			return $query->row();
		}else{
			return false;
		}
	}
		
}

?>