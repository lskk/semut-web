<?php

class Places_model extends CI_Model{
	
	var $table = "tb_place";
	
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
		$query = $this->db->query("
        SELECT tb_place.*, tb_place_type.Name AS Type
        FROM tb_place 
        LEFT JOIN tb_place_type ON tb_place.TypeID=tb_place_type.ID 
        ORDER BY tb_place.ID ASC ");
        if($query->num_rows > 0){
			return $query->result();
		}else{
			return false;
		}
	}
    
    function read_by_type($type){
		$query = $this->db->query("
        SELECT tb_place.*, tb_place_type.Name AS Type 
        FROM tb_place 
        LEFT JOIN tb_place_type ON tb_place.TypeID=tb_place_type.ID 
        WHERE tb_place.TypeID= $type ORDER BY tb_place.ID ASC");
        if($query->num_rows > 0){
			return $query->result();
		}else{
			return false;
		}
	}
    
    function read_by_id($id){
		$query = $this->db->query("
        SELECT tb_place.*, tb_place_type.Name AS Type
        FROM tb_place 
        LEFT JOIN tb_place_type ON tb_place.TypeID=tb_place_type.ID 
        WHERE tb_place.ID= $id");
        if($query->num_rows > 0){
			return $query->row();
		}else{
			return false;
		}
	}
    
    function type_by_id($id){
		$query = $this->db->query("SELECT Name FROM tb_place_type WHERE ID = $id");
        if($query){
			return $query->row();
		}else{
			return false;
		}
	}
    
    function type(){
		$query = $this->db->query("SELECT * FROM tb_place_type");
        return $query->result();
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