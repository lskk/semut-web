<?php

class Adssubscrib_model extends CI_Model{
	
	var $table = "tb_ads_subscription";
	
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
		$query = $this->db->query("SELECT tb_ads_company.*, tb_ads_type.TypeName, tb_ads_type.AdsNumb FROM tb_ads_company LEFT JOIN tb_ads_type ON tb_ads_company.Subscription=tb_ads_type.ID WHERE tb_ads_company.ID= $idcompany");
        if($query->num_rows > 0){
			return $query->row();
		}else{
			return false;
		}
	}
    
    function subscrib($idcompany){
        $query = $this->db->query("SELECT tb_ads_subscription.*, tb_ads_type.TypeName FROM tb_ads_subscription LEFT JOIN tb_ads_type ON tb_ads_subscription.Type=tb_ads_type.ID WHERE tb_ads_subscription.AdsCompany = $idcompany AND tb_ads_subscription.IsApprove=0 ");
        if($query->num_rows > 0){
			return $query->row();
		}else{
			return false;
		}
	}
    
    function count_ads($idcompany){
        $query = $this->db->query("SELECT COUNT(*) AS NumberOfAds FROM tb_ads WHERE CompanyID = $idcompany AND (Status = 1 AND Status = 2)");
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