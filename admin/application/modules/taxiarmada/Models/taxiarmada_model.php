<?php

class Taxiarmada_model extends CI_Model{
	
	var $table = "tb_taxi";
	
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
	
	function read($idcompany){
		$query = $this->db->query("SELECT tb_taxi.*, tb_taxi_driver.Name AS DriverName FROM tb_taxi LEFT JOIN tb_taxi_driver ON tb_taxi.Driver=tb_taxi_driver.ID WHERE tb_taxi.TaxiCompany= $idcompany ORDER BY tb_taxi.Number ASC ");
        if($query->num_rows > 0){
			return $query->result();
		}else{
			return false;
		}
	}
        
    function read_by_id($id){
		$query = $this->db->query("SELECT * FROM tb_taxi WHERE ID= $id");
        if($query->num_rows > 0){
			return $query->row();
		}else{
			return false;
		}
	}
    
    function get_driver($taxi){
        $query = $this->db->query("SELECT * FROM tb_taxi_driver WHERE TaxiID= $taxi");
        if($query->num_rows > 0){
			return $query->result();
		}else{
			return false;
		}
    }
    
    function city_by_id($id){
		$query = $this->db->query("SELECT Name FROM tb_city WHERE ID = $id");
        if($query){
			return $query->row();
		}else{
			return false;
		}
	}
    
    function city(){
		$query = $this->db->query("SELECT * FROM tb_city");
        return $query->result();
        /*
        if($query){
			return $query->result();
		}else{
			return false;
		}
        */
	}
	
	function user_by_id($id){
		$query = $this->db->query("
			SELECT * 
			FROM $this->table
			WHERE ID = $id
		");

		if($query->num_rows > 0){
			return $query->row();
		}else{
			return false;
		}
	}
		
	function update($id, $data){
		$data = (array)$data;
		$where = "ID = $id"; 
		$str = $this->db->update_string($this->table, $data, $where);
		$query = $this->db->query($str);
		if($query){
			return true;
		}else{
			return false;
		}
	}
		
	function delete(){
		
	}
		
}

?>