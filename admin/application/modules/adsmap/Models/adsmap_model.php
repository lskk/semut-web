<?php

class Adsmap_model extends CI_Model{
	
	function __construct(){
		parent::__construct();
	}
    
    //Get taxi location for mapview monitoring
    
    function get_ads($id){
		$query = $this->db->query("SELECT tb_ads.*, tb_ads_category.CatTitle FROM tb_ads LEFT JOIN tb_ads_category ON tb_ads.Category=tb_ads_category.ID WHERE tb_ads.CompanyID= $id");
        if($query->num_rows > 0){
			return $query->result();
		}else{
			return array();
		}
	}
    
		
}

?>