<?php

class Adscompany_model extends CI_Model{
	
	var $table = "tb_ads_company";
	
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
	
	function read(){
		$query = $this->db->query("SELECT tb_ads_company.*, tb_city.Name AS Cityname FROM tb_ads_company LEFT JOIN tb_city ON tb_ads_company.CityID=tb_city.ID ORDER BY tb_ads_company.ID ASC ");
        if($query->num_rows > 0){
			return $query->result();
		}else{
			return false;
		}
	}
    
    function read_by_city($city){
		$query = $this->db->query("SELECT tb_ads_company.*, tb_city.Name AS Cityname FROM tb_ads_company LEFT JOIN tb_city ON tb_ads_company.CityID=tb_city.ID WHERE tb_ads_company.CityID= $city ORDER BY tb_ads_company.ID ASC");
        if($query->num_rows > 0){
			return $query->result();
		}else{
			return false;
		}
	}
    
    function read_by_id($id){
		$query = $this->db->query("SELECT tb_ads_company.*, tb_city.Name AS Cityname FROM tb_ads_company LEFT JOIN tb_city ON tb_ads_company.CityID=tb_city.ID WHERE tb_ads_company.ID= $id");
        if($query->num_rows > 0){
			return $query->row();
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