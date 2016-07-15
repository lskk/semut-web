<?php

class Maptaxi_model extends CI_Model{
	
	function __construct(){
		parent::__construct();
	}
    
    //Get taxi location for mapview monitoring
    
    function taxi_latest(){
    	$latesttime = array();
    	$this->db->select('MAX(Timespan) AS timespan, DriverID')->from('tb_taxi_location')->group_by('DriverID');
    	
    	$complete = $this->db->get();
        if($complete){
            $latest = $complete->result();
            foreach ($latest as $row) {
                array_push($latesttime, $row->DriverID);
            }
            return $latesttime;
        }else{
            return false;
        }
    }
	
	function get_unit($id){
        $latest = $this->taxi_latest();
        
        if($latest){
            $this->db
                ->distinct()
                ->select('
                    tb_taxi_company.Name AS cname,
                    tb_taxi.Number AS taxnum,
                    tb_taxi.Nopol AS nopol,
                    tb_taxi_location.Altitude AS alt,
                    tb_taxi_location.Latitude AS lat,
                    tb_taxi_location.Longitude AS lon,
                    tb_taxi_location.Speed AS spd
                    ')
                ->join('tb_taxi_location', 'tb_taxi.Driver = tb_taxi_location.DriverID', 'left')
                ->join('tb_taxi_company', 'tb_taxi.TaxiCompany = tb_taxi_company.ID', 'left')
                ->where('tb_taxi_location.Latitude != 0 AND tb_taxi_location.Longitude != 0')
                ->where('tb_taxi_company.ID',$id);
                //->where_in('tb_taxi.Driver',$latest);
            $query = $this->db->get('tb_taxi');

            if($query->num_rows > 0){
                return $query->result();
            }else{
                return false;
            }
        }else{
            return array();
        }
    }
    
		
}

?>