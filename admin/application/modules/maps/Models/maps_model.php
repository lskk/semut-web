<?php

class Maps_model extends CI_Model{
	
	var $table = "tb_user";
	
	function __construct(){
		parent::__construct();
	}
    
    //Get user semut location for mapview monitor
    
    function get_latest(){
    	$latesttime = array();
    	$this->db->select('MAX(Timespan) AS timespan')->from('tb_location')->group_by('UserID');
    	
    	$latest = $this->db->get()->result();
    	foreach ($latest as $row) {
            array_push($latesttime, $row->timespan);
    	}
    	return $latesttime;
    }
	
	function get_user_semut(){
        $latest = $this->get_latest();
        $this->db
    		->distinct()
			->select('
				tb_location.Altitude AS alt,
				tb_location.Latitude AS lat,
				tb_location.Longitude AS lon,
				tb_location.Speed AS spd,
				tb_user.Name AS name,
				tb_user.AvatarID AS avt
				')
			->join('tb_user', 'tb_location.UserID = tb_user.ID', 'left')
            ->where('tb_location.Latitude != 0 AND tb_location.Longitude != 0')
			->where_in('tb_location.Timespan',$latest);

		return $this->db->get('tb_location')->result();
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
            return array();
        }
    }
	
	function get_taxi(){
        $latest = $this->taxi_latest();
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
            ->where('tb_taxi_location.Latitude != 0 AND tb_taxi_location.Longitude != 0');
			//->where_in('tb_taxi.Driver',$latest);

		return $this->db->get('tb_taxi')->result();
    }
    
    function get_ambulance(){
        $this->db->select('tb_ambulance.*, tb_city.Name')
            ->join('tb_city','tb_ambulance.CityID = tb_city.ID','left');
        return $this->db->get('tb_ambulance')->result();
    }
    
		
}

?>