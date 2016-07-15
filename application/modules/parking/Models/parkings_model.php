<?php

class Parkings_model extends CI_Model{
	
	var $table = "tb_parking";
	
	function __construct(){
		parent::__construct();
	}
    
    function get_lot_data(){
        $data = array();
        $this->db->select('*')->from('tb_parking')->where("lot_id LIKE 'lskklot%'");
        
       
        // foreach ($this->db->get()->result() as $row) {
        //     array_push($data, $row->lot_id);
        // }
        return $this->db->get()->result();
    }  	
}

?>