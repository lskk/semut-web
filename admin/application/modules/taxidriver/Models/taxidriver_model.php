<?php

class Taxidriver_model extends CI_Model{
	
	var $table = "tb_taxi_driver";
	
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
		$query = $this->db->query("SELECT tb_taxi_driver.*, tb_taxi.Number AS TaxiNumber FROM tb_taxi_driver LEFT JOIN tb_taxi ON tb_taxi_driver.TaxiID=tb_taxi.ID WHERE tb_taxi_driver.TaxiCompany= $idcompany ORDER BY tb_taxi_driver.ID ASC ");
        if($query->num_rows > 0){
			return $query->result();
		}else{
			return false;
		}
	}
        
    function read_by_id($id){
		$query = $this->db->query("SELECT tb_taxi_driver.*, tb_taxi.Number AS TaxiNumber, tb_taxi.Nopol AS Nopol FROM tb_taxi_driver LEFT JOIN tb_taxi ON tb_taxi_driver.TaxiID=tb_taxi.ID WHERE tb_taxi_driver.ID= $id");
        if($query->num_rows > 0){
			return $query->row();
		}else{
			return false;
		}
	}
            
    function taxi_by_company($idcompany){
		$query = $this->db->query("SELECT * FROM tb_taxi WHERE TaxiCompany = $idcompany");
        if($query){
			return $query->result();
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