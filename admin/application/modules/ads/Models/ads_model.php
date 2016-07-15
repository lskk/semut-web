<?php

class Ads_model extends CI_Model{
	
	var $table = "tb_ads";
	
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
		$query = $this->db->query("SELECT tb_ads.*, tb_ads_category.CatTitle FROM tb_ads LEFT JOIN tb_ads_category ON tb_ads.Category=tb_ads_category.ID WHERE tb_ads.CompanyID=$idcompany ORDER BY tb_ads.ID ASC ");
        if($query->num_rows > 0){
			return $query->result();
		}else{
			return false;
		}
	}
    
    function read_by_category($cat, $idcompany){
		$query = $this->db->query("SELECT tb_ads.*, tb_ads_category.CatTitle FROM tb_ads LEFT JOIN tb_ads_category ON tb_ads.Category=tb_ads_category.ID WHERE tb_ads.CompanyID=$idcompany AND tb_ads.Category=$cat ORDER BY tb_ads.ID ASC");
        if($query->num_rows > 0){
			return $query->result();
		}else{
			return false;
		}
	}
    
    function read_by_id($id){
		$query = $this->db->query("SELECT tb_ads.*, tb_ads_category.CatTitle FROM tb_ads LEFT JOIN tb_ads_category ON tb_ads.Category=tb_ads_category.ID WHERE tb_ads.ID= $id");
        if($query->num_rows > 0){
			return $query->row();
		}else{
			return false;
		}
	}
    
    function cat_by_id($id){
		$query = $this->db->query("SELECT CatTitle FROM tb_ads_category WHERE ID = $id");
        if($query){
			return $query->row();
		}else{
			return false;
		}
	}
        
    function cat(){
		$query = $this->db->query("SELECT * FROM tb_ads_category");
        return $query->result();
        /*
        if($query){
			return $query->result();
		}else{
			return false;
		}
        */
	}
	
    function count_ads($idcompany){
        $query = $this->db->query("SELECT COUNT(*) AS NumberOfAds FROM tb_ads WHERE CompanyID = $idcompany AND (Status = 1 OR Status = 2)");
        if($query->num_rows > 0){
			return $query->row();
		}else{
			return false;
		}
    }
    
    function company($idcompany){
		$query = $this->db->query("SELECT tb_ads_company.*, tb_ads_type.TypeName, tb_ads_type.AdsNumb FROM tb_ads_company LEFT JOIN tb_ads_type ON tb_ads_company.Subscription=tb_ads_type.ID WHERE tb_ads_company.ID= $idcompany");
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